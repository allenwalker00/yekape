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
use App\Models\TransaksiDetail;
use App\Models\TransaksiPayment;
use App\Models\Truk;
use App\Models\Gudang;
use App\Models\Saldo;
use App\Models\Seleb;

class bLabaRugiController extends Controller
{
    public function link($id_kas = null)
    {
        if($id_kas == null){
            $data = null;
        }else{
            $data = Kas::find($id_kas);
        }
        $seleb = Seleb::select('*')->get();
        $total_hutang = Seleb::where('saldo', '<', 0)->sum('saldo');
        $total_piutang = Seleb::where('saldo', '>', 0)->sum('saldo');
        
        return view('laporan.blabarugi', ['data' => $data, 'seleb' => $seleb, 'total_hutang' => $total_hutang, 'total_piutang' => $total_piutang]);
    }

    public function data($filter)
    {
        $f = explode(';', $filter);
        $n = 0;
        DB::statement(DB::raw('set @rownum=0'));
        $query = Transaksi::with('truk', 'gudang', 'detail')
                                ->where('kd_transaksi', 'MB')
                                ->whereBetween('tgl_bongkar', [date('Y-m-d',strtotime($f[0])), date('Y-m-d',strtotime($f[1]))])
                                ->orderBy('id_gudang')
                                ->get(['transaksi.*', DB::raw('@rownum  := @rownum  + 1 AS rownum')]);
                                // ->get();

        // dd($query);

        return Datatables::of($query)->editColumn('ket_lain', function($model) {
                                       $result = "";
                                       $detail = TransaksiDetail::where('id_transaksi', $model->id_transaksi)
                                                                ->where('kd_transaksi', 'M')
                                                                ->with('seleb')
                                                                ->select('*')
                                                                ->get();
                                       foreach ($detail as $key => $d) {
                                           $result .= $d->seleb->nama_seleb . " ";
                                       }
                                       return $result;
                                    })
                                    ->editColumn('rp_lain', function($model) {
                                        return $model->rp_bongkar - $model->rp_muat - $model->rp_ongkir;
                                    })
                                    ->make(true);
    }

    public function cetak(Request $req){

        // dd($req->all());

        $data = Transaksi::with('truk', 'gudang', 'detail')
                                // ->with(['detail' => function ($q) {
                                    // $q->where('kd_transaksi', 'B');
                                // }])
                                ->where('kd_transaksi', 'MB')
                                ->whereBetween('tgl_bongkar', [date('Y-m-d',strtotime($req->tgl_start)), date('Y-m-d',strtotime($req->tgl_end))])
                                ->orderBy('id_gudang')
                                ->select('*')
                                ->get();


        // return response()->json($data);


        // if($req->fseleb != 0){
        //     $seleb = Seleb::find($req->fseleb);
        // }else{
        //     $seleb = '';
        // }
        

        PDF::SetTitle('Laporan Laba Rugi');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetMargins(15, 15, 10,0);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('L', 'A4');
        PDF::SetFont('times', '', 9, '', false);
        
        PDF::writeHTML(view('laporan.cetaklabarugi',['data' => $data, 'tgl_start' => $req->tgl_start, 'tgl_end' => $req->tgl_end])->render(), true, false, false, false, '');
        
        
        return Response::make(PDF::Output('Laporan Laba Rugi', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }
}
