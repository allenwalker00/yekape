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
	h2{
		text-align: center;
		text-transform:uppercase;
	}
	.break-page{
		page-break-before: always;
	}
</style>
<body>
	<h2>REKAPITULASI</h2>
	<h2>PENGAJUAN PEMBAYARAN</h2>
	<br>&nbsp;
	<br>&nbsp;

	<table border="0" width="100%" cellpadding="3">
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
	</table>
	
	<br>&nbsp;
	<br>&nbsp;
	<br>&nbsp;


	<table border="1" width="100%" cellpadding="3">
		<tr>
			<td style="width: 5%; text-align: center; font-weight: bold;">No</td>
			<td style="width: 10%; text-align: center; font-weight: bold;">Tanggal</td>
			<td style="width: 70%; text-align: center; font-weight: bold;">Untuk Pembayaran</td>
			<td style="width: 15%; text-align: center; font-weight: bold;">Jumlah</td>
		</tr>
		<?php $n=1; $jml=0;?>
		@foreach($data as $r)
		<tr>
			<td style="width: 5%; text-align: center;">{{$n}}</td>
			<td style="width: 10%; text-align: center;">{{$r->tanggal}}</td>
			<td style="width: 70%; text-align: left;">{{$r->keterangan}}</td>
			<td style="width: 15%; text-align: right;">{{number_format($r->jumlah,0,',','.')}}</td>
		</tr>
		<?php $n++; $jml+=$r->jumlah;?>
		@endforeach
		<tr>
			<td style="width: 85%; text-align: center; font-weight: bold;" colspan="3">TOTAL</td>
			<td style="width: 15%; text-align: right; font-weight: bold;">{{number_format($jml,0,',','.')}}</td>
		</tr>
	</table>

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
			<td style="width: 30%; text-align: center;">Kasubag. Rumah Tangga</td>
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
			<td style="width: 30%; text-align: center; font-weight: bold;">Miftahul Huda</td>
		</tr>
		<tr>
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
		</tr>
	</table>

	
</body>
</html>