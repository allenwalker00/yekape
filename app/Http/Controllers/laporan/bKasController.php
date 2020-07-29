<?php

namespace App\Http\Controllers\laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Response;
use Auth;
use PDF;
use App\Models\Transaksi;
use App\Models\Seleb;
use App\Models\Truk;
use App\Models\Gudang;
use App\Models\Saldo;

class bKasController extends Controller
{
    public function link($id = null)
    {
        if($id == null){
            $data = null;
        }else{
            $data = Kas::find($id);
        }

        $q = Saldo::select('*')->OrderBy('id', 'DESC')->first();

        if (!empty($q)) {
            $saldo = $q->saldo_akhir;
        }else{
            $saldo = 0;
        }
        
        return view('laporan.bkas', ['data' => $data, 'saldo' => $saldo]);
    }

    public function data($filter)
    {
        $f = explode(';', $filter);

        $query = Saldo::select('*')
                    ->with('trans')
                    ->whereBetween('tanggal', [date('Y-m-d', strtotime($f[0])), date('Y-m-d', strtotime($f[1]))])
                    ->OrderBy('id', 'ASC');

        // dd($query);
        // return response()->json($query);
                    
        if(!empty($query)){
            return Datatables::of($query)->make(true);
        }
    }

    public function cetak(Request $req){

        // dd($req->all());
        // $data = DB::select("select a.tgl_kas, if(a.jenis_kas='db',a.jumlah,0) debit, 
        //             if(a.jenis_kas='cr',a.jumlah,0) kredit, 
        //             if(isnull(a.id_transaksi),a.keterangan,if(isnull(a.id_muat),concat('GUDANG ',e.nama_gudang), concat('SELEB ', c.nama_seleb))) keterangan,
        //             saldo_akhir
        //             from b_kas a 
        //             left join b_detailmuat b on b.id_muat = a.id_muat
        //             left join m_seleb c on c.id_seleb = b.id_seleb
        //             left join b_detailbongkar d on d.id_bongkar = a.id_bongkar
        //             left join m_gudang e on e.id_gudang = d.id_gudang");

        $data = Saldo::select('*')
                    ->whereBetween('tanggal', [date('Y-m-d', strtotime($req->tgl_start)), date('Y-m-d', strtotime($req->tgl_end))])
                    ->orderBy('id', 'ASC')
                    ->get();

        $jml_kredit = 0; 
        $jml_debit = 0;

        foreach ($data as $row) {
             $jml_kredit += $row->kredit;
             $jml_debit += $row->debit;
        }
        $jml_saldo = $jml_kredit - $jml_debit;
        // dd($data);

        PDF::SetTitle('Laporan Kas');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetMargins(15, 15, 10,0);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('P', 'A4');
        PDF::SetFont('times', '', 10, '', false);
        PDF::writeHTML(view('laporan.cetakkas',['data' => $data, 'jml_kredit' => $jml_kredit, 'jml_debit' => $jml_debit, 'jml_saldo' => $jml_saldo])->render(), true, false, false, false, '');
        
        return Response::make(PDF::Output('Buku Kas', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }
}
