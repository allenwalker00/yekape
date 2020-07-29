<!DOCTYPE html>
<html lang="en">
<head>
	<title>Data Seleb</title>
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
	<h2>Master Seleb</h2>
	<p></p>
	<p></p>
	<table border="1" cellpadding="5">
		<thead>
			<tr style="font-weight: bold;background-color: gray;">
				<th class="text-center" style="width: 4%">No</th>
				<th class="text-center" style="width: 20%">Nama</th>
				<th class="text-center" style="width: 10%">Kabupaten</th>
				<th class="text-center" style="width: 12%">Kecamatan</th>
				<th class="text-center" style="width: 10%">Telp</th>
				<th class="text-center" style="width: 10%">Hp</th>
				<th class="text-center" style="width: 10%">Rek Bank</th>
				<th class="text-center" style="width: 12%">Nama Rek</th>
				<th class="text-center" style="width: 12%">No Rek</th>
			</tr>
		</thead>
		<tbody>
			<?php $n=1; ?>
			@foreach($data as $d)
				<tr nobr="true">
					<td class="text-center" style="width: 4%">{{$n}}</td>
					<td class="text-left" style="width: 20%">{{$d->nama_seleb}}</td>
					<td class="text-left" style="width: 10%">{{$d->kabupaten}}</td>
					<td class="text-left" style="width: 12%">{{$d->kecamatan}}</td>
					<td class="text-left" style="width: 10%">{{$d->telp}}</td>
					<td class="text-left" style="width: 10%">{{$d->hp}}</td>
					<td class="text-left" style="width: 10%">{{$d->rek_bank}}</td>
					<td class="text-left" style="width: 12%">{{$d->rek_nama}}</td>
					<td class="text-left" style="width: 12%">{{$d->rek_nomor}}</td>
				</tr>
				<?php $n++;?>
			@endforeach
		</tbody>
	</table>
</body>
</html>