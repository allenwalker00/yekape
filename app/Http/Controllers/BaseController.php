<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use DB;
use PDF;
use Config;
use Excel;
use Curl;
use Response;
use App\Models\Gedung,
    App\Models\AbsensiHadir,
    App\Models\Dosen,
    App\Models\Matakuliah,
    App\Models\KurikulumSemester,
    App\Models\Plot,
    App\Models\PlotHarian,
    App\Models\PlotDosen,
    App\Models\Departemen;


class BaseController extends Controller
{
    public function dashboardLink(){
        
        return view('dashboard');
    }

    public function cobaCetak(){
        PDF::SetTitle('Coba Cetak');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetMargins(15, 15, 0,0);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        PDF::AddPage('P', 'A4');
        PDF::SetFont('times', '', 12, '', false);
        PDF::writeHTML(view('cetak',[ 'data' => 'halo'])->render(), true, false, false, false, '');

        PDF::AddPage('P', 'A4');
        PDF::SetFont('times', '', 12, '', false);
        PDF::writeHTML(view('cetak',[ 'data' => 'halo'])->render(), true, false, false, false, '');
        // PDF::Output('LaporanAbsensi' . $tahun . $bulan, 'I');
        return Response::make(PDF::Output('Coba Cetak', 'I'), 200, array('Content-Type' => 'application/pdf'));
    }

    public function kec_bykab(Request $request){
        $kab = $request->kab;
        if($kab == 'null'){
            $data = DB::table('m_seleb')
                ->distinct()
                ->whereRaw('kabupaten IS NULL')
                ->orderBy('kecamatan','ASC')
                ->get(['kecamatan']);
        }else{
            $data = DB::table('m_seleb')
                ->distinct()
                ->where('kabupaten', $kab)
                ->orderBy('kecamatan','ASC')
                ->get(['kecamatan']);
        }

        return response()->json(['data' => $data]);
    }
}