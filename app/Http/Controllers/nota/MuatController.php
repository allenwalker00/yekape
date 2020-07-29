<?php

namespace App\Http\Controllers\nota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Response;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Truk;
use App\Models\Seleb;
use App\Models\Gudang;
use Auth;

class MuatController extends Controller
{
    public function link($id_transaksi = null)
    {
        if($id_transaksi == null){
            $data = null;
            $detail = null;
        }else{
            $data = Transaksi::with('truk')->find($id_transaksi);
            $detail = Muat::with('seleb')->select('*')->where('id_transaksi', $id_transaksi)->get();
        }

        $truk = Truk::select('*')->OrderBy('nama_supir', 'ASC')->get();
        $seleb = Seleb::select('*')->OrderBy('nama_seleb', 'ASC')->get();

        // dd($detail);
        
        return view('nota.muat', ['data' => $data, 'detail' => $detail, 'truk' => $truk, 'seleb' => $seleb]);
    }

    public function data($filter)
    {
    	$query = Transaksi::with('truk','detail')->select('*')
                        ->where('kd_transaksi', 'MB')
                        ->OrderBy('id_transaksi')
                        ->OrderBy('no_nota');

         // return response()->json($query);

        // if($filter == '1'){
        //     $query->where('tgl_bongkar', null);
        // }

        // if($filter == '2'){
        //     $query->where('tgl_bongkar', '<>', null);
        // }

        // if($filter == '3'){
        //     $query->where('entry_batal', '<>', null);
        // }else{
        //     $query->where('entry_batal', null);
        // }

        return Datatables::of($query)
        				// ->editColumn('truk.nama_supir', function($model) {
	           //                  return $model->truk->nama_supir . ' - ' . $model->truk->nopol;
	           //           	})
            //             ->editColumn('harga_muat', function($model) {
            //                     return "Rp " . number_format($model->harga_muat,0,',','.');
            //                 })
                        ->addColumn('menu', function($model) {
                            // if($model->lunas_muat == null && $model->tgl_bongkar == null && $model->entry_batal == null){
                            //     $edit = '<a href="' . route("muat-link", ['id_transaksi' => $model->id_transaksi]) . '"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>';
                            //     $batal = '<button type="button" onclick="batal(' . $model->id_transaksi . ')" class="btn btn-sm btn-danger">Batal</button>';
                            // }else{
                                $edit = '';
                                $batal = '';
                            // }
                            
                            $list = '<button type="button" onclick="detail(' . $model->id_transaksi . ')" class="btn btn-sm btn-success" data-toggle="modal">Detail</button>';
                            return $list;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }

    public function simpan(Request $req){

        // dd($req->all());

        if($req->tipe == 1){
            if($req->dmuat != null){

                $berat_muat_total = 0;
                $rp_muat_total = 0;
                
                // $nota = Transaksi::max('no_nota');
                // if($nota == null)
                //     $nota = 1;
                // else
                //     $nota += 1;

                $data = new Transaksi;
                $data->kd_transaksi = 'MB';
                // $data->no_nota = $nota;
                $data->tgl_muat = date('Y-m-d', strtotime($req->tgl_muat));
                $data->id_truk = $req->id_truk;
                $data->save();

                foreach ($req->dmuat as $row) {
                    $temp = explode('#', $row);
                    $seleb = $temp[0];
                    $berat = str_replace('.', '', $temp[1]);
                    $harga = str_replace('.', '', $temp[2]);
                    $total = $berat * $harga;

                    $detil = new TransaksiDetail;
                    $detil->id_transaksi = $data->id_transaksi;
                    $detil->kd_transaksi = 'M';
                    $detil->id_seleb = $seleb;
                    $detil->berat = $berat;
                    $detil->harga = $harga;
                    $detil->keterangan = 'Transaksi Muat Seleb';
                    $detil->rp_tagihan = $total;
                    $detil->save();

                    $berat_muat_total += $berat;
                    $rp_muat_total += $total;
                }

                $data->berat_muat = $berat_muat_total;
                $data->rp_muat = $rp_muat_total;
                $data->save();

                $detil = new TransaksiDetail;
                $detil->id_transaksi = $data->id_transaksi;
                $detil->kd_transaksi = 'B';
                $detil->save();
            }
        }

        return redirect()->route('muat-link');
    }

    public function batal(Request $req){

        $transaksi = Transaksi::find($req->id_transaksi);
        $transaksi->entry_batal = Auth::user()->id;
        $transaksi->entry_batal_date = date('Y-m-d H:i:s');
        $transaksi->save();

        $kasmuat = KasMuat::where('id_transaksi', $req->id_transaksi)->select('*')->get();
        foreach ($kasmuat as $row) {
            $row->batal_entry = Auth::user()->id;
            $row->batal_date = date('Y-m-d H:i:s');;
            $row->save();

            Kas::where('id_kmuat', $row->id_kmuat)->update([
            'batal_entry' => Auth::user()->id,
            'batal_date' => date('Y-m-d H:i:s')
        ]);
        }
        
        return response()->json(['hasil' => true]);
    }

    public function detail(Request $req){
        $data = TransaksiDetail::with('seleb')
                            ->where('id_transaksi', $req->id_transaksi)
                            ->where('kd_transaksi', 'M')
                            ->get();
        return response()->json(['data' => $data]);
    }
}
