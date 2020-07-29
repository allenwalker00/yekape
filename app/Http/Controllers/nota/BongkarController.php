<?php

namespace App\Http\Controllers\nota;

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

class BongkarController extends Controller
{
    public function link($id_transaksi = null)
    {
        if($id_transaksi == null){
            $data = null;
            $d_muat = null;
            $d_bongkar = null;
        }else{
            $data = Transaksi::with('truk', 'gudang')->find($id_transaksi);
            $d_muat = TransaksiDetail::with('seleb')
                                    ->where('id_transaksi', $id_transaksi)
                                    ->where('kd_transaksi', 'M')
                                    ->select('*')->get();
            $d_bongkar = TransaksiDetail::where('id_transaksi', $id_transaksi)
                                    ->where('kd_transaksi', 'B')
                                    ->select('*')->first();
            // dd($d_bongkar);
        }

        $gudang = Gudang::select('*')->OrderBy('nama_gudang', 'ASC')->get();

        
        
        return view('nota.bongkar', ['data' => $data, 'd_muat' => $d_muat, 'd_bongkar' => $d_bongkar, 'gudang' => $gudang]);
    }

    public function data($filter)
    {
        
        $query = Transaksi::with('truk', 'gudang')
                        ->with(['detail' => function ($q) {
                            $q->select('*');
                            $q->where('kd_transaksi', 'B');
                        }]);

        if($filter == '1'){
            $query->where('tgl_bongkar', null);
        }
        if($filter == '2'){
            $query->where('tgl_bongkar', '<>', null);
        }

        $query->where('kd_transaksi', 'MB')
                ->select('*')
                ->orderBy('id_gudang')
                ->orderBy('no_nota')
                ->get();

        // return response()->json($query);

        return Datatables::of($query)
        				->editColumn('kd_transaksi', function($model) {
                                $det = TransaksiDetail::with('seleb')->where('id_transaksi', $model->id_transaksi)->where('kd_transaksi', 'M')->select('*')->get();
                                $result = "";
                                foreach ($det as $d) {
                                    $result .= $d->seleb->nama_seleb . " ";
                                }
                                return $result;                           
	                     	})
                        ->editColumn('rek_bayar', function($model) {
                                $det = TransaksiDetail::where('id_transaksi', $model->id_transaksi)->where('kd_transaksi', 'B')->select('*')->first();
                                
                                return number_format($det->berat,0,',','.');                          
                            })
                         ->editColumn('rek_tujuan', function($model) {
                                $det = TransaksiDetail::where('id_transaksi', $model->id_transaksi)->where('kd_transaksi', 'B')->select('*')->first();
                                
                                return number_format($det->harga,0,',','.');                         
                            })
                        ->addColumn('menu', function($model) {
                            if($model->tgl_bongkar == null){
                                $bongkar = '<a href="' . route("bongkar-link", ['id_transaksi' => $model->id_transaksi]) . '"><button type="button" class="btn btn-sm btn-success">Bongkar</button></a>';
                            }else{
                                $bongkar = '';
                            }
                            // $list = '<button type="button" onclick="listSeleb(' . $model->id_transaksi . ')" class="btn btn-sm btn-success" data-toggle="modal">Detail</button>';
                            return $bongkar;// . ' ' . $hapus . ' ' . $list;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }

    public function simpan(Request $req){

        // dd($req->all());

        $berat = str_replace('.', '', $req->berat_bongkar);
        $harga = str_replace('.', '', $req->harga_bongkar);
        $ongkos = str_replace('.', '', $req->ongkos_truk);

        $nota = Transaksi::where('id_gudang', $req->id_gudang)->max('no_nota');
        if($nota == null)
            $nota = 1;
        else
            $nota += 1;

        $detail = TransaksiDetail::find($req->recid_bongkar);
        $detail->berat = $berat;
        $detail->harga = $harga;
        $detail->keterangan = 'Transaksi Bongkar';
        $detail->rp_tagihan = $berat * $harga;
        $detail->save();

        $data = Transaksi::find($req->id_transaksi);
        $data->no_nota = $nota;
        $data->id_gudang = $req->id_gudang;
        $data->tgl_bongkar = date('Y-m-d', strtotime($req->tgl_bongkar));
        $data->berat_bongkar = $berat;
        $data->rp_bongkar = $berat * $harga;
        $data->rp_ongkir = $ongkos;
        // $data->entry_bongkar_date = date('Y-m-d H:i:s');
        $data->save();

        $gudang = Gudang::find($req->id_gudang);
        $gudang->saldo += $data->rp_bongkar;
        $gudang->save();       

        return redirect()->route('bongkar-link');
    }


    // public function listSeleb(Request $req){
    //     $data = Muat::with('seleb')->where('id_transaksi', '=', $req->id_transaksi)->get();
    //     return response()->json(['data' => $data]);
    // }
}
