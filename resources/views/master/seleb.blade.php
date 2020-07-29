@extends('layout')
@section('title')
	Data Seleb | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Master Seleb </h3>
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
									<b>Seleb</b> - Data Seleb
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
								</div>
							</div>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<!--begin: Search Form -->
						<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('seleb-cetak')}}" target="_blank">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="kt-form kt-form--label-right kt-margin-t-10 kt-margin-b-10">
							<div class="row align-items-center">
								<div class="col-xl-8 order-2 order-xl-1">
									<div class="row align-items-center">
										<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-form__group kt-form__group--inline">
												<div class="kt-form__label">
													<label>Kab:</label>
												</div>
												<div class="kt-form__control">
													<select class="form-control kt-select2" id="fkab" name="fkab">
														<option value="0" selected>Semua Kabupaten</option>
														@foreach($kab as $row)
						                                  <option value="{{$row->kabupaten}}">{{$row->kabupaten}}</option>
						                              	@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-form__group kt-form__group--inline">
												<div class="kt-form__label">
													<label>Kec:</label>
												</div>
												<div class="kt-form__control">
													<select class="form-control kt-select2" id="fkec" name="fkec">
														<option value="0">Semua</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-form__group kt-form__group--inline">
												<div class="kt-form__control">
													<button type="button" class="btn btn-sm btn-pill btn-outline-success" id="filter">Tampilkan</button>
													<button type="submit" class="btn btn-sm btn-pill btn-outline-info" id="cetak">Cetak</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-4 order-1 order-xl-2 kt-align-right">
									<a href="#" class="btn btn-default kt-hidden">
										<i class="la la-cart-plus"></i> New Order
									</a>
									<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
								</div>
							</div>
						</div>
						</form>
						<!--end: Search Form -->
						<div class="kt-portlet__body kt-portlet__body--fit">
							<table class="table table-striped- table-bordered table-hover table-checkable" id="tabel">
								<thead>
									<tr>
										<th>Nama Seleb</th>
										<th>Kecamatan</th>
										<th>Kabupaten</th>
										<th>Telp/HP</th>
										<th>Rekening</th>
										<th>Actions</th>
									</tr>
								</thead>
							</table>
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
									Form {{($data == null) ? 'Tambah' : 'Edit'}} Seleb
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-seleb">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('seleb-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="tipe" value="{{($data == null) ? 1 : 2}}">
									<input type="hidden" name="id_seleb" value="{{$data->id_seleb or ''}}">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Nama Seleb</label>
										<div class="col-md-6">
											<input type="text" style="text-transform: uppercase;" class="form-control kt-input kt-input--air" name="nama_seleb" value="{{$data->nama_seleb or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Kecamatan</label>
										<div class="col-md-6">
											<input type="text" style="text-transform: uppercase;" class="form-control kt-input kt-input--air" name="kecamatan" value="{{$data->kecamatan or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Kabupaten</label>
										<div class="col-md-6">
											<input type="text" style="text-transform: uppercase;" class="form-control kt-input kt-input--air" name="kabupaten" value="{{$data->kabupaten or ''}}">
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
										<label class="col-form-label col-md-2">Nama Bank</label>
										<div class="col-md-6">
											<input type="text" style="text-transform: uppercase;" class="form-control kt-input kt-input--air" name="rek_bank" value="{{$data->rek_bank or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Nama Rekening</label>
										<div class="col-md-6">
											<input type="text" style="text-transform: uppercase;" class="form-control kt-input kt-input--air" name="rek_nama" value="{{$data->rek_nama or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Nomor Rekening</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="rek_nomor" value="{{$data->rek_nomor or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">&nbsp;</label>
										<div class="col-md-6">
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="{{route('seleb-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
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
	        "ajax": "{{ route('seleb-data',['filter' => '0;0']) }}",
	        "columns": [
	            {data: 'nama_seleb'},
	            {data: 'kecamatan'},
	            {data: 'kabupaten'},
	            {data: 'telp'},
	            {data: 'rek_bank'},
	            {data: 'menu', orderable: false, searchable: false}
	        ]
	    });
	    $('.kt-select2').select2();


        $("#filter").click(function(){
	    	var url = "{{ url('seleb-data') }}/" + $('#fkab').val() + ';' + $('#fkec').val();
			$('#tabel').DataTable().ajax.url(url).load();
	    });

	    $("#fkab").change(function(){
	        var token = '{{csrf_token()}}';
	        var kab = $('#fkab option:selected').val();
	        $("#fkec").empty();
	        $.ajax({
	            url: "{{route('kec-bykab')}}",
	            type: 'POST',
	            headers: {'X-CSRF-TOKEN': token},
	            data: {kab: kab},
	            cache: false,
	            
	            success: function (result) {
	                $("#fkec").empty();
	                $("#fkec").append('<option value="0">Semua</option>');
					for(i = 0; i < result.data.length; i++){
	                    $("#fkec").append('<option value="'+result.data[i]['kecamatan']+'">'+ result.data[i]['kecamatan'] + '</option>');
	                }
	            }
	        });
	    });

	});
	function hapus(kode){
		// alert(kode);
		$.ajax({
	        type: "POST",
	        url: "{{route('seleb-hapus')}}",
	        data: {id_seleb: kode, _token: "{{ csrf_token() }}"},
	        success: function (result)
	        {
	            $('#tabel').DataTable().ajax.reload();
	        }
	    });
	}
	</script>
@endsection
