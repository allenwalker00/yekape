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
use App\Exports\AbsensiExport;
use App\Exports\AbsensiDosen;
use Response;
use App\Models\Gedung,
    App\Models\AbsensiHadir,
    App\Models\Dosen,
    App\Models\Matakuliah,
    App\Models\Departemen,
    App\Models\HonorElement,
    App\Models\Ruang,
    App\Models\CyberJadwal,
    App\Models\CyberProdi,
    App\Models\CyberPengampu,
    App\Models\CyberPloting;


class CyberController extends Controller
{
    
    public function plotingbaruLink($id = null){
        // if($id == null){
            $aa = null;
        // }else{
        //     $aa = Gedung::find($id);
        // }
        // $th = TahunAkademik::all();
        // $kur = Kurikulum::all();
        $ps = CyberProdi::orderBy('jenjang')->get();
        $dosen = Dosen::all();
        $response = Curl::to('https://uacc.unair.ac.id/api/semester?access-token=' . getToken() . '&STATUS_AKTIF_SEMESTER=True')
            ->asJson()
            ->get();
        $tahun_ajaran = (isset($response->items[0]->TAHUN_AJARAN)) ? $response->items[0]->TAHUN_AJARAN : 0;
        $tahun_akademik = (isset($response->items[0]->THN_AKADEMIK_SEMESTER)) ? $response->items[0]->THN_AKADEMIK_SEMESTER : 0;
        $group_semester = (isset($response->items[0]->NM_SEMESTER)) ? $response->items[0]->NM_SEMESTER : 0;
        
        $tahun = (isset($response->items[0]->TAHUN_AJARAN)) ? $response->items[0]->TAHUN_AJARAN : 0;
        $semester = (isset($response->items[0]->NM_SEMESTER)) ? $response->items[0]->NM_SEMESTER : 0;
        $id = (isset($response->items[0]->ID_SEMESTER)) ? $response->items[0]->ID_SEMESTER : 0;
        return view('cyber.plotingbaru', ['data' => $aa, 'prodi' => $ps, 'dosen' => $dosen, 'tahun' => $tahun . ' (' . $semester . ')', 'tahun_id' => $id, 'tahun_param' => $tahun_ajaran.';'.$tahun_akademik.';'.$group_semester]);
    }

    public function plotingbaruData($filter){
        $tmp = explode(';', $filter);
        $query = CyberPloting::select('*')->with('pjmk', 'prodi');

        $query->where('tahun_akademik', $tmp[0]);
        if($tmp[1] != 0){
            $query->where('id_prodi', $tmp[1]);
        }
        if($tmp[2] != 0){
            $query->where('id_hari', $tmp[2]);
        }

        return Datatables::of($query)
                        ->editColumn('jam_mulai', function($model){
                            return $model->jam_mulai . '-' . $model->jam_selesai;
                        })
                        ->editColumn('nama_prodi', function($model){
                            return $model->prodi->jenjang . '-' . $model->prodi->nama_prodi;
                        })
                        ->editColumn('pjmk.nama_dosen', function($model){
                            if($model->pjmk){
                                return $model->pjmk->nama_dosen;
                            }else{
                                return '-';
                            }
                        })
                        ->addColumn('menu', function($model) {
                            // $lihat = '<button type="button" onclick="pengampu(' . $model->id_kelas_mk . ')" class="btn btn-sm btn-secondary btn-elevate btn-pill">Pengampu</button>';
                            // $tambah = '<button type="button" onclick="tambah(' . $model->id_kelas_mk . ')" class="btn btn-sm btn-outline-dark">Tambah Pengampu</button>';
                            $lihat = '<a class="dropdown-item" onclick="pengampu(' . $model->id_kelas_mk . ')" href="#"> Lihat Pengampu</a>';
                            $tambah = '<a class="dropdown-item" onclick="tambah(' . $model->id_kelas_mk . ')" href="#"> Tambah Pengampu</a>';
                            $btn = '<div class="btn-group dropup">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Menu
                                        </button>
                                        <div class="dropdown-menu">
                                        ' . $lihat . $tambah . '
                                        </div>
                                    </div>';
                            return $btn;
                        })
                        ->rawColumns(['menu'])
                        ->make(true);
    }

    public function pengampuLihat(Request $data){
        $ploting = CyberPloting::with('prodi')->where('id_kelas_mk', $data->id)->first();
        $pengampu = CyberPengampu::where('id_kelas_mk', $data->id)->orderBy('pjmk', 'desc')->get();

        return response()->json(['ploting' => $ploting, 'pengampu' => $pengampu]);
    }
    
    public function pengampuTambah(Request $data){
        $ploting = CyberPloting::where('id_kelas_mk', $data->kelas_mk)->first();
        $thn = $ploting->tahun_akademik;
        foreach ($data->dosen as $row) {
            $dsn = Dosen::where('nip', $row)->first();
            $cek = CyberPengampu::select('id_pengampu_mk as iterasi')
                        ->where('id_pengampu_mk', 'like', 'S' . $thn .'%')
                        ->where('sumber_data', 'simfeb')
                        ->orderBy('id_pengampu_mk', 'desc')
                        ->first();
            if($cek){
                $n = (int) substr($cek->iterasi, 5);
                $kode = 'S' . $ploting->tahun_akademik . sprintf("%04d", $n+1);
            }else{
                $kode = 'S' . $ploting->tahun_akademik . '0001';
            }
            $cekdata = CyberPengampu::where('id_kelas_mk', $data->kelas_mk)->where('nip_dosen',$row)->first();
            if(!$cekdata){
                $tmp = new CyberPengampu;
                $tmp->id_pengampu_mk = $kode;
                $tmp->id_kelas_mk = $data->kelas_mk;
                $tmp->nip_dosen = $row;
                $tmp->nama_dosen = $dsn->gelar_depan . ' ' . $dsn->nama . ' ' . $dsn->gelar_belakang;
                $tmp->pjmk = 0;
                $tmp->sumber_data = 'simfeb';
                $tmp->save();    
            }
        }

        return response()->json(['hasil' => $cek]);
    }

    public function jadwalharianLink($id = null){
        // if($id == null){
            $aa = null;
        // }else{
        //     $aa = Gedung::find($id);
        // }
        // $th = TahunAkademik::all();
        $kur = Ruang::all();
        $ps = CyberProdi::all();
        $dosen = Dosen::all();
        $tahun = DB::table('cyber_ploting')->select('tahun_ajaran')->distinct('tahun_ajaran')->get();
        // return response()->json($tahun);
        return view('cyber.jadwalharian', ['data' => $aa, 'prodi' => $ps, 'dosen' => $dosen, 'ruang' => $kur, 'tahun_ajaran' => $tahun]);
    }

    public function jadwalharianData($filter){
        $tmp = explode(';', $filter);
        $query = CyberJadwal::with('ploting.prodi','dosen');//'new_ploting.jam_mulai', 'new_ploting.jam_selesai', 'new_ploting.nama_ruangan', 'dosen_nip', 'new_jadwal.id_jadwal_kelas', 'new_ploting.nama_prodi', 'new_ploting.id_prodi', 'new_ploting.kode_mk', 'new_ploting.nama_mk', 'new_ploting.tingkat_semester');

        //$query->where('tanggal', $tmp[0]);
        if($tmp[0] != 0){
            if (strpos($tmp[0], ' sd ') !== false) {
                $tmp1 = explode(' sd ', $tmp[0]);
                // $query->where(function($query1) use ($tmp1) {
                //     $query1->where('tanggal', '>=', date('Y-m-d', strtotime($tmp1[0])));
                //     $query1->where('tanggal', '<=', date('Y-m-d', strtotime($tmp1[1])));
                // });
                // $query->orWhere(function($query1) use ($tmp1) {
                //     $query1->where('tgl_baru', '>=', date('Y-m-d', strtotime($tmp1[0])));
                //     $query1->where('tgl_baru', '<=', date('Y-m-d', strtotime($tmp1[1])));
                // });
                $query->where('tanggal', '>=', date('Y-m-d', strtotime($tmp1[0])));
                $query->where('tanggal', '<=', date('Y-m-d', strtotime($tmp1[1])));
            // $query->where('id_prodi', $tmp[1]);
            }else{
				// $query->where(function($query1) use ($tmp) {
    //                 $query1->where('tanggal', date('Y-m-d', strtotime($tmp[0])));
    //                 $query1->orWhere('tgl_baru', date('Y-m-d', strtotime($tmp[0])));
    //             });
                $query->whereRaw("(case when tgl_baru!='' then tgl_baru else tanggal end) = '".$tmp[0]."'");
                // $query->orWhere('tgl_baru', date('Y-m-d', strtotime($tmp[0])));
			}
        }
        if($tmp[1] != 0){
            $query->whereHas('ploting', function($sql) use ($tmp){
                $sql->where('id_prodi', $tmp[1]);
            });
            // $query->where('id_prodi', $tmp[1]);
        }
        if(isset($tmp[2]) && $tmp[2] != 0 && is_numeric($tmp[2])){
            // $query->whereHas('ploting', function($sql) use ($tmp){
            //     $sql->where('id_prodi', $tmp[1]);
            // });
            $query->where('dosen_nip', $tmp[2]);
        }
        
        return Datatables::of($query)
                        ->editColumn('tanggal', function($model){
                            if($model->tgl_baru != ''){
                                $tgl = $model->tgl_baru;
                            }else{
                                $tgl = $model->tanggal;
                            }
                            return $model->ploting->nama_hari . ', ' . date('d-m-Y', strtotime($tgl));
                        })
                        ->editColumn('ploting.jam_mulai', function($model){
							if($model->ruang_baru != null){
								return $model->jam_awal . '-' . $model->jam_akhir;
							}else{
								return $model->ploting->jam_mulai . '-' . $model->ploting->jam_selesai;
							}                            
                        })
                        ->editColumn('ploting.nama_prodi', function($model){
                            return $model->ploting->prodi->jenjang . '-' . $model->ploting->prodi->nama_prodi;
                        })
                        ->editColumn('ploting.nama_mk', function($model){
                            return $model->ploting->kode_mk . '-' . $model->ploting->nama_mk . '/ Smt ' . $model->ploting->tingkat_semester;
                        })
						->editColumn('ploting.nama_ruangan', function($model){
							if($model->ruang_baru != ''){
								return $model->ruangbaru->nama;
							}else{
								return $model->ploting->nama_ruangan;
							}
                            
                        })
                        ->editColumn('dosen.nama', function($model){
                            if($model->dosen != null){
                                $teks = (($model->dosen->gelar_depan == 'null') ? '' : $model->dosen->gelar_depan.' ') . $model->dosen->nama . (($model->dosen->gelar_belakang == 'null') ? '' : ' '.$model->dosen->gelar_belakang);
                            }else{
                                $teks = $model->dosen_nip;
                            }
                            return $teks;
                        })
                        ->editColumn('check_in', function($model){
                            $cekin = '-';
                            $cekout = '-';
                            if($model->check_in != null){
                                $cekin = date('H:i:s', strtotime($model->check_in));
                            }
                            if($model->check_out != null){
                                $cekout = date('H:i:s', strtotime($model->check_out));
                            }
                            return 'in: ' . $cekin . '<br>out: ' . $cekout;
                        })
                        ->addColumn('menu', function($model) {
                            if($model->ruang_baru != null){
                                $jam = $model->jam_awal . '-' . $model->jam_akhir;
                            }else{
                                $jam = $model->ploting->jam_mulai . '-' . $model->ploting->jam_selesai;
                            } 
                            $ubah = '<button type="button" onclick="ubah(' . $model->id_jadwal_kelas . ',\'' . $model->tanggal . '\',\'<h5>Jadwal Lama</h5>Prodi: ' . $model->ploting->prodi->jenjang . '-' .$model->ploting->nama_prodi.'<br>Mata Kuliah: '. $model->ploting->nama_mk.'<br>Kelas: '. $model->ploting->nama_kelas.'<br>Jam: '. $jam.'<br>Ruang: '. $model->ploting->nama_ruangan. '\')" class="btn btn-sm btn-danger">Ganti Jadwal</button>';
                            return $ubah;
                        })
                        ->rawColumns(['menu','check_in'])
                        ->make(true);
    }

    public function jadwalharianGanti(Request $req){
        CyberJadwal::where('tanggal', date('Y-m-d', strtotime($req->u_tgl_lama)))
            ->where('id_jadwal_kelas', $req->u_ph)
            ->update([
                'tgl_baru' => date('Y-m-d', strtotime($req->u_tgl)),
                'ruang_baru' => $req->u_ruang,
                'jam_awal' => $req->u_awal,
                'jam_akhir' => $req->u_akhir,
            ]);
        return redirect()->route('jadwalharian-link');
    }

    public function jadwalharianGenerate(Request $req){
        $tgl = explode(' sd ', $req->rangetgl);
        $period = createDateRangeArray($tgl[0], $tgl[1]);
        foreach ($period as $row) {
            $days = date('w', strtotime($row));
            if(date('w', strtotime($row)) >=1 && date('w', strtotime($row)) <=5){
                // echo $row . ' ' . date('w', strtotime($row)) . '<br>'; 
                // $jadwal = DB::table('new_jadwal')->where('tanggal', $row)->get();
                // if(count($jadwal)==0){
                DB::insert("insert into new_jadwal (id_jadwal_kelas,tanggal) (select id_jadwal_kelas,'".$row."' from new_ploting where id_hari=".($days+1)." and tahun_akademik='".$req->tahun."' and group_semester='".$req->semester."' and id_jadwal_kelas not in (select id_jadwal_kelas from new_jadwal where tanggal='".$row."'))");    
                // }
            }
        }
        return redirect()->route('jadwalharian-link');
    }

    public function jadwalharianPHL(Request $req){
        // $cek = CyberJadwal::where('tgl_libur', date('Y-m-d', strtotime($req->tgl_libur)))->first();
        // if($cek){
        //     $cek->tgl_pengganti = date('Y-m-d', strtotime($req->tgl_pengganti));
        //     $cek->doc = date('Y-m-d H:i:s');
        //     $cek->save();
        // }else{
        //     $aa = new Phl;
        //     $aa->tgl_libur = date('Y-m-d', strtotime($req->tgl_libur));
        //     $aa->tgl_pengganti = date('Y-m-d', strtotime($req->tgl_pengganti));
        //     $aa->doc = date('Y-m-d H:i:s');
        //     $aa->save();
        // }
        CyberJadwal::where('tanggal', date('Y-m-d', strtotime($req->tgl_libur)))
            ->update([
                'tgl_baru' => date('Y-m-d', strtotime($req->tgl_pengganti))
            ]);
        return response()->json(['hasil' => true]);
    }

    public function jadwalharianCetakPresensi(Request $req){

        $dosen = Dosen::with('dosenstatus')->where('nip',$req->dosen)->first();

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        // $data = explode(';', $filter);
        $query = CyberJadwal::select('*')
                    ->with('ploting.prodi')
                    ->whereHas('ploting', function($sql) use ($req){
                        $sql->where('tahun_ajaran', $req->tahun);
                        $sql->where('group_semester', $req->semester);
                    })
                    ->where('dosen_nip',$req->dosen)
                    ->orderBy('tanggal','ASC')
                    ->get();

        //cek week
        $startweek = CyberJadwal::select('*')
                    ->whereHas('ploting', function($sql) use ($req){
                        $sql->where('tahun_ajaran', $req->tahun);
                        $sql->where('group_semester', $req->semester);
                        $sql->where('id_hari', 2);
                    })
                    ->where('tanggal', '<=' , date('Y-m-d'))
                    ->select('tanggal')
                    ->distinct()
                    ->get();

        $honor = HonorElement::where('jabatan_id', $dosen->jabatan_id)->first();
        if ($honor) {
            $honor = $honor->satuan;
        }else{
            $honor = 0;
        }

        PDF::SetTitle('Cetak Laporan Presensi Mengajar');
        PDF::SetPrintHeader(false);
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetMargins(5, 10, 5,10);
        PDF::SetAutoPageBreak(TRUE, 6);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        PDF::AddPage('P', 'A4');
        PDF::SetFont('times', '', 12, '', false);

        PDF::writeHTML(view('cyber.pdf.presensimengajar',[
                    'data' => $query, 
                    'hari' => $hari,
                    'dosen' => $dosen,
                    'tahun' => $req->tahun,
                    'semester' => $req->semester,
                    'week' => $startweek,
                    'honor' => $honor,
                ])
            ->render(), true, false, false, false, '');

        return response()->make(PDF::Output('[PDF]PresensiMengajar','I'), 200, array('Content-Type' => 'application/pdf'));

    }

    public function presensimengajarLink(){
        $bb = Departemen::all();
        //Config::set('database.default', 'sim-lama');
        $aa = Dosen::all();
        $cc = Ruang::all();
        $dd = null;
        $ee = MataKuliah::all();
        $aa1 = DB::connection('sim-lama')->table('BDE9F164')->get();
        $tahun = DB::table('new_ploting')->select('tahun_ajaran')->distinct('tahun_ajaran')->get();
        
        return view('cyber.presensimengajar', ['data' => null, 'dosen' => $aa, 'dosen1' => $aa1, 'ruang' => $cc, 'finger' => $dd, 'matakuliah' => $ee, 'departemen' => $bb,'tahun_ajaran' => $tahun]);
    }

    public function cobaCyber(){
        $data = userInfo('177', '10.4.22.160', '0');
        return response()->json($data->nama);
    }
}
