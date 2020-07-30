@extends('layout')
@section('title')
	Bagian Umum | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Bagian Umum </h3>
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
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="la la-calendar kt-font-success"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								<span>
									<b>Pengeluaran Rumah Tangga</b>
								</span>
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<button class="btn btn-brand btn-elevate btn-icon-sm btn-sm" id="tambah">
										<i class="la la-plus"></i>
										Tambah
									</button>
									<!-- <button type="submit" class="btn btn-sm btn-info" id="cetak">Cetak Laporan</button> -->
								</div>
							</div>
						</div>
					</div>
				<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('keluar-cetak')}}" target="_blank">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
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
											<th>Keperluan</th>
											<th>Keterangan</th>
											<th>Jumlah</th>
											<th>Menu</th>
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
				<div class="kt-portlet kt-portlet--mobile {{($data == null) ? 'kt-hide' : ''}}" id="form">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								<span>
									Form {{($data == null) ? 'Tambah' : 'Edit'}} Pengeluaran Rumah Tangga
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-keluar">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('keluar-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="tipe" value="{{($data == null) ? 1 : 2}}">
									<input type="hidden" name="id" value="{{$data->id or ''}}">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tanggal</label>
										<div class="col-md-3">
											<div class="input-group date">
												<input type="text" class="form-control is-invalid" readonly value="{{$data->tanggal or ''}}" id="kt_datepicker" name="tanggal" required />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
											<div class="invalid-feedback">Shucks, check the formatting of that and try again.</div>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Keperluan</label>
										<div class="col-md-6">
											<select class="form-control kt-select2" id="keperluan" name="keperluan" style="width: 100%">
												<option selected="selected">Pilih Keperluan</option>
			                                    <option value="PDAM">PDAM</option>
			                                    <option value="PLN">PLN</option>
			                                    <option value="Lain-lain">Lain-lain</option>
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Keterangan</label>
										<div class="col-md-6">
											<input type="text" style="text-transform: uppercase;" class="form-control kt-input kt-input--air" name="keterangan" value="{{$data->keterangan or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Jumlah (Rp)</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="jumlah" id="jumlah">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">&nbsp;</label>
										<div class="col-md-6">
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="{{route('keluar-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
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
		$("#tambah").click(function(){
			$("#data").addClass('kt-hide');
			$("#form").removeClass('kt-hide');
		});

		$(".currency").keyup(function() {
			var rp = formatRupiah(this.value);
			$(this).val(rp);
		});

		$(".f_tgl").datepicker({
			todayHighlight:1,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
		});

		$("#kt_datepicker").datepicker({
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
	        "ajax": "{{ route('keluar-data',['filter' => date('Y-m-d').';'.date('Y-m-d')]) }}",
	        "columns": [
	            {data: 'tanggal'},
	            {data: 'keperluan'},
	            {data: 'keterangan'},
	            {data: 'jumlah', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. '), className: 'text-right'},
	            {data: 'menu', orderable: false, searchable: false},
	        ],
	    });
	    
	    $("#filter").click(function(){
	    	// alert($('#tgl_start').val());
	    	var url = "{{ url('keluar-data') }}/" + $('#tgl_start').val() + ";" + $('#tgl_end').val();
	    	// var url = "{{ url('laporan-keluar-data') }}/" + $('#fkeluar').val() + ";" + $('#tgl_start').val() + ";" + $('#tgl_end').val();
			$('#tabel').DataTable().ajax.url(url).load();
	    });
	   
	});

	

</script>
@endsection