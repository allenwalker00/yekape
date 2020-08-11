<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Datatables;
use Response;
use DB;
use PDF;
use Auth;
use File;
use App\Models\Customer;

class PendaftaranController extends Controller
{
    public function link($id = null)
    {
        // if($id == null){
            $data = null;
        // }else{
            // $data = InBound::find($id);
        // }

        // dd($data);

        return view('pendaftaran', ['data' => $data]);
    }

    public function simpan(Request $req){
        // dd($req->all());

        $data = new Customer;
        $data->nama = $req->nama;
        $data->jalan = $req->jalan;
        $data->kel = $req->kel;
        $data->kec = $req->kec;
        $data->kab = $req->kab;
        $data->prov = $req->prov;
        $data->tmp_lahir = $req->tmp_lahir;
        $data->tgl_lahir = date('Y-m-d', strtotime($req->tgl_lahir));
        $data->telp = $req->telp;
        $data->email = $req->email;
        $data->doc = date('Y-m-d H:i:s');
        $data->save();

        if ($req->hasFile('photo')) {
            $file = $req->file('photo');
            $extension = $file->getClientOriginalExtension();
            $path = "photo/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }

        if ($req->hasFile('ktp')) {
            $file = $req->file('ktp');
            $extension = $file->getClientOriginalExtension();
            $path = "ktp/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }

        if ($req->hasFile('kk')) {
            $file = $req->file('kk');
            $extension = $file->getClientOriginalExtension();
            $path = "kk/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }

        if ($req->hasFile('npwp')) {
            $file = $req->file('npwp');
            $extension = $file->getClientOriginalExtension();
            $path = "npwp/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }
        
        return redirect()->route('keluar-link');
    }
}
