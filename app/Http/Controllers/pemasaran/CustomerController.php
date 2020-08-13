<?php

namespace App\Http\Controllers\pemasaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use PDF;
use Response;
use App\Models\Kavling;
use App\Models\KavlingStatus;
use App\Models\Customer;
use Auth;

class CustomerController extends Controller
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

        // dd(Auth::user());

        return view('pemasaran.customer', ['data' => $data, 'status' => $status, 'cluster' => $cluster]);
    }

    public function data($filter)
    {
        $f = explode(';', $filter);

        $query = Customer::get();
        
        // if ($f[0] != "0") {
        //     $query->where('cluster', 'LIKE', '%'.$f[0].'%');
        // }

        // if ($f[1] != 0) {
        //     $query->where('status', $f[1]);
        // }

        // $query->get();

        return Datatables::of($query)
        				->addColumn('foto', function($model) {
                            $foto = '<button type="button" onclick="foto(' . $model->id . ')" class="btn btn-outline-dark btn-icon btn-elevate flaticon-eye" data-toggle="modal"></button>';
                            
                            return $foto;
                        })
                        ->addColumn('ktp', function($model) {
                            $ktp = '<button type="button" onclick="ktp(' . $model->id . ')" class="btn btn-outline-dark btn-icon btn-elevate flaticon-eye" data-toggle="modal"></button>';
                            
                            return $ktp;
                        })
                        ->addColumn('kk', function($model) {
                            $kk = '<button type="button" onclick="kk(' . $model->id . ')" class="btn btn-outline-dark btn-icon btn-elevate flaticon-eye" data-toggle="modal"></button>';
                            
                            return $kk;
                        })
                        ->addColumn('npwp', function($model) {
                            $npwp = '<button type="button" onclick="npwp(' . $model->id . ')" class="btn btn-outline-dark btn-icon btn-elevate flaticon-eye" data-toggle="modal"></button>';
                            
                            return $npwp;
                        })
                        ->addColumn('menu', function($model) {
                            $hapus = '<a onclick="return confirm(\'Apakah anda yakin untuk membatalkan data ini ?\')"  href="'.route('customer-hapus', ['id' => $model->id]).'"><button class="btn btn-outline-dark btn-icon btn-elevate flaticon-delete"></button></a>';

                            $edit = '<a href="' . route("customer-link", ['id' => $model->id]) . '"><button class="btn btn-outline-dark btn-icon btn-elevate flaticon-edit"></button></a>';
                            
                            if (Auth::user()->tipe == "Admin") {
                                return $hapus . '&nbsp;' . $edit;
                            }else{
                                return $edit . '&nbsp;' . $hitung;
                            }
                        })
                        ->rawColumns(['foto','ktp','kk','npwp', 'menu'])
                        ->make(true);
    }



    public function simpan(Request $req){
        // dd($req->all());

        $data = Kavling::find($req->id);
        $data->status = $req->status;
        $data->nama_pemesan = strtoupper($req->nama_pemesan);
        $data->telp_pemesan = $req->telp_pemesan;
        $data->keterangan = $req->keterangan;
        $data->harga_kpr = str_replace('.', '', $req->harga_kpr);
        $data->save();
        
        
        return redirect()->route('customer-link');
    }

    public function hapus($id){
        $data = Keluar::find($id);
        $data->batal = 1;
        $data->tgl_batal = date('Y-m-d H:i:s');
        $data->update();

        return redirect()->route('customer-link')->with(array('status' => 'Data berhasil dihapus', 'alert' => 'success'));
    }

    public function detail(Request $req){

        $data = Kavling::find($req->id);
        return response()->json(['data' => $data]);
    }

    public function foto(Request $req){
        $data = asset("storage/photo/".$req->id.".jpg");
        return response()->json(['data' => $data]);
    }

    public function ktp(Request $req){
        $data = asset("storage/ktp/".$req->id.".jpg");
        return response()->json(['data' => $data]);
    }

    public function kk(Request $req){
        $data = asset("storage/kk/".$req->id.".jpg");
        return response()->json(['data' => $data]);
    }

    public function npwp(Request $req){
        $data = asset("storage/npwp/".$req->id.".jpg");
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