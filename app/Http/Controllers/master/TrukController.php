<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use PDF;
use Response;
use App\Models\Truk;

class TrukController extends Controller
{
    public function link($id_truk = null)
    {
        if($id_truk == null){
            $data = null;
        }else{
            $data = Truk::find($id_truk);
        }

        return view('master.truk', ['data' => $data]);
    }

    public function data()
    {
        $query = Truk::select('*');

        return Datatables::of($query)
                        ->addColumn('menu', function($model) {

                            $edit = '<a href="' . route("truk-link", ['id_truk' => $model->id_truk]) . '"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>';
                            $hapus = '<button type="button" onclick="hapus(' . $model->id_truk . ')" class="btn btn-sm btn-danger">Hapus</button>';

                            return $edit . ' ' . $hapus;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }



    public function simpan(Request $req){
        if($req->tipe == 1){
            $data = new Truk;
            $data->kode_truk = $req->kode_truk;
            $data->nopol = $req->nopol;
            $data->nama_supir = $req->nama_supir;
            $data->alamat_supir = $req->alamat_supir;
            $data->hp = $req->hp;
            $data->save();
        }else{
            $data = Truk::find($req->id_truk);
            $data->kode_truk = $req->kode_truk;
            $data->nopol = $req->nopol;
            $data->nama_supir = $req->nama_supir;
            $data->alamat_supir = $req->alamat_supir;
            $data->hp = $req->hp;
            $data->save();
        }

        return redirect()->route('truk-link');
    }

    public function hapus(Request $req){
        Truk::find($req->id_truk)->delete();
        return response()->json(['hasil' => true]);
    }

    public function cetak(Request $req){

        // dd($req->all());

        
        $data = Truk::select('*')->get();
    

        // return response()->json($data);

        PDF::SetTitle('Data Truk');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // PDF::SetMargins(15, 15, 10,20);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('L', 'A4');
        PDF::SetFont('times', '', 9, '', false);
        PDF::writeHTML(view('master.cetaktruk',['data' => $data])->render(), true, false, false, false, '');
        
        return Response::make(PDF::Output('Data Truk', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }

}
