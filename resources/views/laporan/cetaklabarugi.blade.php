<!DOCTYPE html>
<html lang="en">
<head>
	<title>Laporan Laba Rugi</title>
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
	<h2>Laporan Laba Rugi</h2>
	<p>Periode : {{$tgl_start}} s/d {{$tgl_end}}</p>
	<p></p>
	<table border="1" cellpadding="5">
		<thead>
			<tr style="font-weight: bold;background-color: gray;">
				<th class="text-center" style="width: 4%">No</th>
				<th class="text-center" style="width: 8%">Tanggal</th>
				<th class="text-center" style="width: 16%">Gudang</th>
				<th class="text-center" style="width: 4%">Nota</th>
				<th class="text-center" style="width: 7%">Berat(B)</th>
				<th class="text-center" style="width: 10%">Jumlah(B)</th>
				<th class="text-center" style="width: 8%">Supir</th>
				<th class="text-center" style="width: 8%">Seleb</th>
				<th class="text-center" style="width: 7%">Berat(M)</th>
				<th class="text-center" style="width: 10%">Jumlah(M)</th>
				<th class="text-center" style="width: 8%">Truk</th>
				<th class="text-center" style="width: 10%">Laba/Rugi</th>
			</tr>
		</thead>
		<tbody>
			<?php $n=1; ?>
			@foreach($data as $key => $d)
			<?php 

				$laba = 0;
				$seleb = "";

				$laba = $d->rp_bongkar - $d->rp_muat - $d->rp_ongkir; 
				foreach ($d->detail as $r) {
					if($r->kd_transaksi == 'M')
						$seleb .= $r->seleb->nama_seleb . " ";
				}
			?>
				<tr nobr="true">
					<td class="text-center" style="width: 4%">{{$n}}</td>
					<td class="text-center" style="width: 8%">{{$d->tgl_bongkar}}</td>
					<td class="text-left" style="width: 16%">{{$d->gudang->nama_gudang}}</td>
					<td class="text-center" style="width: 4%">{{$d->no_nota}}</td>
					<td class="text-right" style="width: 7%">{{number_format($d->berat_bongkar,0,',','.')}}</td>
					<td class="text-right" style="width: 10%">{{number_format($d->rp_bongkar,0,',','.')}}</td>
					<td class="text-left" style="width: 8%">{{$d->truk->nama_supir}}</td>
					<td class="text-left" style="width: 8%">{{$seleb}}</td>
					<td class="text-right" style="width: 7%">{{number_format($d->berat_muat,0,',','.')}}</td>
					<td class="text-right" style="width: 10%">{{number_format($d->rp_muat,0,',','.')}}</td>
					<td class="text-left" style="width: 8%">{{number_format($d->rp_ongkir,0,',','.')}}</td>
					<td class="text-right" style="width: 10%">{{number_format($laba,0,',','.')}}</td>
				</tr>
				<?php $n++;?>
			@endforeach
		</tbody>
	</table>
</body>
</html>