<!DOCTYPE html>
<html lang="en">
<head>
	<title>Buku Seleb</title>
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
	<h2>Buku Seleb ({{$seleb->nama_seleb}})</h2>
	<p>Periode : {{$tgl_start}} s/d {{$tgl_end}}</p>
	<p>Data Transaksi Muat</p>
	<table border="1" cellpadding="5">
		<thead>
			<tr style="font-weight: bold;background-color: gray;">
				<th class="text-center" style="width: 4%">No</th>
				<th class="text-center" style="width: 7%">Tanggal</th>
				<th class="text-center" style="width: 11%">Seleb</th>
				<th class="text-center" style="width: 7%">Berat</th>
				<th class="text-center" style="width: 7%">Harga</th>
				<th class="text-center" style="width: 11%">Supir</th>
				<th class="text-center" style="width: 18%">Kirim Ke</th>
				<th class="text-center" style="width: 7%">Tgl Bayar</th>
				<th class="text-center" style="width: 10%">Rp Bayar</th>
				<th class="text-center" style="width: 10%">Sisa Uang</th>
				<th class="text-center" style="width: 9%">Metode Bayar</th>
			</tr>
		</thead>
		<tbody>
			<?php $n=1; ?>
			@foreach($data as $d)
				<tr nobr="true">
					<td class="text-center" style="width: 4%">{{$n}}</td>
					<td class="text-left" style="width: 7%">{{$d->transaksi->tgl_muat}}</td>
					<td class="text-left" style="width: 11%">{{$d->seleb->nama_seleb}}</td>
					<td class="text-right" style="width: 7%">{{number_format($d->berat,0,',','.')}}</td>
					<td class="text-right" style="width: 7%">{{number_format($d->harga,0,',','.')}}</td>
					<td class="text-left" style="width: 11%">{{$d->transaksi->truk->nama_supir}}</td>
					<td class="text-left" style="width: 18%">{{$d->transaksi->gudang->nama_gudang}}</td>
					<td class="text-left" style="width: 7%">{{$d->payment->tgl_kas}}</td>
					<td class="text-right" style="width: 10%">{{number_format($d->payment->rp_bayar,0,',','.')}}</td>
					<td class="text-right" style="width: 10%">{{number_format($d->payment->rp_bayar-$d->payment->rp_tagihan,0,',','.')}}</td>
					@if($d->payment->pay_method == "transfer")
					<td class="text-left" style="width: 9%">{{$d->payment->rek_bayar}}</td>
					@else
					<td class="text-left" style="width: 9%">{{$d->payment->pay_method}}</td>
					@endif
				</tr>
				<?php $n++;?>
			@endforeach
		</tbody>
	</table>
	<p>Data Piutang</p>
	<table border="1" cellpadding="5">
		<thead>
			<tr style="font-weight: bold;background-color: gray;">
				<th class="text-center" style="width: 4%">No</th>
				<th class="text-center" style="width: 7%">Tanggal</th>
				<th class="text-center" style="width: 11%">Seleb</th>
				<th class="text-center" style="width: 7%">Berat</th>
				<th class="text-center" style="width: 7%">Harga</th>
				<th class="text-center" style="width: 11%">Supir</th>
				<th class="text-center" style="width: 18%">Kirim Ke</th>
				<th class="text-center" style="width: 7%">Tgl Bayar</th>
				<th class="text-center" style="width: 10%">Rp Bayar</th>
				<th class="text-center" style="width: 10%">Sisa Uang</th>
				<th class="text-center" style="width: 9%">Metode Bayar</th>
			</tr>
		</thead>
		<tbody>
			<?php $n=1; ?>
			@foreach($data as $d)
				<tr nobr="true">
					<td class="text-center" style="width: 4%">{{$n}}</td>
					<td class="text-left" style="width: 7%">{{$d->transaksi->tgl_muat}}</td>
					<td class="text-left" style="width: 11%">{{$d->seleb->nama_seleb}}</td>
					<td class="text-right" style="width: 7%">{{number_format($d->berat,0,',','.')}}</td>
					<td class="text-right" style="width: 7%">{{number_format($d->harga,0,',','.')}}</td>
					<td class="text-left" style="width: 11%">{{$d->transaksi->truk->nama_supir}}</td>
					<td class="text-left" style="width: 18%">{{$d->transaksi->gudang->nama_gudang}}</td>
					<td class="text-left" style="width: 7%">{{$d->payment->tgl_kas}}</td>
					<td class="text-right" style="width: 10%">{{number_format($d->payment->rp_bayar,0,',','.')}}</td>
					<td class="text-right" style="width: 10%">{{number_format($d->payment->rp_bayar-$d->payment->rp_tagihan,0,',','.')}}</td>
					@if($d->payment->pay_method == "transfer")
					<td class="text-left" style="width: 9%">{{$d->payment->rek_bayar}}</td>
					@else
					<td class="text-left" style="width: 9%">{{$d->payment->pay_method}}</td>
					@endif
				</tr>
				<?php $n++;?>
			@endforeach
		</tbody>
	</table>
</body>
</html>