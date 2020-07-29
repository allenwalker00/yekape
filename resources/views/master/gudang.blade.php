@extends('layout')
@section('title')
	Data Gudang | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Master Gudang </h3>
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
					<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('gudang-cetak')}}" target="_blank">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="la la-cog"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								<span>
									<b>Gudang</b> - Data Gudang
								</span>
							</h3>
						</div>
						
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<button class="btn btn-brand btn-elevate btn-sm btn-success" id="cetak">
										Cetak
									</button>
									<button class="btn btn-brand btn-elevate btn-icon-sm btn-sm" id="tambah">
										<i class="la la-plus"></i>
										Tambah
									</button>
								</div>
							</div>
						</div>
					</div>
					</form>
					<div class="kt-portlet__body">
						<table class="table table-striped- table-bordered table-hover table-checkable" id="tabel">
							<thead>
								<tr>
									<th>Nama Gudang</th>
									<th>Pemilik</th>
									<th>Direksi</th>
									<th>Alamat</th>
									<th>Telp</th>
									<th>HP</th>
									<th>Actions</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="kt-portlet kt-portlet--mobile {{($data == null) ? 'kt-hide' : ''}}" id="form">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								<span>
									Form {{($data == null) ? 'Tambah' : 'Edit'}} Gudang
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-gudang">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('gudang-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="tipe" value="{{($data == null) ? 1 : 2}}">
									<input type="hidden" name="id_gudang" value="{{$data->id_gudang or ''}}">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Nama gudang</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="nama_gudang" value="{{$data->nama_gudang or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Pemilik</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="pemilik" value="{{$data->pemilik or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Direksi</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="direksi" value="{{$data->direksi or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Alamat Gudang</label>
										<div class="col-md-6">
											<textarea class="form-control" id="exampleTextarea" rows="3" name="alamat_gudang">{{$data->alamat_gudang or ''}}</textarea>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Telp.</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="telp" value="{{$data->telp or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">HP.</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="hp" value="{{$data->hp or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">&nbsp;</label>
										<div class="col-md-6">
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="{{route('gudang-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
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
<link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
	.modal-lg {
	    max-width: 75%;
	}
</style>
@endsection
@section('js')
<!--begin::Page Vendors -->
<script src="{{asset('assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$("#tambah").click(function(){
			$("#data").addClass('kt-hide');
			$("#form").removeClass('kt-hide');
		});
		$('#tabel').DataTable({
			"responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('gudang-data') }}",
	        "columns": [
	            {data: 'nama_gudang'},
	            {data: 'pemilik'},
	            {data: 'direksi'},
	            {data: 'alamat_gudang'},
	            {data: 'telp'},
	            {data: 'hp'},
	            {data: 'menu', orderable: false, searchable: false}
	        ]
	    });
	    $('.kt-select2').select2();

	});
	function hapus(kode){
		// alert(kode);
		$.ajax({
	        type: "POST",
	        url: "{{route('gudang-hapus')}}",
	        data: {id_gudang: kode, _token: "{{ csrf_token() }}"},
	        success: function (result)
	        {
	            $('#tabel').DataTable().ajax.reload();
	        }
	    });
	}
	</script>
@endsection