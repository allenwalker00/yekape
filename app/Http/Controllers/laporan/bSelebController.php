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

class bSelebController extends Controller
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
        
        return view('laporan.bseleb', ['data' => $data, 'seleb' => $seleb, 'total_hutang' => $total_hutang, 'total_piutang' => $total_piutang]);
    }

    public function data($filter)
    {
        $f = explode(';', $filter);
        // dd($f[1]);
        if($f[0] != 0){
            $query = TransaksiDetail::with('transaksi.truk', 'transaksi.gudang', 'seleb', 'payment')
                                    ->whereHas('payment', function ($q) use ($f){
                                        $q->WhereBetween('tgl_kas', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))]);
                                    })
                                    ->where('kd_transaksi', 'M')
                                    ->where('id_seleb', $f[0])
                                    ->select('*')
                                    ->get();
        }else{
            $query = TransaksiDetail::with('transaksi.truk', 'transaksi.gudang', 'seleb', 'payment')
                                    ->whereHas('payment', function ($q) use ($f){
                                        $q->WhereBetween('tgl_kas', [date('Y-m-d',strtotime($f[1])), date('Y-m-d',strtotime($f[2]))]);
                                    })
                                    ->where('kd_transaksi', 'M')
                                    ->select('*')
                                    ->get();
        }

        // dd($query);


        // $query = DB::select("select c.tgl_muat, d.nama_seleb, b.berat, b.harga, e.nama_supir, g.nama_gudang, 
        //                     a.tgl_kas, a.jumlah,b.tagihan - a.jumlah  as sisa_uang
        //                     from b_kas a
        //                     left join b_detailmuat b on b.id_muat = a.id_muat
        //                     left join b_transaksi c on c.id_transaksi = a.id_transaksi
        //                     inner join m_seleb d on d.id_seleb = b.id_seleb
        //                     inner join m_truk e on e.id_truk = c.id_truk
        //                     inner join b_detailbongkar f on f.id_bongkar = c.id_transaksi
        //                     inner join m_gudang g on g.id_gudang = f.id_gudang
        //                     where a.id_muat is not null ". $vseleb."");

        

        

        // return response()->json($query);

        return Datatables::of($query)->editColumn('payment.rp_kekurangan', function($model) {
                                       return $model->payment->rp_bayar + $model->payment->rp_bayar_deposit - $model->payment->rp_tagihan;
                                    })
                                    ->editColumn('payment.pay_method', function($model) {
                                        if($model->payment->pay_method == 'transfer')
                                            return $model->payment->rek_bayar;
                                        else
                                            return $model->payment->pay_method;
                                    })
        //                             ->editColumn('entry', function($model) {
        //                                 if($model->id_kpiutang <> null)
        //                                     return $model->kaspiutang->keterangan;
        //                                 elseif($model->id_kmuat <> null)
        //                                     return $model->kasmuat->keterangan;
        //                             })
                                    // ->editColumn('saldo.saldo_akhir', function($model) {
                                    //         return "Rp " . number_format($model->saldo->saldo_akhir,2,',','.');
                                    //  })
                                    ->make(true);
    }

    public function cetak(Request $req){

        // dd($req->all());

        // $data = Seleb::select('*')->where('saldo', '<>', 0)->get();
        // dd($data);

        if($req->fseleb != 0){
            $data = TransaksiDetail::with('transaksi.truk', 'transaksi.gudang', 'seleb', 'payment')
                                    ->whereHas('payment', function ($q) use ($req){
                                        $q->WhereBetween('tgl_kas', [date('Y-m-d',strtotime($req->tgl_start)), date('Y-m-d',strtotime($req->tgl_end))]);
                                    })
                                    ->where('kd_transaksi', 'M')
                                    ->where('id_seleb', $req->fseleb)
                                    ->select('*')
                                    ->get();
        }else{
            $data = TransaksiDetail::with('transaksi.truk', 'transaksi.gudang', 'seleb', 'payment')
                                    ->whereHas('payment', function ($q) use ($req){
                                        $q->WhereBetween('tgl_kas', [date('Y-m-d',strtotime($req->tgl_start)), date('Y-m-d',strtotime($req->tgl_end))]);
                                    })
                                    ->where('kd_transaksi', 'M')
                                    ->select('*')
                                    ->get();
        }

        // return response()->json($data);


        // if($req->fseleb != 0){
        //     $seleb = Seleb::find($req->fseleb);
        // }else{
        //     $seleb = '';
        // }
        

        PDF::SetTitle('Laporan Seleb');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetMargins(15, 15, 10,0);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('L', 'A4');
        PDF::SetFont('times', '', 9, '', false);
        
        if($req->fseleb != 0){
            PDF::writeHTML(view('laporan.cetakseleb',['data' => $data, 'tgl_start' => $req->tgl_start, 'tgl_end' => $req->tgl_end, 'seleb' => Seleb::find($req->fseleb)])->render(), true, false, false, false, '');
        }else{
            PDF::writeHTML(view('laporan.cetakseleball',['data' => $data, 'tgl_start' => $req->tgl_start, 'tgl_end' => $req->tgl_end])->render(), true, false, false, false, '');
        }
        
        return Response::make(PDF::Output('Laporan Seleb', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }
}
