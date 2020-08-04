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

class MasterKeperluanController extends Controller
{
    public function link($id = null)
    {
        if($id == null){
            $data = null;
        }else{
            $data = MasterKeperluan::find($id);
        }
        
        return view('umum.masterkeperluan', ['data' => $data]);
    }

    public function data()
    {
        $query = MasterKeperluan::where('batal', 0)->get();

        return Datatables::of($query)
                        ->addColumn('menu', function($model) {
                            $hapus = '<a onclick="return confirm(\'Apakah anda yakin untuk membatalkan data ini ?\')"  href="'.route('mkeperluan-hapus', ['id' => $model->id]).'" class="btn btn-sm btn-danger">Hapus</a>';
                            return $hapus;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }



    public function simpan(Request $req){
        // dd($req->all());

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
        
        return redirect()->route('mkeperluan-link');
    }

    public function hapus($id){
        $data = MasterKeperluan::find($id);
        $data->batal = 1;
        $data->tgl_batal = date('Y-m-d H:i:s');
        $data->user_batal = Auth::user()->username;
        $data->update();

        return redirect()->route('mkeperluan-link')->with(array('status' => 'Data berhasil dihapus', 'alert' => 'success'));
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
