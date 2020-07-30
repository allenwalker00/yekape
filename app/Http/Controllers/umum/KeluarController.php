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
        $tmp = explode(';', $filter);
        $query = Keluar::select('*');

        return Datatables::of($query)
                        ->addColumn('menu', function($model) {
                            $edit = '<a href="' . route("keluar-link", ['id' => $model->id]) . '"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>';
                            $hapus = '<button type="button" onclick="hapus(' . $model->id . ')" class="btn btn-sm btn-danger">Hapus</button>';
                            return $edit . ' ' . $hapus;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }



    public function simpan(Request $req){
        dd($req->all());

        if($req->tipe == 1){
        	$data = new Keluar;
            $data->tanggal = date('Y-m-d', strtotime($req->tanggal));
            $data->keperluan = strtoupper($req->keperluan);
            $data->keterangan = strtoupper($req->keterangan);
            $data->jumlah = str_replace('.', '', $req->jumlah);
            $data->save();
        }else{

        }
        
        return redirect()->route('keluar-link');
    }

    public function hapus(Request $req){
        // Keluar::find($req->id)->delete();
        return response()->json(['hasil' => true]);
    }

    public function cetak(Request $req){

        // dd($req->all());

        PDF::SetTitle('Data Keluar');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // PDF::SetMargins(15, 15, 10,20);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('L', 'A4');
        PDF::SetFont('times', '', 9, '', false);
        PDF::writeHTML(view('master.cetakkeluar',['data' => $data, 'kab' => $kab, 'kec' => $kec])->render(), true, false, false, false, '');
        
        return Response::make(PDF::Output('Data keluar', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }
}
