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
	
	<br>&nbsp;
	<br>&nbsp;
	<br>&nbsp;


	<table border="1" width="100%" cellpadding="3">
		<tr>
			<td style="width: 12%; text-align: center;">Tanggal</td>
			<td style="width: 40%; text-align: center;">Keterangan</td>
			<td style="width: 16%; text-align: center;">Debit</td>
			<td style="width: 16%; text-align: center;">Kredit</td>
			<td style="width: 16%; text-align: center;">Saldo</td>
		</tr>
		@foreach($data as $row)
		<tr>
			<td style="width: 12%;">{{$row->tgl_kas}}</td>
			<td style="width: 40%;">{{$row->keterangan}}</td>
			<td style="width: 16%; text-align: right;">{{number_format($row->debit,0,',','.')}}</td>
			<td style="width: 16%; text-align: right;">{{number_format($row->kredit,0,',','.')}}</td>
			<td style="width: 16%; text-align: right;">{{number_format($row->saldo_akhir,0,',','.')}}</td>
		</tr>
		@endforeach
	</table>

	
</body>
</html>