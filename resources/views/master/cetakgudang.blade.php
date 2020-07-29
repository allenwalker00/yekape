<!DOCTYPE html>
<html lang="en">
<head>
	<title>Data Gudang</title>
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
	<h2>Master Gudang</h2>
	<p></p>
	<p></p>
	<table border="1" cellpadding="5">
		<thead>
			<tr style="font-weight: bold;background-color: gray;">
				<th class="text-center" style="width: 4%">No</th>
				<th class="text-center" style="width: 18%">Nama Gudang</th>
				<th class="text-center" style="width: 12%">Pemilik</th>
				<th class="text-center" style="width: 12%">Direksi</th>
				<th class="text-center" style="width: 34%">Alamat</th>
				<th class="text-center" style="width: 10%">Telp</th>
				<th class="text-center" style="width: 10%">HP</th>
			</tr>
		</thead>
		<tbody>
			<?php $n=1; ?>
			@foreach($data as $d)
				<tr nobr="true">
					<td class="text-center" style="width: 4%">{{$n}}</td>
					<td class="text-left" style="width: 18%">{{$d->nama_gudang}}</td>
					<td class="text-left" style="width: 12%">{{$d->pemilik}}</td>
					<td class="text-left" style="width: 12%">{{$d->direksi}}</td>
					<td class="text-left" style="width: 34%">{{$d->alamat_gudang}}</td>
					<td class="text-left" style="width: 10%">{{$d->telp}}</td>
					<td class="text-left" style="width: 10%">{{$d->hp}}</td>
				</tr>
				<?php $n++;?>
			@endforeach
		</tbody>
	</table>
</body>
</html>