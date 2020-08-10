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
									<button class="btn btn-brand btn-elevate btn-icon-sm btn-sm" id="tambah">
										<i class="la la-plus"></i>
										Tambah
									</button>
									<button class="btn btn-brand btn-elevate btn-icon-sm btn-sm btn-success" id="b_filter" data-toggle="modal">
										Filter / Cetak
									</button>
									<!-- <button type="submit" class="btn btn-sm btn-info" id="cetak">Cetak Laporan</button> -->
								</div>
							</div>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-prodi">
							<div class="kt-section__content">
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
									<!-- <div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tanggal Bon</label>
										<div class="col-md-3">
											<div class="input-group date">
												<input type="text" class="form-control {{$data!=null? '' : 'kt_datepicker'}}" value="{{$data->tgl_bon or ''}}" id="tgl_bon" name="tgl_bon" required/>
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tanggal Terima Bon</label>
										<div class="col-md-3">
											<div class="input-group date">
												<input type="text" class="form-control {{$data!=null? '' : 'kt_datepicker'}}" value="{{$data->tgl_terimabon or ''}}" id="tgl_terimabon" name="tgl_terimabon" required/>
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div> -->
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
									<!-- <div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Status</label>
										<div class="col-md-3">
											<select class="form-control kt-select2" id="status" name="status" style="width: 100%" required>
												<option value="">Pilih Status</option>
			                                    @foreach($status as $r)
			                                    @if($data != null && $data->id_status == $r->id)
			                                    	<option value="{{$r->id}}" selected="">{{$r->keterangan}}</option>
			                                    @else
			                                    	<option value="{{$r->id}}">{{$r->keterangan}}</option>
			                                    @endif
			                                    @endforeach
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Nama Pemesan</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="nama_pemesan" id="nama_pemesan" value="{{$data->nama_pemesan or ''}}" required {{$data == null ? "" : "readonly" }} style="text-transform: uppercase;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Telepon Pemesan</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="telp_pemesan" id="telp_pemesan" value="{{$data->telp_pemesan or ''}}" required {{$data == null ? "" : "readonly" }} style="text-transform: uppercase;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Keterangan</label>
										<div class="col-md-6">
											<textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{$data->keterangan or ''}}</textarea>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Harga KPR (Rp)</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="harga_kpr" id="harga_kpr" value="{{$data->harga_kpr or ''}}" required {{$data == null ? "" : "readonly" }}>
										</div>
									</div> -->
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
			<form class="modal fade" id="modal_filter" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" method="post" action="{{route('pembangunankavling-cetak')}}" target="_blank">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="">Filter</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-12">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Cluster</label>
										<div class="col-md-8">
											<select class="form-control kt-select2" id="f_cluster" name="f_cluster" style="width: 100%">
												<option value="0">Pilih Clusters (Semua)</option>
			                                    @foreach($cluster as $r)
			                                    	<option value="{{$r->cluster}}">{{$r->cluster}}</option>
			                                    @endforeach
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">status</label>
										<div class="col-md-8">
											<select class="form-control kt-select2" id="f_status" name="f_status" style="width: 100%">
												<option value="0">Pilih Status (Semua)</option>
			                                    @foreach($status as $r)
			                                    	<option value="{{$r->id}}">{{$r->keterangan}}</option>
			                                    @endforeach
											</select>
										</div>
									</div>
									<!-- <div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Tanggal Terima Bon</label>
										<div class="col-md-8">
											<div class="input-group date">
												<input type="text" class="form-control kt_datepicker" value="{{date('Y-m-d')}}" id="tgl_start" name="tgl_start" required/>
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
											<div class="input-group date">
												<input type="text" class="form-control kt_datepicker" value="{{date('Y-m-d')}}" id="tgl_end" name="tgl_end" required/>
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div> -->
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-brand btn-info" id="filter">Tampilkan Data</button>
							<button type="submit" class="btn btn-sm btn-success">Cetak</button>
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</form>

			<!-- <form class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" method="post" action="{{route('pembangunankavling-simpan')}}" target="_blank">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="">Update Data</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-12">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Tanggal Bon</label>
										<div class="col-md-8">
											<div class="input-group date">
												<input type="text" class="form-control kt_datepicker" value="{{$data->tgl_bon or ''}}" id="mtgl_bon" name="mtgl_bon" readonly />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Tanggal Terima Bon</label>
										<div class="col-md-8">
											<div class="input-group date">
												<input type="text" class="form-control kt_datepicker" value="{{$data->tgl_terimabon or ''}}" id="mtgl_terimabon" name="mtgl_terimabon" readonly/>
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">status</label>
										<div class="col-md-6">
											<select class="form-control kt-select2" id="mstatus" name="mstatus" style="width: 100%" required>
												<option value="">Pilih status</option>
			                                    @foreach($status as $r)
			                                    	<option value="{{$r->id}}">{{$r->keterangan}}</option>
			                                    @endforeach
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Keterangan</label>
										<div class="col-md-6">
											<textarea class="form-control" id="mketerangan" name="mketerangan" rows="8" readonly>{{$data->keterangan or ''}}</textarea>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Jumlah (Rp)</label>
										<div class="col-md-8">
											<input type="text" class="form-control kt-input kt-input--air currency" name="mjumlah" id="mjumlah" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-sm btn-success">Simpan</button>
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</form> -->
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
	        "ajax": "{{ route('pembangunankavling-data',['filter' => '0;0']) }}",
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
	    	var url = "{{ url('pembangunankavling-data') }}/" + $('#f_cluster').val() + ";" + $('#f_status').val();
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

			$("#list").append('<tr><td><input type="hidden" name="dlist[]" value="'+ cluster +'#'+ blok +'#'+ nomor +'#'+ tipe +'#'+ luas_bangun +'#'+ luas_tanah +'">'+ cluster +'</td>><td>'+ blok +'</td><td>'+ nomor +'</td><td>'+ tipe +'</td><td>'+ luas_bangun +'</td><td>'+ luas_tanah +'</td><td><button class="btn btn-sm btn-outline-dark btn-icon btn-elevate flaticon-delete" onclick="$(this).parent().parent().remove();"></button></td></tr>')
			
			$("#nomor").val('');
		});


		$(".currency").keyup(function() {
			var rp = formatRupiah(this.value);
			$(this).val(rp);
		});
	   
	});	

</script>
@endsection