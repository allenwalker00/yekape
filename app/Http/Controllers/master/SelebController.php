<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use PDF;
use Response;
use App\Models\Seleb;

class SelebController extends Controller
{
    public function link($id_seleb = null)
    {
        if($id_seleb == null){
            $data = null;
        }else{
            $data = Seleb::find($id_seleb);
        }

        $kab = Seleb::distinct()->orderBy('kabupaten', 'ASC')->get(['kabupaten']);

        // dd($kab);
        
        return view('master.seleb', ['data' => $data, 'kab' => $kab]);
    }

    public function data($filter)
    {
        $tmp = explode(';', $filter);
        $query = Seleb::select('*');

        if($tmp[0] != '0'){
            $query->where('kabupaten', $tmp[0]);
        }

        if($tmp[1] != '0'){
            $query->where('kecamatan', $tmp[1]);
        }

        return Datatables::of($query)
                        ->editColumn('telp', function($model) {
                            if($model->telp <> null && $model->hp <> null){
                                return $model->telp . ' / ' . $model->hp;    
                            }else if($model->telp <> null && $model->hp == null){
                                return $model->telp;
                            }else if($model->telp == null && $model->hp <> null){
                                return $model->hp;
                            }else{
                                return '';
                            }
                            
                        })
                        ->editColumn('rek_bank', function($model) {
                            if($model->rek_nomor <> null){
                                return $model->rek_bank . ' / ' . $model->rek_nama .  ' / ' . $model->rek_nomor;    
                            }else{
                                return '';
                            }
                        })
                        ->addColumn('menu', function($model) {
                            $edit = '<a href="' . route("seleb-link", ['id_seleb' => $model->id_seleb]) . '"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>';
                            $hapus = '<button type="button" onclick="hapus(' . $model->id_seleb . ')" class="btn btn-sm btn-danger">Hapus</button>';
                            return $edit . ' ' . $hapus;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }



    public function simpan(Request $req){
        // dd($req->all());
        if($req->tipe == 1){
            $data = new Seleb;
            $data->nama_seleb = strtoupper($req->nama_seleb);
            $data->kecamatan = strtoupper($req->kecamatan);
            $data->kabupaten = strtoupper($req->kabupaten);
            $data->telp = $req->telp;
            $data->hp = $req->hp;
            $data->rek_bank = strtoupper($req->rek_bank);
            $data->rek_nama = strtoupper($req->rek_nama);
            $data->rek_nomor = $req->rek_nomor;
            $data->save();
        }else{
            $data = Seleb::find($req->id_seleb);
            $data->nama_seleb = strtoupper($req->nama_seleb);
            $data->kecamatan = strtoupper($req->kecamatan);
            $data->kabupaten = strtoupper($req->kabupaten);
            $data->telp = $req->telp;
            $data->hp = $req->hp;
            $data->rek_bank = strtoupper($req->rek_bank);
            $data->rek_nama = strtoupper($req->rek_nama);
            $data->rek_nomor = $req->rek_nomor;
            $data->save();
        }

        return redirect()->route('seleb-link');
    }

    public function hapus(Request $req){
        Seleb::find($req->id_seleb)->delete();
        return response()->json(['hasil' => true]);
    }

    public function cetak(Request $req){

        // dd($req->all());

        if($req->fkab != '0'){
            if($req->fkec != '0'){
                $data = Seleb::select('*')->where('kabupaten', $req->fkab)->where('kecamatan', $req->fkec)->get();
            }else{
                $data = Seleb::select('*')->where('kabupaten', $req->fkab)->get();
            }
            
        }else{
             $data = Seleb::select('*')->get();
        }

        // return response()->json($data);

        if($req->fkab == '0'){
            $kab = "Semua";
        }else{
            $kab = $req->fkab;
        }

        if($req->fkec == '0'){
            $kec = "Semua";
        }else{
            $kec = $req->fkec;
        }

        PDF::SetTitle('Data Seleb');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // PDF::SetMargins(15, 15, 10,20);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('L', 'A4');
        PDF::SetFont('times', '', 9, '', false);
        PDF::writeHTML(view('master.cetakseleb',['data' => $data, 'kab' => $kab, 'kec' => $kec])->render(), true, false, false, false, '');
        
        return Response::make(PDF::Output('Data Seleb', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }

}
