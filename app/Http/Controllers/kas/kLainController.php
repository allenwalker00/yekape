<?php

namespace App\Http\Controllers\kas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Response;
use Auth;
use App\Models\Transaksi;
use App\Models\Saldo;

class kLainController extends Controller
{
    public function link($id_transaksi = null){
        if($id_transaksi == null){
            $data = null;
        }else{
            $data = Transaksi::find($id_transaksi);
        }
        
        $q = Saldo::select('*')->OrderBy('id', 'DESC')->first();

        if (!empty($q)) {
            $saldo = $q->saldo_akhir;
        }else{
            $saldo = 0;
        }

        // dd($saldo);

        return view('kas.lain', ['data' => $data, 'saldo' => $saldo]);
    }

    public function data($filter){
        $query = Transaksi::where('kd_transaksi', 'LL')->select('*');

        // if($filter <> '0'){
        //     $query->where('jenis_kas', $filter);
        // }

        $query->OrderBy('id_transaksi', 'ASC');

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
            $data->kd_transaksi = 'LL';
	        $data->tgl_transaksi = date('Y-m-d', strtotime($req->tgl_transaksi));
            $data->rp_lain = $rp_lain;
            $data->ket_lain = $req->keterangan;
            $data->pay_flow = $req->pay_flow;
            $data->pay_method = $req->pay_method;
	        $data->rek_bayar = $req->rek_bayar;
            // $data->entry = Auth::user()->id;
            // $data->entry_date = date('Y-m-d H:i:s');
            $data->save();

	        $saldo = new Saldo;
            $saldo->id_transaksi = $data->id_transaksi;
            $saldo->tanggal = date('Y-m-d', strtotime($data->tgl_transaksi));
            if($data->pay_flow == 'db'){
                $saldo->debit = $data->rp_lain;
                $saldo->saldo_akhir = $saldo_akhir - $data->rp_lain;
            }else{
                $saldo->kredit = $data->rp_lain;
                $saldo->saldo_akhir = $saldo_akhir + $data->rp_lain;
            }
            $saldo->kd_transaksi = 'LL';
            $saldo->keterangan = $data->ket_lain;
            $saldo->save();
	    }

        return redirect()->route('klain-link');
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
        $saldo->keterangan = 'hapus kas lain';
        $saldo->save();
    	
    	KasLain::find($kas->id_klain)->delete();
        Kas::find($req->id_kas)->delete();
        return response()->json(['hasil' => true]);
    }
}