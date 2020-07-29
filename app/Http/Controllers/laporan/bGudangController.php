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

class bGudangController extends Controller
{
    public function link($id_kas = null)
    {
        if($id_kas == null){
            $data = null;
        }else{
            $data = Kas::find($id_kas);
        }
        $gudang = Gudang::select('*')->get();
        
        return view('laporan.bgudang', ['data' => $data, 'gudang' => $gudang]);
    }

    public function data($filter)
    {
        $f = explode(';', $filter);
        if($f[0] != 0){
            // $query = TransaksiDetail::with('transaksi.truk', 'transaksi.gudang', 'payment')
            //                         ->whereHas('transaksi', function ($q) use ($f){
            //                             $q->WhereBetween('tgl_bongkar', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))]);
            //                             $q->where('id_gudang', $f[0]);
            //                         })
            //                         ->where('kd_transaksi', 'B')
            //                         ->select('*')
            //                         ->orderBy('id_transaksi', 'ASC')
            //                         ->get();



            $query = Transaksi::with('truk', 'gudang')
                                    ->with(['detail' => function($q){
                                        $q->where('kd_transaksi', 'B');
                                        $q->with('payment');
                                    }])
                                    ->WhereBetween('tgl_bongkar', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))])
                                    ->where('id_gudang', $f[0])
                                    ->select('*')
                                    ->orderBy('id_gudang')
                                    ->orderBy('id_transaksi')
                                    ->get();
        }else{
            // $query = TransaksiDetail::with('payment')
            //                         ->with(['transaksi' => function($q){
            //                             $q->with('truk', 'gudang');
            //                             $q->orderBy('id_gudang');
            //                         }])
            //                         ->whereHas('transaksi', function ($q) use ($f){
            //                             $q->WhereBetween('tgl_bongkar', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))]);
            //                         })
            //                         ->where('kd_transaksi', 'B')
            //                         ->select('*')
            //                         // ->orderby('transaksi.id_gudang')
            //                         ->get();
            $query = Transaksi::with('truk', 'gudang')
                                    ->with(['detail' => function($q){
                                        $q->where('kd_transaksi', 'B');
                                        $q->with('payment');
                                    }])
                                    ->WhereBetween('tgl_bongkar', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))])
                                    ->select('*')
                                    ->orderBy('id_gudang')
                                    ->orderBy('id_transaksi')
                                    ->get();
        }

        return Datatables::of($query)
                        ->addColumn('menu', function($model) {
                            $detail = '<button type="button" onclick="detail(' . $model->recid . ')" class="btn btn-sm btn-success" data-toggle="modal">Detail</button>';
                            
                            return $detail;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }

    public function cetak(Request $req){

        // dd($req->all());


        if($req->fgudang != 0){
             $data = Transaksi::with('truk', 'gudang')
                                    ->with(['detail' => function($q){
                                        $q->where('kd_transaksi', 'B');
                                        $q->with('payment');
                                    }])
                                    ->WhereBetween('tgl_bongkar', [date('Y-m-d',strtotime($req->tgl_start)), date('Y-m-d',strtotime($req->tgl_end))])
                                    ->where('id_gudang', $req->fgudang)
                                    ->select('*')
                                    ->orderBy('id_gudang')
                                    ->orderBy('no_nota')
                                    ->get();
        }else{
            $data = Transaksi::with('truk', 'gudang')
                                    ->with(['detail' => function($q){
                                        $q->where('kd_transaksi', 'B');
                                        $q->with('payment');
                                    }])
                                    ->WhereBetween('tgl_bongkar', [date('Y-m-d',strtotime($req->tgl_start)), date('Y-m-d',strtotime($req->tgl_end))])
                                    ->select('*')
                                    ->orderBy('id_gudang')
                                    ->orderBy('no_nota')
                                    ->get();
        }
        
        // return response()->json($data);

        PDF::SetTitle('Laporan Gudang');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetMargins(15, 15, 10,0);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('L', 'A4');
        PDF::SetFont('times', '', 9, '', false);
        
        if($req->fgudang != 0){
            PDF::writeHTML(view('laporan.cetakgudangdetail',['data' => $data, 'tgl_start' => $req->tgl_start, 'tgl_end' => $req->tgl_end, 'gudang' => Gudang::find($req->fgudang)])->render(), true, false, false, false, '');
        }else{
            PDF::writeHTML(view('laporan.cetakgudangall',['data' => $data, 'tgl_start' => $req->tgl_start, 'tgl_end' => $req->tgl_end])->render(), true, false, false, false, '');
        }
        
        return Response::make(PDF::Output('Laporan Gudang', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }

    public function detail(Request $req){
        $data = TransaksiPayment::where('recid_transaksi', $req->recid)->get();
        return response()->json(['data' => $data]);
    }
}
