<?php

namespace App\Http\Controllers\umum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use PDF;
use Response;
use App\Models\Keluar;
use App\Models\MasterKeperluan;
use Auth;

class KeluarController extends Controller
{
    public function link($id = null)
    {
        if($id == null){
            $data = null;
            $keperluan = MasterKeperluan::get();
            return view('umum.keluar', ['data' => $data, 'keperluan' => $keperluan]);
        }else{
            $data = Keluar::find($id);
            return response()->json(['data' => $data]);
        }   
    }

    public function data($filter)
    {
        $f = explode(';', $filter);

        if ($f[0] == 0) {
            $query = Keluar::with('keperluan')
                    ->select('*')
                    ->where('batal', 0)
                    ->WhereBetween('tgl_terimabon', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))]);
        }else{
            $query = Keluar::with('keperluan')
                    ->select('*')
                    ->where('batal', 0)
                    ->where('id_keperluan', $f[0])
                    ->WhereBetween('tgl_terimabon', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))]);
        }

        return Datatables::of($query)
                        ->addColumn('menu', function($model) {
                            $hapus = '<a onclick="return confirm(\'Apakah anda yakin untuk membatalkan data ini ?\')"  href="'.route('keluar-hapus', ['id' => $model->id]).'" class="flaticon-delete"></a>';
                            // $update = '<a onclick="return confirm(\'Apakah anda yakin untuk membatalkan data ini ?\')"  href="'.route('keluar-update', ['id' => $model->id, 'id_keperluan' => $model->id_keperluan]).'" class="flaticon-edit"></a>';
                            
                            $recid = $model->id . '.' . $model->id_keperluan;
                            
                            $update = '<a onclick="update(' . $recid . ')"  class="flaticon-edit"></a>';
                            
                            if (Auth::user()->tipe == 'Admin') {
                                return $hapus . '    ' . $update;
                            }else{
                                return $hapus;
                            }
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }



    public function simpan(Request $req){
        dd($req->all());

        if($req->tipe == 1){
        	$data = new Keluar;
            $data->tgl_bon = date('Y-m-d', strtotime($req->tgl_bon));
            $data->tgl_terimabon = date('Y-m-d', strtotime($req->tgl_terimabon));
            $data->id_keperluan = $req->keperluan;
            // $data->keterangan = ucwords($req->keterangan);
            $data->keterangan = $req->keterangan;
            $data->jumlah = str_replace('.', '', $req->jumlah);
            $data->user_entry = Auth::user()->username;
            $data->doc = date('Y-m-d H:i:s');
            $data->save();
        }else{

        }
        
        return redirect()->route('keluar-link');
    }

    public function hapus($id){
        $data = Keluar::find($id);
        $data->batal = 1;
        $data->tgl_batal = date('Y-m-d H:i:s');
        $data->update();

        return redirect()->route('keluar-link')->with(array('status' => 'Data berhasil dihapus', 'alert' => 'success'));
    }

    public function update(Request $req){
        // dd($req->all());

        $data = Keluar::find($req->id);

        // dd($data);
        // return redirect()->route('keluar-link')->with(array('status' => 'Data berhasil dihapus', 'alert' => 'success'));
        return response()->json(['data' => $data]);
    }

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
