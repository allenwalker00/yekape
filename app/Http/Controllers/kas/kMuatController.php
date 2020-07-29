<?php

namespace App\Http\Controllers\kas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Response;
use Auth;
use App\Models\Saldo;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiPayment;
use App\Models\Seleb;
use App\Models\Gudang;
use App\Models\Truk;

class kMuatController extends Controller
{
    public function link($recid = null)
    {
        if($recid == null){
            $data = null;
            $transaksi = null;
        }else{
            $data = TransaksiDetail::find($recid);
            $transaksi = Transaksi::find($data->id_transaksi);
        }

        $seleb = Seleb::select('*')->get();
        $q = Saldo::select('*')->OrderBy('id', 'DESC')->first();

        if (!empty($q)) {
            $saldo = $q->saldo_akhir;
        }else{
            $saldo = 0;
        }

        // dd($data);

        return view('kas.muat', ['data' => $data, 'transaksi' => $transaksi, 'saldo' => $saldo, 'seleb' => $seleb]);
    }

    public function data($filter)
    {   
        $f = explode(';', $filter);

        // dd($f[0]);

        $query = TransaksiDetail::with('seleb', 'transaksi')
                        ->where('transaksi_detail.kd_transaksi', 'M');
                        // ->select('*')
                        // ->OrderBy('recid', 'ASC');

        // $query = Kas::whereHas('kasmuat')
        //             ->with('kasmuat')
        //             ->with('kasmuat.transaksi')
        //             ->with('kasmuat.muat')
        //             ->with('kasmuat.muat.seleb')
        //             ->where('kas_transaksi.batal_date', null)
        //             ->select('*');
        if($f[0] != 0){
            $query->where('id_seleb', $f[0]);
        }
        if($f[1] == '2'){
            $query->where('tgl_lunas', null);
        }
        if($f[1] == '1'){
            $query->where('tgl_lunas', '<>', null);
        }
        // $query->where('b_detailmuat.entry_batal_date', null)->OrderBy('id_muat', 'DESC');

        // $query = DB::table('b_kas')
        //         ->leftJoin('m_seleb', 'b_kas.id_seleb', '=', 'm_seleb.id_seleb');
                

        // if($f[0] != 0){
        //     $query->where('b_kas.id_seleb', $f[0]);
        // }

        $query->select('*')->OrderBy('recid', 'ASC');
        // dd($query);

        return Datatables::of($query)
        				// ->editColumn('rp_muat', function($model) {
            //                     return "Rp " . number_format($model->rp_muat,0,',','.');
            //                 })
                        ->addColumn('menu', function($model) {
                            if($model->tgl_lunas == null)
                                $bayar = '<a href="' . route("kmuat-link", ['recid' => $model->recid]) . '"><button type="button" class="btn btn-sm btn-success">Bayar</button></a>';
                            else
                                $bayar = '';
                            // $hapus = '<button type="button" onclick="hapus(' . $model->id_kas . ')" class="btn btn-sm btn-danger">Hapus</button>';

                            return $bayar;
                        })
                        ->rawColumns(['menu'])
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

        $rp_tagihan = str_replace('.', '', $req->rp_tagihan);
        $rp_bayar = str_replace('.', '', $req->rp_bayar);
        $rp_deposit = str_replace('.', '', $req->deposit);

        $data = TransaksiDetail::find($req->recid);

        $payment = new TransaksiPayment;
        $payment->recid_transaksi = $req->recid;
        $payment->tgl_kas = date('Y-m-d', strtotime($req->tgl_bayar));
        $payment->keterangan = 'Pembayaran Seleb ' . $req->nama_seleb;
        $payment->rp_tagihan = $rp_tagihan;
        
        if($req->pay_type == 'deposit'){
            $payment->rp_bayar_deposit = $rp_bayar;
            $data->tgl_lunas = date('Y-m-d', strtotime($req->tgl_bayar));
            
            $seleb = Seleb::find($data->id_seleb);
            $seleb->saldo -= $rp_tagihan;
            $seleb->save();
        }elseif($req->pay_type == 'split') {
            $payment->rp_bayar_deposit = $rp_deposit;
            $payment->rp_bayar = $rp_bayar;

            if($rp_deposit + $rp_bayar < $rp_tagihan){
                $payment->rp_kekurangan = $rp_tagihan - $rp_deposit - $rp_bayar;
            }else{
                $data->tgl_lunas = date('Y-m-d', strtotime($req->tgl_bayar));
            }

            $seleb = Seleb::find($data->id_seleb);
            $seleb->saldo -= ($rp_deposit);
            $seleb->save();
        }else{
            $payment->rp_bayar = $rp_bayar;
            if($rp_bayar < $rp_tagihan){
                $payment->rp_kekurangan = $rp_tagihan - $rp_bayar;
            }else{
                $data->tgl_lunas = date('Y-m-d', strtotime($req->tgl_bayar));
                
                $seleb = Seleb::find($data->id_seleb);
                $seleb->saldo += ($rp_bayar - $rp_tagihan);
                $seleb->save();
            }
        }

        $payment->pay_flow = 'db';
        $payment->pay_method = $req->pay_method;
        $payment->pay_type = $req->pay_type;
        $payment->rek_bayar = $req->rek_bayar;
        $payment->rek_tujuan = $req->rek_tujuan;
        $payment->save();

        // $data->entry = Auth::user()->id;
        // $data->entry_date = date('Y-m-d H:i:s');
        $data->save();

        
        if($payment->pay_type != 'deposit'){
            $saldo = new Saldo;
            $saldo->id_transaksi = $data->id_transaksi;
            $saldo->tanggal = date('Y-m-d', strtotime($req->tgl_bayar));
            $saldo->debit = $payment->rp_bayar;
            $saldo->saldo_akhir = $saldo_akhir - $payment->rp_bayar;
            $saldo->kd_transaksi = 'M';
            $saldo->keterangan = $payment->keterangan;
            $saldo->save();
        }

        return redirect()->route('kmuat-link');
    }

    public function hapus(Request $req){
        Transaksi::find($req->id_transaksi)->delete();
        Bongkar::where('id_transaksi', $req->id_transaksi)->delete();
        return response()->json(['hasil' => true]);
    }

    public function listSeleb(Request $req){
        $data = Muat::with('seleb')->where('id_transaksi', '=', $req->id_transaksi)->get();
        return response()->json(['data' => $data]);
    }
}
