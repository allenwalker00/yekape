<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;

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
}
