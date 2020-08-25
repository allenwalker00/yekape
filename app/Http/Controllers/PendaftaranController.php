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
use App\Models\Kavling;

class PendaftaranController extends Controller
{
    public function link($id = null)
    {
        // if($id == null){
            $data = null;
            $cluster = Kavling::select('cluster')
                        ->where('batal', 0)
                        ->where('status', null)
                        ->groupBy('cluster')
                        ->get();
        // }else{
            // $data = InBound::find($id);
        // }

        // dd($data);

        return view('pendaftaran', ['data' => $data, 'cluster' => $cluster]);
    }

    public function simpan(Request $req){
        // dd($req->all());

        $data = new Customer;
        $data->ktp = $req->noktp;
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

        $kavling = Kavling::find($req->kavling);
        $kavling->id_customer = $data->id;
        $kavling->status = 4;
        $kavling->tgl_booking = date('Y-m-d H:i:s');
        $kavling->save();

        if ($req->hasFile('photo')) {
            $file = $req->file('photo');
            $extension = $file->getClientOriginalExtension();
            $path = "public/photo/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }

        if ($req->hasFile('ktp')) {
            $file = $req->file('ktp');
            $extension = $file->getClientOriginalExtension();
            $path = "public/ktp/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }

        if ($req->hasFile('kk')) {
            $file = $req->file('kk');
            $extension = $file->getClientOriginalExtension();
            $path = "public/kk/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }

        if ($req->hasFile('npwp')) {
            $file = $req->file('npwp');
            $extension = $file->getClientOriginalExtension();
            $path = "public/npwp/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }

        if ($req->hasFile('sk')) {
            $file = $req->file('sk');
            $extension = $file->getClientOriginalExtension();
            $path = "public/sk/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }

        if ($req->hasFile('slipgaji')) {
            $file = $req->file('slipgaji');
            $extension = $file->getClientOriginalExtension();
            $path = "public/slipgaji/" . $data->id . "." . $extension;
            $cek = Storage::put($path, File::get($file));
        }
        
        return redirect()->route('keluar-link');
    }

    public function lokasi_bycluster(Request $request){
        $cluster = $request->cluster;
        if($cluster == 'null'){
            $data = null;
        }else{
            $data = Kavling::select('tipe')
                    ->where('status', null)
                    ->where('cluster', $cluster)
                    ->groupBy('tipe')
                    ->get();
        }
        return response()->json(['data' => $data]);
    }

    public function lokasi_byletak(Request $request){
        $cluster = $request->cluster;
        $letak = $request->letak;
        if($letak == 'null'){
            $data = null;
        }else{
            $data = Kavling::select('luas_bangun')
                    ->where('status', null)
                    ->where('cluster', $cluster)
                    ->where('tipe', $letak)
                    ->groupBy('luas_bangun')
                    ->get();
        }
        return response()->json(['data' => $data]);
    }

    public function lokasi_bytipe(Request $request){
        $cluster = $request->cluster;
        $letak = $request->letak;
        $tipe = $request->tipe;
        if($letak == 'null'){
            $data = null;
        }else{
            $data = Kavling::select('blok')
                    ->where('status', null)
                    ->where('cluster', $cluster)
                    ->where('tipe', $letak)
                    ->where('luas_bangun', $tipe)
                    ->groupBy('blok')
                    ->get();
        }
        return response()->json(['data' => $data]);
    }

    public function lokasi_byblok(Request $request){
        $cluster = $request->cluster;
        $letak = $request->letak;
        $tipe = $request->tipe;
        $blok = $request->blok;
        if($blok == 'null'){
            $data = null;
        }else{
            $data = Kavling::select('id','nomor')
                    ->where('status', null)
                    ->where('cluster', $cluster)
                    ->where('tipe', $letak)
                    ->where('luas_bangun', $tipe)
                    ->where('blok', $blok)
                    // ->groupBy('nomor')
                    ->get();
        }
        return response()->json(['data' => $data]);
    }
}
