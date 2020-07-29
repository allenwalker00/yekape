<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use PDF;
use Response;
use App\Models\Gudang;

class GudangController extends Controller
{
    public function link($id_gudang = null)
    {
        if($id_gudang == null){
            $data = null;
        }else{
            $data = Gudang::find($id_gudang);
        }

        return view('master.gudang', ['data' => $data]);
    }

    public function data()
    {
        $query = Gudang::select('*');

        return Datatables::of($query)
                        ->addColumn('menu', function($model) {

                            $edit = '<a href="' . route("gudang-link", ['id_gudang' => $model->id_gudang]) . '"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>';
                            $hapus = '<button type="button" onclick="hapus(' . $model->id_gudang . ')" class="btn btn-sm btn-danger">Hapus</button>';

                            return $edit . ' ' . $hapus;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }



    public function simpan(Request $req){
        if($req->tipe == 1){
            $data = new Gudang;
            $data->nama_gudang = $req->nama_gudang;
            $data->pemilik = $req->pemilik;
            $data->direksi = $req->direksi;
            $data->alamat_gudang = $req->alamat_gudang;
            $data->telp = $req->telp;
            $data->hp = $req->hp;
            $data->save();
        }else{
            $data = Gudang::find($req->id_gudang);
            $data->nama_gudang = $req->nama_gudang;
            $data->pemilik = $req->pemilik;
            $data->direksi = $req->direksi;
            $data->alamat_gudang = $req->alamat_gudang;
            $data->telp = $req->telp;
            $data->hp = $req->hp;
            $data->save();
        }

        return redirect()->route('gudang-link');
    }

    public function hapus(Request $req){
        Gudang::find($req->id_gudang)->delete();
        return response()->json(['hasil' => true]);
    }

    public function cetak(Request $req){

        // dd($req->all());

        
        $data = Gudang::select('*')->get();
    

        // return response()->json($data);

        PDF::SetTitle('Data Gudang');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // PDF::SetMargins(15, 15, 10,20);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('L', 'A4');
        PDF::SetFont('times', '', 9, '', false);
        PDF::writeHTML(view('master.cetakgudang',['data' => $data])->render(), true, false, false, false, '');
        
        return Response::make(PDF::Output('Data Gudang', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }
}
