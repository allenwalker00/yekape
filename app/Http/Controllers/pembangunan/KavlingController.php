<?php

namespace App\Http\Controllers\pembangunan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use PDF;
use Response;
use App\Models\Kavling;
use App\Models\KavlingStatus;
use Auth;

class KavlingController extends Controller
{
    public function link($id = null)
    {
        if($id == null){
            $data = null;            
        }else{
            $data = Kavling::find($id);
        }

        $status = KavlingStatus::get();
        $cluster = Kavling::select('cluster')->groupBy('cluster')->get();
        // dd($cluster);

        return view('pembangunan.kavling', ['data' => $data, 'status' => $status, 'cluster' => $cluster]);
    }

    public function data($filter)
    {
        $f = explode(';', $filter);

        // if ($f[0] == 0) {
        //     $query = Keluar::with('keperluan')
        //             ->select('*')
        //             ->where('batal', 0)
        //             ->WhereBetween('tgl_terimabon', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))]);
        // }else{
        //     $query = Keluar::with('keperluan')
        //             ->select('*')
        //             ->where('batal', 0)
        //             ->where('id_keperluan', $f[0])
        //             ->WhereBetween('tgl_terimabon', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))]);
        // }
        // $x = "VILLA";

        $query = Kavling::with('kavlingstatus')->where('batal', 0);

        
        
        if ($f[0] != "0") {
        	$query->where('cluster', 'LIKE', '%'.$f[0].'%');
        }

        if ($f[1] != 0) {
        	$query->where('status', $f[1]);
        }

        $query->get();

        return Datatables::of($query)
                        ->addColumn('menu', function($model) {
                            $hapus = '<a onclick="return confirm(\'Apakah anda yakin untuk membatalkan data ini ?\')"  href="'.route('pembangunankavling-hapus', ['id' => $model->id]).'"><button class="btn btn-sm btn-outline-dark btn-icon btn-elevate flaticon-delete"></button></a>';
                            // $update = '<a onclick="return confirm(\'Apakah anda yakin untuk membatalkan data ini ?\')"  href="'.route('pembangunankavling-update', ['id' => $model->id, 'id_keperluan' => $model->id_keperluan]).'" class="flaticon-edit"></a>';
                            
                            // $recid = $model->id . '.' . $model->id_keperluan;

                            // $update = '<a onclick="update(' . $recid . ')"  class="flaticon-edit" data-toggle="modal"></a>';
                            // $edit = '<a href="' . route("pembangunankavling-link", ['id' => $model->id]) . '"><button class="btn btn-sm btn-outline-dark btn-icon btn-elevate flaticon-edit"></button></a>';
                            
                            // if (Auth::user()->tipe == 'Admin') {
                            //     return $hapus . '&nbsp;' . $edit;
                            // }else{
                            if($model->status == null)
                            	return $hapus;
                        	else
                        		return '';
                            // }
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }



    public function simpan(Request $req){
        // dd($req->all());

        if($req->flag == 1){
        	if($req->dlist == null){
        		$data = new Kavling;
	            $data->cluster = strtoupper($req->cluster);
	            $data->blok = strtoupper($req->blok);
	            $data->nomor = strtoupper($req->nomor);
	            $data->tipe = $req->tipe;
	            $data->luas_bangun = str_replace('.', '', $req->luas_bangun);
	            $data->luas_tanah = str_replace('.', '', $req->luas_tanah);
	            $data->user_entry = Auth::user()->username;
	            $data->doc = date('Y-m-d H:i:s');
	            $data->save();
        	}else{
        		foreach ($req->dlist as $row) {
                    $temp = explode('#', $row);
                    $cluster = $temp[0];
                    $blok = $temp[1];
                    $nomor = $temp[2];
                    $tipe = $temp[3];
                    $luas_bangun = str_replace('.', '', $temp[4]);
                    $luas_tanah = str_replace('.', '', $temp[5]);

                    $data = new Kavling;
		            $data->cluster = strtoupper($cluster);
		            $data->blok = strtoupper($blok);
		            $data->nomor = strtoupper($nomor);
		            $data->tipe = $tipe;
		            $data->luas_bangun = str_replace('.', '', $luas_bangun);
		            $data->luas_tanah = str_replace('.', '', $luas_tanah);
		            $data->user_entry = Auth::user()->username;
		            $data->doc = date('Y-m-d H:i:s');
		            $data->save();
                }
        	}
        	
        }else{
            $data = Keluar::find($req->id);
            $data->id_keperluan = $req->keperluan;
            $data->keterangan = $req->keterangan;
            $data->save();
        }
        
        return redirect()->route('pembangunankavling-link');
    }

    public function hapus($id){
        $data = Keluar::find($id);
        $data->batal = 1;
        $data->tgl_batal = date('Y-m-d H:i:s');
        $data->update();

        return redirect()->route('pembangunankavling-link')->with(array('status' => 'Data berhasil dihapus', 'alert' => 'success'));
    }

    // public function detail(Request $req){
    //     // dd($req->all());

    //     $data = Keluar::find($req->id);

    //     // dd($data);
    //     // return redirect()->route('pembangunankavling-link')->with(array('status' => 'Data berhasil dihapus', 'alert' => 'success'));
    //     return response()->json(['data' => $data]);
    // }

    public function cetak(Request $req){

        // dd($req->all());

        if($req->f_keperluan == 0){
            $data = Keluar::select('*')
                    ->where('batal', 0)
                    ->WhereBetween('tgl_terimabon', [date('Y-m-d',strtotime($req->tgl_start)), date('Y-m-d',strtotime($req->tgl_end))])
                    ->get();
        }else{
            $data = Keluar::select('*')
                    ->where('batal', 0)
                    ->where('id_keperluan', $req->f_keperluan)
                    ->WhereBetween('tgl_terimabon', [date('Y-m-d',strtotime($req->tgl_start)), date('Y-m-d',strtotime($req->tgl_end))])
                    ->get();
        }

        


        PDF::SetTitle('Rekapitulasi Pengajuan Pembayaran');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetMargins(15, 15, 15, 15);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('P', 'A4');
        PDF::SetFont('times', '', 9, '', false);
        PDF::writeHTML(view('umum.keluarcetak',['data' => $data, 'tgl_start' => $req->tgl_start, 'tgl_end' => $req->tgl_end])->render(), true, false, false, false, '');
        
        return Response::make(PDF::Output('Rekapitulasi Pengajuan Pembayaran', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }
}
