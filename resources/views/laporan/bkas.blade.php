@extends('layout')
@section('title')
	Buku Kas | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Buku Kas </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
			</div>
			
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<!--begin::Portlet-->
		<div class="row">
			<div class="col-12">
				<div class="kt-portlet kt-portlet--mobile {{($data == null) ? '' : 'kt-hide'}}" id="data">
					<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('bkas-cetak')}}" target="_blank">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="la la-calendar kt-font-success"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								<span>
									<b>Sisa Saldo</b> - Rp. {{number_format($saldo,2,',','.')}}
								</span>
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<!-- <a href="{{route('bkas-cetak')}}" target="_blank"><button type="button" class="btn btn-sm btn-info" id="cetakAll">Cetak Laporan</button></a> -->
									<button type="submit" class="btn btn-sm btn-info" id="cetak">Cetak Laporan</button>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<div class="col-md-6">
								<div class="input-group date">
									<input type="text" class="form-control f_tgl" value="{{date('Y-m-d')}}" placeholder="Select date" id="tgl_start" name="tgl_start">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group date">
									<input type="text" class="form-control f_tgl" value="{{date('Y-m-d')}}" placeholder="Select date" id="tgl_end" name="tgl_end">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<button type="button" class="btn btn-sm btn-brand btn-pill btn-success" id="filter">Tampilkan Data</button>
								</div>
							</div>
						</div>
					</div>
					</form>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-prodi">
							<div class="kt-section__content">
								<!-- <div class="form-group kt-form__group row">
									<label class="col-form-label col-md-1">Tanggal</label>
									<div class="col-md-2">
										<input type="text" class="form-control f_tgl" readonly value="{{date('Y-m-d')}}" placeholder="Select date" id="tgl_start">
									</div>
								</div>
								<div class="form-group kt-form__group row">
									<label class="col-form-label col-md-1">&nbsp;</label>
									<div class="col-md-2">
										<button class="btn btn-outline-info" id="filter">Tampilkan Data</button>
									</div>
								</div> -->
								<!-- <table class="table table-bordered table-hover m-table" id="tabel"> -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="tabel">
									<thead>
										<tr>
											<th>Tanggal</th>
											<th>Keterangan</th>
											<th>Kredit</th>
											<th>Debit</th>
											<th>Saldo Akhir</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
			</div>
		</div>
		<!--end::Portlet-->
	</div>
	<!-- end:: Content -->
</div>

@endsection

@section('css')
<style type="text/css">
	.modal-lg {
	    max-width: 75%;
	}
</style>
@endsection

@section('js')
<!--begin::Page Vendors -->
<script type="text/javascript">

	$(document).ready(function () {
		$(".f_tgl").datepicker({
			todayHighlight:1,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
		});
		
		$('#tabel').DataTable({
			"responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('bkas-data',['filter' => date('Y-m-d').';'.date('Y-m-d')]) }}",
	        "columns": [
	            {data: 'tanggal'},
	            {data: 'keterangan'},
	            {data: 'kredit', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. '), className: 'text-right'},
	            {data: 'debit', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. '), className: 'text-right'},
	            {data: 'saldo_akhir', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. '), className: 'text-right'},
	        ],
	    });
	    
	    $("#filter").click(function(){
	    	// alert($('#tgl_start').val());
	    	var url = "{{ url('laporan-kas-data') }}/" + $('#tgl_start').val() + ";" + $('#tgl_end').val();
	    	// var url = "{{ url('laporan-seleb-data') }}/" + $('#fseleb').val() + ";" + $('#tgl_start').val() + ";" + $('#tgl_end').val();
			$('#tabel').DataTable().ajax.url(url).load();
	    });
	   
	});

</script>
@endsection