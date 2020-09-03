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
									<b>Data Kavling</b>
								</span>
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<button class="btn btn-success btn-elevate btn-icon-sm btn-sm" id="tambah">
										<i class="la la-plus"></i>
										Tambah
									</button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<div class="kt-section">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="" target="_blank">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<!--begin: Search Form -->
								<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-20">
									<div class="col-xl-12 order-2 order-xl-1">
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Cluster</label>
													<select class="form-control kt-select2" id="f_cluster" name="f_cluster" style="width: 100%">
														<option value="0">Semua</option>
					                                    @foreach($cluster as $r)
					                                    	<option value="{{$r->cluster}}">{{$r->cluster}}</option>
					                                    @endforeach
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Blok</label>
													<select class="form-control kt-select2" id="f_blok" name="f_blok" style="width: 100%">
														<option value="0">Semua</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Status</label>
													<select class="form-control kt-select2" id="f_status" name="f_status" style="width: 100%">
														<option value="0">Semua</option>
					                                    @foreach($status as $r)
					                                    	<option value="{{$r->id}}">{{$r->keterangan}}</option>
					                                    @endforeach
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>&nbsp;</label>
													<div class="form-group-append">
														<button type="button" class="btn btn-success btn-sm" id="filter">FILTER</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								</form>
								<table class="table table-striped- table-bordered table-hover table-checkable" id="tabel">
									<thead>
										<tr>
											<th>ID</th>
											<th>Cluster</th>
											<th>Blok</th>
											<th>Nomor</th>
											<th>Tipe</th>
											<th>Luas Bangun</th>
											<th>Luas Tanah</th>
											<th>Status</th>
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
									Form {{($data == null) ? 'Tambah' : 'Edit'}} Data Kavling
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="pembangunankavling-data">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('pembangunankavling-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="flag" value="{{($data == null) ? 1 : 2}}">
									<input type="hidden" name="id" value="{{$data->id or ''}}">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Cluster</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="cluster" id="cluster" value="{{$data->cluster or ''}}" required {{$data == null ? "" : "readonly" }} style="text-transform: uppercase;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Blok</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" name="blok" id="blok" value="{{$data->blok or ''}}" required {{$data == null ? "" : "readonly" }} style="text-transform: uppercase;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Nomor</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" name="nomor" id="nomor" value="{{$data->nomor or ''}}" {{$data == null ? "" : "readonly" }} style="text-transform: uppercase;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tipe</label>
										<div class="col-md-3">
											<select class="form-control kt-select2" id="tipe" name="tipe" style="width: 100%" required>
												<option value="">Pilih Tipe</option>
												<option value="Pojok">Pojok</option>
												<option value="Non Pojok">Non Pojok</option>
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Luas Bangun</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="luas_bangun" id="luas_bangun" value="{{$data->luas_bangun or ''}}" required {{$data == null ? "" : "readonly" }}>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Luas Tanah</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="luas_tanah" id="luas_tanah" value="{{$data->luas_tanah or ''}}" required {{$data == null ? "" : "readonly" }}>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">List</label>
										<div class="col-md-6">
											<table class="table table-sm table-head-bg-brand" id="list">
												<thead class="thead-light">
													<tr>
														<th>Cluster</th>
														<th>Blok</th>
														<th>Nomor</th>
														<th>Tipe</th>
														<th>Luas Bangun</th>
														<th>Luas Tanah</th>
														<th>Menu</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">&nbsp;</label>
										<div class="col-md-6">
											<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" id="addList">
												<i class="la la-plus"></i>
												Add
											</button>
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="{{route('pembangunankavling-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
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
	var s;
	$(document).ready(function () {
		$("#tambah").click(function(){
			$("#data").addClass('kt-hide');
			$("#form").removeClass('kt-hide');
		});

		$("#b_filter").click(function(){
			// alert('A');
			$("#modal_filter").modal('show');
		});

		$(".kt_datepicker").datepicker({
			todayHighlight:1,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
		});

		$('.kt-select2').select2();

		var x = $('#tabel').DataTable({
			"responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('pembangunankavling-data',['filter' => '0;0;0']) }}",
	        "columns": [
	            {data: 'id', visible: false},
	            {data: 'cluster', defaultContent: '-'},
	            {data: 'blok', defaultContent: '-'},
	            {data: 'nomor', defaultContent: '-'},
	            {data: 'tipe', defaultContent: '-'},
	            {data: 'luas_bangun', defaultContent: '-'},
	            {data: 'luas_tanah', defaultContent: '-'},
	            {data: 'kavlingstatus.keterangan', defaultContent: '-'},
	            {data: 'menu', orderable: false, searchable: false},
	        ],
	        
	    });

	    
	    $("#filter").click(function(){
	    	// alert($('#tgl_start').val());
	    	var url = "{{ url('pembangunankavling-data') }}/" + $('#f_cluster').val() + ";" + $('#f_blok').val()+ ";" + $('#f_status').val();
	    	// alert(url);
			$('#tabel').DataTable().ajax.url(url).load();
			$("#modal_filter").modal('hide');


	    });

	    $("#addList").click(function(){
	    	var cluster = $("#cluster").val();
	    	var blok = $("#blok").val();
	    	var nomor = $("#nomor").val();
	    	var tipe = $("#tipe").val();
	    	var luas_bangun = $("#luas_bangun").val();
	    	var luas_tanah = $("#luas_tanah").val();

			$("#list").append('<tr><td><input type="hidden" name="dlist[]" value="'+ cluster +'#'+ blok +'#'+ nomor +'#'+ tipe +'#'+ luas_bangun +'#'+ luas_tanah +'">'+ cluster +'</td><td>'+ blok +'</td><td>'+ nomor +'</td><td>'+ tipe +'</td><td>'+ luas_bangun +'</td><td>'+ luas_tanah +'</td><td><button class="btn btn-sm btn-outline-dark btn-icon btn-elevate flaticon-delete" onclick="$(this).parent().parent().remove();"></button></td></tr>')
			
			$("#nomor").val('');
		});


		$(".currency").keyup(function() {
			var rp = formatRupiah(this.value);
			$(this).val(rp);
		});

		$("#f_cluster").change(function(){
	        var token = '{{csrf_token()}}';
	        var cluster = $('#f_cluster option:selected').val();

	        if (cluster == ''){
	        	$('#f_blok').empty();
	        	$("#f_blok").append('<option value="">Semua</option>');
	        }else{
	        	$.ajax({
		            url: "{{route('pembangunankavling-bycluster')}}",
		            type: 'POST',
		            headers: {'X-CSRF-TOKEN': token},
		            data: {cluster: cluster},
		            cache: false,
		            
		            success: function (result) {
		                $('#f_blok').empty();
			        	$("#f_blok").append('<option value="">Semua</option>');
						for(i = 0; i < result.data.length; i++){
		                    $("#f_blok").append('<option value="'+result.data[i]['blok']+'">'+ result.data[i]['blok'] +'</option>');
		                }
		            }
		        });
	        }

	    });
	   
	});	

</script>
@endsection