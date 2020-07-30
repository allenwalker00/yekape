<?php

namespace App\Http\Controllers\umum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use PDF;
use Response;
use App\Models\Keluar;

class KeluarController extends Controller
{
    public function link($id = null)
    {
        if($id == null){
            $data = null;
        }else{
            $data = Keluar::find($id);
        }

        // $kab = Keluar::distinct()->orderBy('kabupaten', 'ASC')->get(['kabupaten']);

        // dd($kab);
        
        return view('umum.keluar', ['data' => $data]);
    }

    public function data($filter)
    {
        $f = explode(';', $filter);

        $query = Keluar::select('*')
        		->where('batal', 0)
        		->WhereBetween('tanggal', [date('Y-m-d',strtotime($f[0])), date('Y-m-d',strtotime($f[1]))]);

        return Datatables::of($query)
                        ->addColumn('menu', function($model) {
                            $hapus = '<a onclick="return confirm(\'Apakah anda yakin untuk membatalkan data ini ?\')"  href="'.route('keluar-hapus', ['id' => $model->id]).'" class="btn btn-sm btn-danger">Hapus</a>';
                            return $hapus;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }



    public function simpan(Request $req){
        // dd($req->all());

        if($req->tipe == 1){
        	$data = new Keluar;
            $data->tanggal = date('Y-m-d', strtotime($req->tanggal));
            $data->keperluan = strtoupper($req->keperluan);
            $data->keterangan = strtoupper($req->keterangan);
            $data->jumlah = str_replace('.', '', $req->jumlah);
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

    public function cetak(Request $req){

        // dd($req->all());

        $data = Keluar::select('*')
        		->where('batal', 0)
        		->WhereBetween('tanggal', [date('Y-m-d',strtotime($req->tgl_start)), date('Y-m-d',strtotime($req->tgl_end))])
        		->get();


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
