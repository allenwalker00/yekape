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
	<h2>LAPORAN KAS</h2>
	<p style="text-align: center;">Tanggal Cetak : {{date('d-m-Y')}}</p>
	
	<br>&nbsp;
	<br>&nbsp;
	<br>&nbsp;


	<table border="1" width="100%" cellpadding="3">
		<tr>
			<td style="width: 5%; text-align: center; font-weight: bold;">No</td>
			<td style="width: 12%; text-align: center; font-weight: bold;">Tanggal</td>
			<td style="width: 35%; text-align: center; font-weight: bold;">Keterangan</td>
			<td style="width: 16%; text-align: center; font-weight: bold;">Kredit</td>
			<td style="width: 16%; text-align: center; font-weight: bold;">Debit</td>
			<td style="width: 16%; text-align: center; font-weight: bold;">Saldo Akhir</td>
		</tr>
		<?php $n=1; ?>
		@foreach($data as $row)
		<tr>
			<td style="width: 5%; text-align: center;">{{$n}}</td>
			<td style="width: 12%; text-align: center;">{{$row->tanggal}}</td>
			<td style="width: 35%;">{{$row->keterangan}}</td>
			<td style="width: 16%; text-align: right;">{{number_format($row->kredit,0,',','.')}}</td>
			<td style="width: 16%; text-align: right;">{{number_format($row->debit,0,',','.')}}</td>
			<td style="width: 16%; text-align: right;">{{number_format($row->saldo_akhir,0,',','.')}}</td>
		</tr>
		<?php $n++; ?>
		@endforeach
		<tr>
			<td style="width: 52%; text-align: center; font-weight: bold;" colspan="3">TOTAL</td>
			<td style="width: 16%; text-align: right; font-weight: bold;">{{number_format($jml_kredit,0,',','.')}}</td>
			<td style="width: 16%; text-align: right; font-weight: bold;">{{number_format($jml_debit,0,',','.')}}</td>
			<td style="width: 16%; text-align: right; font-weight: bold;">{{number_format($jml_saldo,0,',','.')}}</td>
		</tr>
	</table>

	
</body>
</html>