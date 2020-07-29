<!DOCTYPE html>
<html lang="en">
<head>
	<title>Buku Gudang</title>
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
	<h2>Buku Gudang ({{$gudang->nama_gudang}})</h2>
	<p>Periode : {{$tgl_start}} s/d {{$tgl_end}}</p>
	<p></p>
	<table border="1" cellpadding="5">
		<thead>
			<tr style="font-weight: bold;background-color: gray;">
				<th class="text-center" style="width: 4%">No</th>
				<th class="text-center" style="width: 7%">Nota</th>
				<th class="text-center" style="width: 7%">Tanggal</th>
				<th class="text-center" style="width: 18%">Gudang</th>
				<th class="text-center" style="width: 7%">Berat</th>
				<th class="text-center" style="width: 7%">Harga</th>
				<th class="text-center" style="width: 12%">Jumlah</th>
				<th class="text-center" style="width: 7%">Tgl Kas</th>
				<th class="text-center" style="width: 12%">Rp Bayar</th>
				<th class="text-center" style="width: 11%">Rp Kekurangan</th>
				<th class="text-center" style="width: 9%">Metode Bayar</th>
			</tr>
		</thead>
		<tbody>
			<?php $n=1; ?>
			@foreach($data as $d)
				<!-- <tr nobr="true"> -->
				@if(!empty($d->detail[0]->payment[0]))
					@foreach($d->detail[0]->payment as $key => $r)
					@if($key == 0)
					<tr nobr="true">
					<td class="text-center" style="width: 4%">{{$n}}</td>
					<td class="text-center" style="width: 7%">{{$d->no_nota}}</td>
					<td class="text-center" style="width: 7%">{{$d->tgl_bongkar}}</td>
					<td class="text-left" style="width: 18%">{{$d->gudang->nama_gudang}}</td>
					<td class="text-right" style="width: 7%">{{$d->detail[0]->berat}}</td>
					<td class="text-right" style="width: 7%">{{$d->detail[0]->harga}}</td>
					<td class="text-right" style="width: 12%">{{$d->detail[0]->rp_tagihan}}</td>
					<td class="text-center" style="width: 7%">{{$r->tgl_kas}}</td>
					<td class="text-right" style="width: 12%">{{$r->rp_bayar}}</td>
					<td class="text-right" style="width: 11%">{{$r->rp_kekurangan}}</td>
					<td class="text-left" style="width: 9%">{{$r->keterangan}}</td>
					</tr>
					@else
					<tr nobr="true">
					<td class="text-center" style="width: 4%"></td>
					<td class="text-center" style="width: 7%"></td>
					<td class="text-center" style="width: 7%"></td>
					<td class="text-left" style="width: 18%"></td>
					<td class="text-right" style="width: 7%"></td>
					<td class="text-right" style="width: 7%"></td>
					<td class="text-right" style="width: 12%"></td>
					<td class="text-center" style="width: 7%">{{$r->tgl_kas}}</td>
					<td class="text-right" style="width: 12%">{{$r->rp_bayar}}</td>
					<td class="text-right" style="width: 11%">{{$r->rp_kekurangan}}</td>
					<td class="text-left" style="width: 9%">{{$r->keterangan}}</td>
					</tr>
					@endif
					@endforeach
				@else
					<tr nobr="true">
					<td class="text-center" style="width: 4%">{{$n}}</td>
					<td class="text-center" style="width: 7%">{{$d->no_nota}}</td>
					<td class="text-center" style="width: 7%">{{$d->tgl_bongkar}}</td>
					<td class="text-left" style="width: 18%">{{$d->gudang->nama_gudang}}</td>
					<td class="text-right" style="width: 7%">{{$d->detail[0]->berat}}</td>
					<td class="text-right" style="width: 7%">{{$d->detail[0]->harga}}</td>
					<td class="text-right" style="width: 12%">{{$d->detail[0]->rp_tagihan}}</td>
					<td class="text-center" style="width: 7%"></td>
					<td class="text-right" style="width: 12%"></td>
					<td class="text-right" style="width: 11%"></td>
					<td class="text-left" style="width: 9%"></td>
					</tr>
				@endif
				<!-- </tr> -->
				<?php $n++;?>
			@endforeach
		</tbody>
	</table>
</body>
</html>