<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('cobaa', function () {
	$db = dbase_open(public_path('rekair.dbf'), 0);
	if($db){
		// $row = dbase_get_record_with_names($db, 2);
		dd(dbase_get_record_with_names($db,2));
		// $n = 0;
		// for ($i=1; $i <= dbase_numrecords($db); $i++) { 
		// 	// $tmp[$i] = 0;
		// 	$row = dbase_get_record_with_names($db, $i);
		// 	if($row["STAT_SMB"] == '30'){
		// 		$n++;
		// 	}
		// }
		// dbase_add_record($db, $tmp);
		// echo $n;
		// return response()->json($row);
	}
	
	
    // return response()->json(true);
});
Route::get('email', function () {
	$data = \App\Models\Dosen::all();
	foreach ($data as $row) {
		if($row->email != ''){
			$row->email = str_replace(' (at) ', '@', $row->email);
			$row->save();
		}
	}
	
	
    return response()->json(true);
});
Route::get('cek', function () {
	$data = [];
    $temp1 = [];
    $n = 0;
	for ($i=1; $i <= 25; $i++) { 
		$response = Curl::to('https://uacc.unair.ac.id/api/pengampu-mk?access-token=12Zn_ncqn8uM-FXnyE0FIi7ojXCNJ_PR&ID_SEMESTER=240&ID_PROGRAM_STUDI=65&page=' . $i)
	                        ->asJson()
	                        ->get();
	    if(property_exists($response, '_links') == true && property_exists($response->_links, 'next') == true){
	    	$next = $response->_links->next->href;
	    }else{
	    	$next = false;
	    }
	    $n = 0;
	    if(property_exists($response, 'items') == true){
	    	
	        foreach ($response->items as $row) {
	            // $save = $this->simpanPengampu($row);
	            // $n++;
	            if($row->ID_KELAS_MK == '120609'){//358476
	            	$temp1[] = $row;
	            }elseif($row->ID_KELAS_MK == '120657'){
	            	$temp1[] = $row;
	            }elseif($row->ID_KELAS_MK == '120658'){
	            	$temp1[] = $row;
	            }
	            $n++;
	        }
	        
	    }
	    // echo 'total ' . $n . ' next: ' . $next . '<br';
	}
	
    return response()->json(['total'=>$temp1,'aa'=>$n]);
});
Route::get('ambildosen', function () {
	$data = [];
	for ($i=1; $i <= 31; $i++) { 
		$response = Curl::to('http://uacc.unair.ac.id/api/dosen-v3?access-token=TK11GYyyme2_8D1FOdg4jjh4k9P4dI5c&ID_FAKULTAS=1&page=' . $i)
	                        ->asJson()
	                        ->get();
	    if(property_exists($response, '_links') == true && property_exists($response->_links, 'next') == true){
	    	$next = $response->_links->next->href;
	    }else{
	    	$next = false;
	    }
	    $n = 0;
	    if(property_exists($response, 'items') == true){
	    	$n = 0;
	        foreach ($response->items as $row) {
	            // $save = $this->simpanPengampu($row);
	            // $n++;
	            $temp = [
	            	'nip' => $row->nip_dosen,
	            	'nidn' => $row->nidn_dosen,
	            	'nama' => $row->nama_dosen,
	            	'email' => $row->email,
	            	'kd_prodi' => $row->programStudi->id,
	            	'nama_prodi' => $row->programStudi->nama,
	            	'kd_fakultas' => $row->fakultas->id,
	            	'nama_fakultas' => $row->fakultas->nama,
	            	'status' => $row->status_dosen,
	            	'golongan' => $row->golongan,
	            	'pendidikan_akhir' => $row->pendidikan_akhir,
	            	'rekening' => $row->rekening,
	            	'npwp' => $row->npwp
	            ];
	            $cek = \DB::table('dosen')->where('nip', $row->nip_dosen)->first();
	            if(!$cek){
	            	\DB::table('dosen')->insert($temp);
	            }
	            $n++;
	        }
	        
	    }
	    echo 'total ' . $n . ' next: ' . $next . '<br';
	}
	
    // return response()->json(['total'=>$n,'next' => $next]);
});
Route::get('ambilmahasiswa', function () {
	$data = [];
	for ($i=1; $i <= 1436; $i++) { 
		$response = Curl::to('http://uacc.unair.ac.id/api/mahasiswa-v3?access-token=TK11GYyyme2_8D1FOdg4jjh4k9P4dI5c&ID_FAKULTAS=1&page=' . $i)
	                        ->asJson()
	                        ->get();
	    if(property_exists($response, '_links') == true && property_exists($response->_links, 'next') == true){
	    	$next = $response->_links->next->href;
	    }else{
	    	$next = false;
	    }
	    $n = 0;
	    if(property_exists($response, 'items') == true){
	    	$n = 0;
	        foreach ($response->items as $row) {
	            // $save = $this->simpanPengampu($row);
	            // $n++;
	            $temp = [
	            	'nim' => $row->NIM_MHS,
	            	'nama' => $row->pengguna->NM_PENGGUNA,
	            	'gelar_depan' => $row->pengguna->GELAR_DEPAN,
	            	'gelar_belakang' => $row->pengguna->GELAR_BELAKANG,
	            	'jk' => $row->pengguna->JENIS_KELAMIN,
	            	'nama_prodi' => $row->PROGRAM_STUDI,
	            	'kd_prodi' => $row->ID_PROGRAM_STUDI,
	            	'thn_angkatan' => $row->THN_ANGKATAN_MHS
	            ];
	            $cek = \DB::table('mahasiswa')->where('nim', $row->NIM_MHS)->first();
	            if(!$cek){
	            	\DB::table('mahasiswa')->insert($temp);
	            }
	            $n++;
	        }
	        
	    }
	    echo 'total ' . $n . ' next: ' . $next . '<br';
	}
	
    // return response()->json(['total'=>$n,'next' => $next]);
});
Route::get('ambilruangan', function () {
	$data = [];
	for ($i=1; $i <= 33; $i++) { 
		$response = Curl::to('http://uacc.unair.ac.id/api/ruangan?access-token=' . getToken() . '&ID_FAKULTAS=1&page=' . $i)
	                        ->asJson()
	                        ->get();
	    if(property_exists($response, '_links') == true && property_exists($response->_links, 'next') == true){
	    	$next = $response->_links->next->href;
	    }else{
	    	$next = false;
	    }
	    $n = 0;
	    if(property_exists($response, 'items') == true){
	    	$n = 0;
	        foreach ($response->items as $row) {
	            // $save = $this->simpanPengampu($row);
	            // $n++;
	            $temp = [
	            	'kode_cyber' => $row->ID_RUANGAN,
	            	'nama_ruang' => $row->NM_RUANGAN,
	            	'tipe_ruang' => $row->TIPE_RUANGAN,
	            	'kapasitas' => $row->KAPASITAS_RUANGAN,
	            	'kapasitas_ujian' => $row->KAPASITAS_UJIAN,
	            ];
	            $cek = \DB::table('ruang')->where('kode_cyber', $row->ID_RUANGAN)->first();
	            if(!$cek){
	            	\DB::table('ruang')->insert($temp);
	            }
	            $n++;
	        }
	        
	    }
	    echo 'total ' . $n . ' next: ' . $next . '<br';
	}
	
    // return response()->json(['total'=>$n,'next' => $next]);
});

Route::get('ambilprodi', function () {
	$data = [];
	for ($i=1; $i <= 4; $i++) { 
		$response = Curl::to('http://uacc.unair.ac.id/api/program-studi?access-token=' . getToken() . '&ID_FAKULTAS=1&page=' . $i)
	                        ->asJson()
	                        ->get();
	    if(property_exists($response, '_links') == true && property_exists($response->_links, 'next') == true){
	    	$next = $response->_links->next->href;
	    }else{
	    	$next = false;
	    }
	    $n = 0;
	    if(property_exists($response, 'items') == true){
	    	$n = 0;
	        foreach ($response->items as $row) {
	            // $save = $this->simpanPengampu($row);
	            // $n++;
	            $temp = [
	            	'id_prodi' => $row->ID_PROGRAM_STUDI,
	                'nama_prodi' => $row->NM_PROGRAM_STUDI,
	                'jenjang' => $row->jenjang->NM_JENJANG,
	                'nama_jenjang' => $row->jenjang->NM_JENJANG_IJASAH,
	            ];
	            $cek = \DB::table('cyber_prodi')->where('id_prodi', $row->ID_PROGRAM_STUDI)->first();
	            if(!$cek){
	            	\DB::table('cyber_prodi')->insert($temp);
	            }
	            $n++;
	        }
	        
	    }
	    echo 'total ' . $n . ' next: ' . $next . '<br';
	}
	
    // return response()->json(['total'=>$n,'next' => $next]);
});

