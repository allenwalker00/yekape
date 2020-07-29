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
    App\Models\KurikulumSemester,
    App\Models\Plot,
    App\Models\PlotHarian,
    App\Models\CyberPengampu,
    App\Models\PlotDosen,
    App\Models\Departemen;


class ApiController extends Controller
{
    public function ruangUpdateCyber(Request $temp){
        //http://uacc.unair.ac.id/api/ruangan?access-token=YP_4h3HnQlhxVAegP9gNjS5pX8-SsszG&&ID_FAKULTAS=1&expand=gedung
        $resp = Curl::to('http://uacc.unair.ac.id/api/ruangan?access-token=' . getToken() . '&expand=gedung&ID_FAKULTAS=1&page=1')
                            ->asJson()
                            ->get();
        $n = 0;
        $page = 0;
        if(property_exists($resp, '_meta') == true){
            $page = $resp->_meta->pageCount;
        }
        if(property_exists($resp, 'items') == true){
            // $n = 0;
            foreach ($resp->items as $row) {
                // $save = $this->simpanPengampu($row);
                // $n++;
                $temp = [
                    // 'kode_cyber' => $row->ID_RUANGAN,
                    'nama_ruang' => $row->NM_RUANGAN,
                    'tipe_ruang' => $row->TIPE_RUANGAN,
                    'desk_ruang' => $row->DESKRIPSI_RUANGAN,
                    'id_gedung' => $row->ID_GEDUNG,
                    'kode_gedung' => $row->gedung->KODE_GEDUNG,
                    'nama_gedung' => $row->gedung->NM_GEDUNG,
                    'lokasi_gedung' => $row->gedung->LOKASI_GEDUNG,
                    'desk_gedung' => $row->gedung->DESKRIPSI_GEDUNG,
                    'kapasitas' => $row->KAPASITAS_RUANGAN,
                    'kapasitas_ujian' => $row->KAPASITAS_UJIAN,
                ];
                $cek = DB::table('ruang')->where('kode_cyber', $row->ID_RUANGAN)->first();
                if(!$cek){
                    $temp['kode_cyber'] = $row->ID_RUANGAN;
                    DB::table('ruang')->insert($temp);
                }else{
                    DB::table('ruang')->where('kode_cyber', $row->ID_RUANGAN)->update($temp);
                }
                $n++;
            }
            
        }
        $data = [];
        for ($i=2; $i <= $page; $i++) { 
            $response = Curl::to('http://uacc.unair.ac.id/api/ruangan?access-token=' . getToken() . '&expand=gedung&ID_FAKULTAS=1&page=' . $i)
                                ->asJson()
                                ->get();
            // $n = 0;
            if(property_exists($response, 'items') == true){
                // $n = 0;
                foreach ($response->items as $row) {
                    // $save = $this->simpanPengampu($row);
                    // $n++;
                    $temp = [
                        // 'kode_cyber' => $row->ID_RUANGAN,
                        'nama_ruang' => $row->NM_RUANGAN,
                        'tipe_ruang' => $row->TIPE_RUANGAN,
                        'desk_ruang' => $row->DESKRIPSI_RUANGAN,
                        'id_gedung' => $row->ID_GEDUNG,
                        'kode_gedung' => $row->gedung->KODE_GEDUNG,
                        'nama_gedung' => $row->gedung->NM_GEDUNG,
                        'lokasi_gedung' => $row->gedung->LOKASI_GEDUNG,
                        'desk_gedung' => $row->gedung->DESKRIPSI_GEDUNG,
                        'kapasitas' => $row->KAPASITAS_RUANGAN,
                        'kapasitas_ujian' => $row->KAPASITAS_UJIAN,
                    ];
                    $cek = DB::table('ruang')->where('kode_cyber', $row->ID_RUANGAN)->first();
                    if(!$cek){
                        $temp['kode_cyber'] = $row->ID_RUANGAN;
                        DB::table('ruang')->insert($temp);
                    }else{
                        DB::table('ruang')->where('kode_cyber', $row->ID_RUANGAN)->update($temp);
                    }
                    $n++;
                }
                
            }
            // echo 'total ' . $n . ' next: ' . $next . '<br';
        }
        return response()->json(['total' => $n]);
    }

    public function ambilPlotingCyber(Request $temp){
        $tahun = $temp->tahun;
        $prodi = $temp->prodi;
        $param = explode(';', $temp->param);
        
        
        //PLOTING
        $curlawal = false;
        while ($curlawal == false) {
            $curlawal = $this->curlPlotingAwal($tahun, $prodi, 0,$param[1], $param[0], $param[2]);
        }
        //iterasi selanjutnya
        $page = $curlawal;
        for($i=2; $i<=$page; $i++){
            //sleep(10);
            $curl = false;
            while (!$curl) {
                $curl = $this->curlPloting($tahun, $prodi, $i,$param[1], $param[0], $param[2]);
            }
        }

        //PENGAMPU
        CyberPengampu::whereHas('ploting', function($sql) use ($tahun, $prodi) {
            $sql->where('tahun_akademik', $tahun)->where('id_prodi', $prodi);
        })->delete();
        $curlawal1 = false;
        while ($curlawal1 == false) {
            $curlawal1 = $this->curlPengampuAwal($tahun, $prodi, 0);
        }
        //iterasi pertama
        //iterasi selanjutnya
        $page1 = $curlawal1;
        for($i=2; $i<=$page1; $i++){
            //sleep(10);
            $curl1 = false;
            while (!$curl1) {
                $curl1 = $this->curlPengampu($tahun, $prodi, $i);
            }
            
        }
        return response()->json(true);
    }
    
    public function ambilCyberSemester(){
        $response = Curl::to('https://uacc.unair.ac.id/api/semester?access-token=' . getToken() . '&STATUS_AKTIF_SEMESTER=True')
            ->asJson()
            ->get();
        $tahun_ajaran = $response->items[0]->TAHUN_AJARAN;
        $tahun_akademik = $response->items[0]->THN_AKADEMIK_SEMESTER;

        return response()->json($response);
    }

    public function ambilCyberJadwal(){
        $response1 = Curl::to('https://uacc.unair.ac.id/api/semester?access-token=' . getToken() . '&STATUS_AKTIF_SEMESTER=True')
            ->asJson()
            ->get();
        $tahun_ajaran = $response1->items[0]->TAHUN_AJARAN;
        $tahun_akademik = $response1->items[0]->THN_AKADEMIK_SEMESTER;
        $group_semester = $response1->items[0]->NM_SEMESTER;
        $id_semester = $response1->items[0]->ID_SEMESTER;

        $kode_prodi = [66, 67];

        foreach ($kode_prodi as $baris) {
            $n=0;
            //iterasi pertama
            $curlawal = false;
            while ($curlawal == false) {
                $curlawal = $this->curlPlotingAwal($id_semester, $baris, 0,$tahun_akademik, $tahun_ajaran, $group_semester);
            }
            //iterasi selanjutnya
            $page = $curlawal;
            for($i=2; $i<=$page; $i++){
                //sleep(10);
                $curl = false;
                while (!$curl) {
                    $curl = $this->curlPloting($id_semester, $baris, $i,$tahun_akademik, $tahun_ajaran, $group_semester);
                }
            }
            $tmp[] = $baris . ' ' . $n;
        }
        

        return response()->json($tmp);
    }

    public function ambilCyberJadwal2(){
        $response1 = Curl::to('https://uacc.unair.ac.id/api/semester?access-token=' . getToken() . '&STATUS_AKTIF_SEMESTER=True')
            ->asJson()
            ->get();
        $tahun_ajaran = $response1->items[0]->TAHUN_AJARAN;
        $tahun_akademik = $response1->items[0]->THN_AKADEMIK_SEMESTER;
        $group_semester = $response1->items[0]->NM_SEMESTER;
        $id_semester = $response1->items[0]->ID_SEMESTER;

        $kode_prodi = [64, 65, 66, 67];
        $baris = 67;

        $n=0;
		//iterasi pertama
		
        $response1 = Curl::to('https://uacc.unair.ac.id/api/jadwal-kelas?access-token=' . getToken() . '&ID_SEMESTER='.$id_semester.'&ID_PROGRAM_STUDI=' . $baris)
                            ->asJson()
                            ->get();
        foreach ($response1->items as $row) {
            $save = $this->simpanPloting($row, $tahun_akademik, $tahun_ajaran, $group_semester);
            $n++;
        }
        //iterasi selanjutnya
        $page = $response1->_meta->pageCount;
        for($i=2; $i<=$page; $i++){
            sleep(10);
            $response = Curl::to('https://uacc.unair.ac.id/api/jadwal-kelas/index?access-token=' . getToken() . '&ID_SEMESTER='.$id_semester.'&ID_PROGRAM_STUDI=' . $baris . '&page=' . $i)
                            ->asJson()
                            ->get();
            foreach ($response->items as $row) {
                $save = $this->simpanPloting($row, $tahun_akademik, $tahun_ajaran, $group_semester);
                $n++;
            }
        }
        $tmp[] = $baris . ' ' . $n;
        

        return response()->json($tmp);
    }

    public function ambilCyberPengampu(){
        $id_semester = 237;
        $kode_prodi = [67];//[64, 65, 66, 67]
        //$baris = 64;
		
		foreach($kode_prodi as $baris){
			$n=0;
			//iterasi pertama
            $curlawal = false;
            while ($curlawal == false) {
                $curlawal = $this->curlPengampuAwal($id_semester, $baris, 0);
            }
			//iterasi pertama
			//iterasi selanjutnya
			$page = $curlawal;
			for($i=2; $i<=$page; $i++){
				//sleep(10);
				$curl = false;
				while (!$curl) {
					$curl = $this->curlPengampu($id_semester, $baris, $i);
				}
				
			}
			$tmp[] = $baris . ' ' . $n;
		}
        
        return response()->json($tmp);
    }

    public function ambilCyberProdi(){
        $response = Curl::to('https://uacc.unair.ac.id/api/program-studi?access-token=' . getToken() . '&ID_FAKULTAS=4')
            ->asJson()
            ->get();

        foreach ($response->items as $row) {
            DB::table('cyber_prodi')->insert([
                'id_prodi' => $row->ID_PROGRAM_STUDI,
                'nama_prodi' => $row->NM_PROGRAM_STUDI,
                'jenjang' => $row->jenjang->NM_JENJANG,
                'nama_jenjang' => $row->jenjang->NM_JENJANG_IJASAH,
            ]);
        }

        return response()->json(count($response->items));
    }

    private function simpanPloting($row, $tahun_akademik, $tahun_ajaran, $group_semester){
        DB::table('cyber_ploting')->where('id_jadwal_kelas', $row->ID_JADWAL_KELAS)->delete();
        DB::table('cyber_ploting')->insert([
            'id_jadwal_kelas' => $row->ID_JADWAL_KELAS,
            'id_kelas_mk' => $row->ID_KELAS_MK,
            'id_ruangan' => $row->ruangan->ID_RUANGAN,
            'nama_ruangan' => $row->ruangan->NM_RUANGAN,
            'no_kelas_mk' => $row->kelasMk->NO_KELAS_MK,
            'nama_kelas' => $row->kelasMk->namaKelas->NAMA_KELAS,
            'sks' => $row->kelasMk->kurikulumMk->KREDIT_SEMESTER,
            'kode_mk' => $row->kelasMk->kurikulumMk->mataKuliah->KD_MATA_KULIAH,
            'nama_mk' => $row->kelasMk->kurikulumMk->mataKuliah->NM_MATA_KULIAH,
            'nama_mk_en' => $row->kelasMk->kurikulumMk->mataKuliah->NM_MATA_KULIAH_EN,
            'id_prodi' => $row->kelasMk->programStudi->ID_PROGRAM_STUDI,
            'nama_prodi' => $row->kelasMk->programStudi->NM_PROGRAM_STUDI,
            'id_jam' => ($row->jam) ? $row->jam->ID_JADWAL_JAM : '-',
            'nama_jam' => ($row->jam) ? $row->jam->NM_JADWAL_JAM : '-',
            'jam_mulai' => ($row->jam) ? $row->jam->JAM_MULAI . ':' . $row->jam->MENIT_MULAI : '-',
            'jam_selesai' => ($row->jam) ? $row->jam->JAM_SELESAI . ':' . $row->jam->MENIT_SELESAI : '-',
            'id_hari' => $row->jadwalHari->ID_JADWAL_HARI,
            'nama_hari' => $row->jadwalHari->NM_JADWAL_HARI,
            'tahun_akademik' => $tahun_akademik,
            'tahun_ajaran' => $tahun_ajaran,
            'group_semester' => $group_semester,
            'tingkat_semester' => $row->kelasMk->kurikulumMk->TINGKAT_SEMESTER,
        ]);
        return true;
    }

    private function curlPlotingAwal($id_semester, $id_prodi, $page, $tahun_akademik, $tahun_ajaran, $group_semester){
        try {
            $response = Curl::to('https://uacc.unair.ac.id/api/jadwal-kelas?access-token=' . getToken() . '&ID_SEMESTER='.$id_semester.'&ID_PROGRAM_STUDI=' . $id_prodi)
                            ->asJson()
                            ->get();
            if(isset($response->items)){
                foreach ($response->items as $row) {
                    $save = $this->simpanPloting($row, $tahun_akademik, $tahun_ajaran, $group_semester);
                    // $n++;
                }
                return $response->_meta->pageCount;
            }else{
                return false;
            }
            
        } catch (Exception $e) {
            return false; 
        }
        
        
    }

    private function curlPloting($id_semester, $id_prodi, $page, $tahun_akademik, $tahun_ajaran, $group_semester){
        try {
            $response = Curl::to('https://uacc.unair.ac.id/api/jadwal-kelas/index?access-token=' . getToken() . '&ID_SEMESTER='.$id_semester.'&ID_PROGRAM_STUDI=' . $id_prodi . '&page=' . $page)
                            ->asJson()
                            ->get();
            if(isset($response->items)){
                foreach ($response->items as $row) {
                    $save = $this->simpanPloting($row, $tahun_akademik, $tahun_ajaran, $group_semester);
                    // $n++;
                }
                return true;
            }else{
                return false;
            }
            
        } catch (Exception $e) {
            return false; 
        }
        
        
    }

    private function simpanPengampu($row){
        $cek =DB::table('cyber_pengampu')->where('nip_dosen', $row->dosen->nip_dosen)->whereRaw("id_pengampu_mk='".$row->ID_PENGAMPU_MK."'")->first();
        if(!$cek){
            DB::table('cyber_pengampu')->whereRaw("id_pengampu_mk='".$row->ID_PENGAMPU_MK."'")->delete();
            DB::table('cyber_pengampu')->insert([
                'id_pengampu_mk' => $row->ID_PENGAMPU_MK,
                'id_kelas_mk' => $row->ID_KELAS_MK,
                'id_dosen' => $row->ID_DOSEN,
                'nip_dosen' => $row->dosen->nip_dosen,
                'nidn_dosen' => $row->dosen->nidn_dosen,
                'nama_dosen' => $row->dosen->nama_dosen,
                'status_dosen' => $row->dosen->status_dosen,
                'golongan' => $row->dosen->golongan,
                'rekening' => $row->dosen->rekening,
                'pjmk' => $row->PJMK_PENGAMPU_MK,
            ]);
        }
        return true;
    }

    private function curlPengampu($id_semester, $id_prodi, $page){
        try {
            $response = Curl::to('https://uacc.unair.ac.id/api/pengampu-mk?access-token=' . getToken() . '&ID_SEMESTER='.$id_semester.'&ID_PROGRAM_STUDI=' . $id_prodi . '&page=' . $page)
                            ->asJson()
                            ->get();
            if(isset($response->items)){
                foreach ($response->items as $row) {
                    $save = $this->simpanPengampu($row);
                    // $n++;
                }
                return true;
            }else{
                return false;
            }
            
        } catch (Exception $e) {
            return false; 
        }
    }
	
	private function curlPengampuAwal($id_semester, $id_prodi, $page){
        try {
            $response = Curl::to('https://uacc.unair.ac.id/api/pengampu-mk?access-token=' . getToken() . '&ID_SEMESTER='.$id_semester.'&ID_PROGRAM_STUDI=' . $id_prodi)
                            ->asJson()
                            ->get();
            if(isset($response->items)){
                foreach ($response->items as $row) {
                    $save = $this->simpanPengampu($row);
                    // $n++;
                }
                return $response->_meta->pageCount;
            }else{
                return false;
            }
            
        } catch (Exception $e) {
            return false; 
        }  
    }
    
}
