<?php 

function getNamaHari($no){
	$no = (int) $no;
	$hari = ['Hari', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
	
	return ($no > 0 && $no < 8)? $hari[$no] : 'Hari';	
}

function getNamaBulan($no){
	$no = (int) $no;
	$bulan = ['Bulan', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	
	return ($no > 0 && $no < 13)? $bulan[$no] : 'bulan';	
	
}

function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}

function getTanggalLengkap($date){
	list($y, $m, $d) = explode('-', $date);
	
	return getNamaHari(date('N', strtotime($date))).', '.$d.' '.getNamaBulan($m).' '.$y;
}

function e_debug($data, $debug = false){
	echo '<pre>';
	if($debug){
		var_dump($data);
	}else{
		print_r($data);
	}
	echo '</pre>';
}

function convertSize($size){
	$unit=array('b','kb','mb','gb','tb','pb');
	return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

function hextobin($data = ''){
	return trim(hex2bin($data));
}

function singleRowUnstream($data){
	if(is_object($data)){
		foreach($data as $k=>$v){
			$data->$k = trim(hex2bin($v));
		}
	}
	return $data;
}

function readFinger($IP, $awal, $akhir){
	$Key = 0;
	$ret = [];
	$n=0;
	try {
		$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
		//$st = 'connected ' . $IP . '';
		if($Connect){
			$st = 'connected1 ' . $IP . '';
			$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
			$newLine="\r\n";
			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
			fputs($Connect, "Content-Type: text/xml".$newLine);
			fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
			fputs($Connect, $soap_request.$newLine);
			$buffer="";
			while($Response=fgets($Connect, 1024)){
				$buffer=$buffer.$Response;
			}
		}else $st="Koneksi Gagal";
		$buffer=ParseData($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
		$buffer=explode("\r\n",$buffer);
		for($a=0;$a<count($buffer);$a++){
			$data=ParseData($buffer[$a],"<Row>","</Row>");
			$PIN=ParseData($data,"<PIN>","</PIN>");
			$DateTime=ParseData($data,"<DateTime>","</DateTime>");
			//echo $PIN;
			if($PIN!=null && $PIN>20){
				//$nip = $this->get_user_info($PIN,$IP,$Key)->nama;
				$tglAwal = date('Y-m-d H:i:s', strtotime($awal)); 
				$tglAkhir = date('Y-m-d H:i:s', strtotime($akhir));
				$tanggal = date('Y-m-d H:i:s', strtotime($DateTime));
				//echo $tanggal ."<br>";
				if ($tanggal >= $tglAwal && $tanggal <= $tglAkhir)
				{
					$ret[$n]['kode'] = $PIN;
					$ret[$n]['tgl'] = $DateTime;
					$n++;
				}
				   
			}
		   
		}
	}
	catch(\Exception $ex) { //used back-slash for global namespace
		$st = 'error connection ' . $IP. $ex;
		$ret = $st;
	}
	
	return $ret;
}

function userInfo($id,$IP,$Key){
      
        if($id!=""){
            $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
            if($Connect){
                $soap_request="<GetUserInfo><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">".$id."</PIN></Arg></GetUserInfo>";
                $newLine="\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                fputs($Connect, "Content-Type: text/xml".$newLine);
                fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                fputs($Connect, $soap_request.$newLine);
                $buffer="";
                while($Response=fgets($Connect, 1024)){
                    $buffer=$buffer.$Response;
                }
            }else echo "Koneksi Gagal";
        
            $buffer= ParseData($buffer,"<GetUserInfoResponse>","</GetUserInfoResponse>");
            $buffer=explode("\r\n",$buffer);
            
            for($a=0;$a<count($buffer);$a++){
                $data= ParseData($buffer[$a],"<Row>","</Row>");
                if($data!=null){
              
                $PIN= ParseData($data,"<PIN>","</PIN>");
                $Name= ParseData($data,"<Name>","</Name>");
                $Password= ParseData($data,"<Password>","</Password>");
              
                $results = array(
                    "pin" => $PIN,
                    "nama" => $Name,
                    "password" => $Password
                    );
                }
            }
           
            return (object) $results;
        }
       
    }

function ParseData($data,$p1,$p2){
	$data=" ".$data;
	$hasil="";
	$awal=strpos($data,$p1);
	if($awal!=""){
		$akhir=strpos(strstr($data,$p1),$p2);
		if($akhir!=""){
			$hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
		}
	}
	return $hasil;	
}

function getToken(){
	$temp = DB::table('access_token')->first();
	$token = $temp->token;
	$response = Curl::to('https://uacc.unair.ac.id/api/semester?access-token=' . $token . '&STATUS_AKTIF_SEMESTER=True')
            ->asJson()
            ->get();
    if(!isset($response->items)){
    	$response = Curl::to('https://uacc.unair.ac.id/api/auth/login')
			            ->withData([
			                "LoginForm[username]" => "196501021987011001",
			                "LoginForm[password]" => "basuni123"
			            ])
			            ->post();
		$response = json_decode($response);
	    if($response->status == 'success'){
	    	DB::table('access_token')->where('id', 1)->update(['token' => $response->data->token]);
	    	$token = $response->data->token;
	    }
    }
	return $token;
}

function terbilang($angka) {
   $angka=abs($angka);
   $baca =array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
 
   $terbilang="";
    if ($angka < 12){
        $terbilang= " " . $baca[$angka];
    }
    else if ($angka < 20){
        $terbilang= terbilang($angka - 10) . " belas";
    }
    else if ($angka < 100){
        $terbilang= terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
    }
    else if ($angka < 200){
        $terbilang= " seratus" . terbilang($angka - 100);
    }
    else if ($angka < 1000){
        $terbilang= terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
    }
    else if ($angka < 2000){
        $terbilang= " seribu" . terbilang($angka - 1000);
    }
    else if ($angka < 1000000){
        $terbilang= terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
    }
    else if ($angka < 1000000000){
       $terbilang= terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
    }
       return $terbilang;
}