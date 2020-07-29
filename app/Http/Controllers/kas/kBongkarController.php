<?php

namespace App\Http\Controllers\kas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Response;
use Auth;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiPayment;
use App\Models\Truk;
use App\Models\Gudang;
use App\Models\Seleb;
use App\Models\Saldo;

class kBongkarController extends Controller
{
     public function link($id_transaksi = null)
    {
        $tagihan = 0;

        if($id_transaksi == null){
            $data = null;
            $detail = null;
            $tagihan = null;
        }else{
            $data = Transaksi::find($id_transaksi);
            $detail = TransaksiDetail::where('id_transaksi', $data->id_transaksi)
                                    ->where('kd_transaksi', 'B')
                                    ->select('*')
                                    ->first();
            $payment = TransaksiPayment::where('recid_transaksi', $detail->recid)
                                    ->select('*')
                                    ->first();
            if(is_null($payment)){
                $tagihan = $detail->rp_tagihan;
            }else{
                $tagihan = $payment->rp_kekurangan;
            }
        }

        $q = Saldo::select('*')->OrderBy('id', 'DESC')->first();

        if (!empty($q)) {
            $saldo = $q->saldo_akhir;
        }else{
            $saldo = 0;
        }
        
        // return response()->json($data);
        
        return view('kas.bongkar', ['data' => $data, 'detail' => $detail, 'saldo' => $saldo, 'tagihan' => $tagihan]);
    }

    public function data($filter)
    {
        $query = Transaksi::with('gudang', 'truk', 'detail.seleb')
                        ->where('kd_transaksi', 'MB')
                        ->where('id_gudang', '<>', null);

        if ($filter == 1){
            $query->where('tgl_lunas_bongkar', '<>', null);
        }

        if ($filter == 2){
            $query->where('tgl_lunas_bongkar', null);
        }
        
        
        $query->select('*')->OrderBy('id_transaksi', 'ASC');

                       // dd($query);

        // $query = Gudang::whereHas('kasbongkar')
        //             // ->with('kasbongkar')
        //             ->with('kasbongkar.transaksi', 'kasbongkar.bongkar.gudang')
        //             // ->with('kasbongkar.bongkar')
        //             ->select('*')
        //             ->orderBy('kasbongkar.bongkar.id_gudang', 'ASC');        

        return Datatables::of($query)
                        ->editColumn('kd_transaksi', function($model) {
                            // $det = TransaksiDetail::with('seleb')->where('id_transaksi', $model->id_transaksi)->where('kd_transaksi', 'M')->select('*')->get();
                            $result = "";                            
                            foreach ($model->detail as $d) {
                                if ($d->id_seleb != null)
                                    $result .= $d->seleb->nama_seleb . " ";
                            }
                            return $result;                      
                        })
                        ->editColumn('rek_bayar', function($model) {
                            // $det = TransaksiDetail::where('id_transaksi', $model->id_transaksi)->where('kd_transaksi', 'B')->select('*')->first();
                            // return $det->harga;        
                            foreach ($model->detail as $d) {
                                if ($d->kd_transaksi = 'B')
                                    return $d->harga;
                            }              
                        })
                        ->editColumn('rp_lain', function($model) {
                            $det = TransaksiDetail::where('id_transaksi', $model->id_transaksi)->where('kd_transaksi', 'B')->select('*')->first();
                            $pay = TransaksiPayment::where('recid_transaksi', $det->recid)->select('*')->get();

                            $result = 0;
                            foreach ($pay as $d) {
                                $result += $d->rp_bayar;
                            }

                            return $result;
                        })
                        ->editColumn('rp_muat', function($model) {
                            $det = TransaksiDetail::where('id_transaksi', $model->id_transaksi)->where('kd_transaksi', 'B')->select('*')->first();
                            $pay = TransaksiPayment::where('recid_transaksi', $det->recid)->select('*')->orderby('recid', 'DESC')->first();

                            if ($pay != null) {
                                return $pay->rp_kekurangan;
                            }
                            
                        })
                        ->addColumn('menu', function($model) {
                            $det = TransaksiDetail::where('id_transaksi', $model->id_transaksi)->where('kd_transaksi', 'B')->select('*')->first();
                            if($det->tgl_lunas == null)
                                $bayar = '<a href="' . route("kbongkar-link", ['id_transaksi' => $model->id_transaksi]) . '"><button type="button" class="btn btn-sm btn-success">Bayar</button></a>';
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

        $transaksi = Transaksi::find($req->id_transaksi);
        $data = TransaksiDetail::find($req->recid);

        $payment = new TransaksiPayment;
        $payment->recid_transaksi = $req->recid;
        $payment->tgl_kas = date('Y-m-d', strtotime($req->tgl_bayar));
        $payment->keterangan = 'Pembayaran dari ' . $req->nama_gudang;
        $payment->rp_tagihan = $rp_tagihan;
        
        
        $payment->rp_bayar = $rp_bayar;
        if($rp_bayar < $rp_tagihan){
            $payment->rp_kekurangan = $rp_tagihan - $rp_bayar;
        }else{
            $data->tgl_lunas = date('Y-m-d', strtotime($req->tgl_bayar));
            $transaksi->tgl_lunas_bongkar = date('Y-m-d', strtotime($req->tgl_bayar));
        }

        $gudang = Gudang::find($req->id_gudang);
        $gudang->saldo -= ($rp_bayar);
        $gudang->save();

        $payment->pay_flow = 'cr';
        $payment->pay_method = $req->pay_method;
        $payment->rek_bayar = $req->rek_bayar;
        $payment->rek_tujuan = $req->rek_tujuan;
        $payment->save();

        // $data->entry = Auth::user()->id;
        // $data->entry_date = date('Y-m-d H:i:s');
        $data->save();
        $transaksi->save();

        
        
        $saldo = new Saldo;
        $saldo->id_transaksi = $data->id_transaksi;
        $saldo->tanggal = date('Y-m-d', strtotime($req->tgl_bayar));
        $saldo->kredit = $payment->rp_bayar;
        $saldo->saldo_akhir = $saldo_akhir + $payment->rp_bayar;
        $saldo->kd_transaksi = 'B';
        $saldo->keterangan = $payment->keterangan;
        $saldo->save();

        return redirect()->route('kbongkar-link');
    }

    public function hapus(Request $req){
        Transaksi::find($req->id_transaksi)->delete();
        Bongkar::where('id_transaksi', $req->id_transaksi)->delete();
        return response()->json(['hasil' => true]);
    }

    public function listSeleb(Request $req){
        $data = Bongkar::with('seleb')->where('id_transaksi', '=', $req->id_transaksi)->get();
        return response()->json(['data' => $data]);
    }
}
