<?php

namespace App\Http\Controllers\kas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Response;
use Auth;
use App\Models\Transaksi;
use App\Models\Gudang;
use App\Models\Truk;
use App\Models\Seleb;
use App\Models\Saldo;

class kPiutangController extends Controller
{
    public function link($id_transaksi = null)
    {
        if($id_transaksi == null){
            $data = null;
        }else{
            $data = Transaksi::find($id_transaksi);
        }

        $seleb= Seleb::select('*')->get();
        $q = Saldo::select('*')->OrderBy('id', 'DESC')->first();

        if (!empty($q)) {
            $saldo = $q->saldo_akhir;
        }else{
            $saldo = 0;
        }
        
        return view('kas.piutang', ['data' => $data, 'seleb' => $seleb, 'saldo' => $saldo]);
    }

    public function data($filter)
    {   
        $f = explode(';', $filter);

        $query = Transaksi::with('seleb')->where('kd_transaksi', 'SP')->select('*');
        $query->OrderBy('id_transaksi', 'ASC');

        // dd($query);

       return Datatables::of($query)
                        // ->addColumn('menu', function($model) {
                        //     // $edit = '<a href="' . route("klain-link", ['id_transaksi' => $model->id_transaksi]) . '"><button type="button" class="btn btn-sm btn-success">Edit</button></a>';
                        //     // $hapus = '<button type="button" onclick="hapus(' . $model->id_transaksi . ')" class="btn btn-sm btn-danger">Hapus</button>';
                        //     $edit = '';
                        //     $hapus = '';

                        //     return $edit . ' ' . $hapus;
                        // })
                        // ->rawColumns(['menu'])
                        ->make(true);
    }

    public function simpan(Request $req){

    	// dd($req->all());

        $tmp_saldo = Saldo::select('*')->OrderBy('id', 'DESC')->first();
        if(is_null($tmp_saldo)){
            $saldo_akhir = 0;
        }else{
            $saldo_akhir = $tmp_saldo->saldo_akhir;
        }

        $rp_lain = str_replace('.', '', $req->rp_lain);

        if($req->tipe == 1){
            $data = new Transaksi;
            $data->kd_transaksi = 'SP';
            $data->id_seleb_piutang = $req->id_seleb;
            $data->tgl_transaksi = date('Y-m-d', strtotime($req->tgl_transaksi));
            $data->rp_lain = $rp_lain;
            $data->ket_lain = $req->ket_lain;
            $data->pay_flow = 'db';
            $data->pay_method = $req->pay_method;
            $data->rek_bayar = $req->rek_bayar;
            $data->rek_tujuan = $req->rek_tujuan;
            // $data->entry = Auth::user()->id;
            // $data->entry_date = date('Y-m-d H:i:s');
            $data->save();

            $saldo = new Saldo;
            $saldo->id_transaksi = $data->id_transaksi;
            $saldo->tanggal = date('Y-m-d', strtotime($data->tgl_transaksi));
            $saldo->debit = $data->rp_lain;
            $saldo->saldo_akhir = $saldo_akhir - $data->rp_lain;
            $saldo->kd_transaksi = 'SP';
            $saldo->keterangan = $data->ket_lain;
            $saldo->save();

            $seleb = Seleb::find($req->id_seleb);
            $seleb->saldo += $rp_lain;
            $seleb->save();
        }

        return redirect()->route('kpiutang-link');
    }

    public function hapus(Request $req){
        $tmp_saldo = Saldo::select('*')->OrderBy('id', 'DESC')->first();
        if(is_null($tmp_saldo)){
            $saldo_akhir = 0;
        }else{
            $saldo_akhir = $tmp_saldo->saldo_akhir;
        }

        $kas = Kas::find($req->id_kas);

        $saldo = new Saldo;
        $saldo->id_kas = $kas->id_kas;
        if($kas->jenis_kas == 'db'){
            $saldo->saldo_akhir = $saldo_akhir + $kas->jumlah;
        }else{
            $saldo->saldo_akhir = $saldo_akhir - $kas->jumlah;
        }
        $saldo->keterangan = 'hapus kas piutang';
        $saldo->save();
        
        KasPiutang::find($kas->id_kpiutang)->delete();
        Kas::find($req->id_kas)->delete();
        return response()->json(['hasil' => true]);
    }
}
