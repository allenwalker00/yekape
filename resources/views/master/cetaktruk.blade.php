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
	<h2>Master Truk</h2>
	<p></p>
	<p></p>
	<table border="1" cellpadding="5">
		<thead>
			<tr style="font-weight: bold;background-color: gray;">
				<th class="text-center" style="width: 4%">No</th>
				<th class="text-center" style="width: 12%">Kode Truk</th>
				<th class="text-center" style="width: 12%">Nopol</th>
				<th class="text-center" style="width: 18%">Nama Supir</th>
				<th class="text-center" style="width: 34%">Alamat Supir</th>
				<th class="text-center" style="width: 20%">HP</th>
			</tr>
		</thead>
		<tbody>
			<?php $n=1; ?>
			@foreach($data as $d)
				<tr nobr="true">
					<td class="text-center" style="width: 4%">{{$n}}</td>
					<td class="text-left" style="width: 12%">{{$d->kode_truk}}</td>
					<td class="text-left" style="width: 12%">{{$d->nopol}}</td>
					<td class="text-left" style="width: 18%">{{$d->nama_supir}}</td>
					<td class="text-left" style="width: 34%">{{$d->alamat_supir}}</td>
					<td class="text-left" style="width: 20%">{{$d->hp}}</td>
				</tr>
				<?php $n++;?>
			@endforeach
		</tbody>
	</table>
</body>
</html>