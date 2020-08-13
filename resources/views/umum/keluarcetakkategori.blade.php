<!DOCTYPE html>
<html lang="en">
<head>
	<title>Laporan Kas</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style type="text/css">
	.text-right {
		text-align: right;
	}
	.text-center {
		text-align: center;
	}
	.text-left {
		text-align: left;
	}
	.text-capitalize {
		text-transform: capitalize;
	}
	h2{
		text-align: center;
		text-transform:uppercase;
		line-height: 0.8;
		font-size: 12;
	}
	h4{
		text-align: left;
		line-height: 0.8;
	}
	.break-page{
		page-break-before: always;
	}
</style>
<body>
	<h4>PT. YEKAPE SURABAYA</h4>
	<h4>Jl. Wijaya Kusuma No. 36</h4>
	<h4><u>Surabaya</u></h4>

	<br>&nbsp;
	<br>&nbsp;

	<h2>LAPORAN PENGELUARAN PENGGUNAAN ANGGARAN</h2>
	<h2>SIE SUB.BAG.PERLENGKAPAN; SUB.BAG.RUMAH TANGGA; KEPEGAWAIAN</h2>
	<h2>PERIODE : {{$periode}}</h2>
	<br>&nbsp;
	<br>&nbsp;

	<!-- <table border="0" width="100%" cellpadding="1">
		<tr>
			<td style="width: 15%; text-align: left;">Bagian/Bidang</td>
			<td style="width: 3%; text-align: center;">:</td>
			<td style="width: 20%; text-align: left;">Umum</td>
		</tr>
		<tr>
			<td style="width: 15%; text-align: left;">Sub.Bag/Sub.Bid</td>
			<td style="width: 3%; text-align: center;">:</td>
			<td style="width: 20%; text-align: left;">Rumah Tangga</td>
		</tr>
	</table> -->
	
	<br>&nbsp;
	<br>&nbsp;


	<table border="1" width="100%" cellpadding="3">
		<tr>
			<td style="width: 5%; text-align: center; font-weight: bold;">No</td>
			<td style="width: 70%; text-align: center; font-weight: bold;">Uraian</td>
			<td style="width: 25%; text-align: center; font-weight: bold;">Jumlah</td>
		</tr>
		<?php $n=1; $jml=0;?>
		@foreach($rekap as $r)
		<tr>
			<td style="width: 5%; text-align: center;">{{$n}}</td>
			<td style="width: 70%; text-align: left;">{{$r->keperluan->keterangan}}</td>
			<td style="width: 25%; text-align: right;">{{number_format($r->jml,0,',','.')}}</td>
		</tr>
		<?php $n++; $jml+=$r->jml;?>
		@endforeach
		<tr>
			<td style="width: 75%; text-align: center; font-weight: bold;" colspan="3">Jumlah Pengeluaran</td>
			<td style="width: 25%; text-align: right; font-weight: bold;">{{number_format($jml,0,',','.')}}</td>
		</tr>
	</table>

	<br>&nbsp;
	<br>&nbsp;
	<h4>Terbilang : {{terbilang($jml)}} rupiah</h4>
	<br>&nbsp;
	<br>&nbsp;
	<br>&nbsp;

	<table border="0" width="100%" cellpadding="2">
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;">Surabaya, {{date('Y-m-d')}}</td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;">Mengetahui</td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;">Dibuat oleh</td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;">Kabag. Umum</td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;">Kasubag. Perlengkapan</td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center; font-weight: bold;">Anang Heru Widodo, ST.</td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center; font-weight: bold;">Chairul Anam Subekti, SE.</td>
		</tr>
		<!-- <tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;">Diperiksa,</td>
			<td style="width: 30%; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;">Kabag. Keuangan</td>
			<td style="width: 30%; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center;"></td>
			<td style="width: 30%; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width: 30%; text-align: center;"></td>
			<td style="width: 40%; text-align: center; font-weight: bold;">Yeanny Lisa H, SE.Ak.</td>
			<td style="width: 30%; text-align: center;"></td>
		</tr> -->
	</table>

	
</body>
</html>