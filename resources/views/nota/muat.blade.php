@extends('layout')
@section('title')
	Nota Muat | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Nota Muat </h3>
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
								<i class="la la-cog"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								<span>
									<b>Nota</b> - Muat
								</span>
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									&nbsp;
									<button class="btn btn-brand btn-elevate btn-icon-sm btn-sm" id="tambah">
										<i class="la la-plus"></i>
										Tambah
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__body">
						<!-- <div class="form-group m-form__group row">
							<label class="col-form-label col-md-1">Status Bon</label>
							<div class="col-md-4">
								<select class="form-control kt-select2" id="fstatus">
									<option value="0">Semua</option>
									<option value="1">Belum Bongkar</option>
									<option value="2">Sudah Bongkar</option>
									<option value="3">Dibatalkan</option>
								</select>
							</div>
							<label class="col-form-label col-md-1">&nbsp;</label>
							<div class="col-md-2">
								<button class="btn btn-outline-info" id="filter">Tampilkan Data</button>
							</div>
						</div> -->
						<table class="table table-striped- table-bordered table-hover table-checkable" id="tabel">
							<thead>
								<tr>
									<th>No Nota</th>
									<th>Tgl Muat</th>
									<th>Supir</th>
									<th>Total Berat</th>
									<th>Jumlah</th>
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
									Form {{($data == null) ? 'Tambah' : 'Edit'}} Bon Muat
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-muat">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('muat-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="tipe" value="{{($data == null) ? 1 : 2}}">
									<input type="hidden" name="id_transaksi" value="{{$data->id_transaksi or ''}}">
									@if(isset($data))
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">No Nota</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" name="no_nota" id="no_nota" value="{{$data->id_transaksi or ''}}" readonly>
										</div>
									</div>
									@endif
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tanggal Muat</label>
										<div class="col-md-3">
											<div class="input-group date">
												<input type="text" class="form-control" readonly value="{{$data->tgl_muat or ''}}" id="kt_datepicker_tgl_muat" name="tgl_muat" />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Supir truk</label>
										<div class="col-md-6">
											<select class="form-control kt-select2" id="kt_select2_truk" name="id_truk" style="width: 100%">
												<option value="0">Pilih Supir</option>
												@foreach($truk as $row)
				                                @if(isset($data))
				                                  @if($data['id_truk'] == $row->id_truk)
				                                    <option selected="selected" value="{{$row->id_truk}}">{{$row->nama_supir}} - {{$row->nopol}}</option>
				                                  @else
				                                    <option value="{{$row->id_truk}}">{{$row->nama_supir}} - {{$row->nopol}}</option>
				                                  @endif
				                                @else
				                                  <option value="{{$row->id_truk}}">{{$row->nama_supir}} - {{$row->nopol}}</option>
				                                @endif
				                              	@endforeach
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Seleb</label>
										<div class="col-md-6">
											<select class="form-control kt-select2" name="id_seleb" id="seleb" style="width: 100%">
												<option selected="selected">Pilih Seleb</option>
												@foreach($seleb as $row)
				                                  <option value="{{$row->id_seleb}}#{{$row->nama_seleb}}">{{$row->kabupaten}} - {{$row->nama_seleb}}</option>
				                              	@endforeach
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Berat (Kg)</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="berat" id="berat">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Harga / kg</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="harga" id="harga">
										</div>
										<div class="col-md-2">
                                            <a>
                                            <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" id="addList">
												<i class="la la-plus"></i>
												Add
											</button>
											</a>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Detail</label>
										<div class="col-md-6">
											<table class="table table-sm table-head-bg-brand" id="detail">
												<thead class="thead-light">
													<tr>
														<th>Seleb</th>
														<th>Berat</th>
														<th>Harga</th>
														<th>Menu</th>
													</tr>
												</thead>
												<tbody>
													@if($detail!=null)
													<?php $n=1;?>
													@foreach($detail as $row)
														<tr>
															<td>{{$row->seleb->nama_seleb}}<input type="hidden" name="dmuat[]" value="{{$row->id_seleb}}#{{$row->berat}}#{{$row->harga}}"></td>
															<td>{{$row->berat}}</td>
															<td>{{$row->harga}}</td>
															<td><button class="btn btn-sm btn-danger" onclick="$(this).parent().parent().remove();">Hapus</button></td>
														</tr>
														<?php $n++;?>
													@endforeach
													@endif
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
											<a href="{{route('muat-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<form class="modal fade" id="kt_modal_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Detail Muat</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-12">
									<table class="table table-sm table-head-bg-brand" >
										<thead class="thead-light">
											<tr>
												<th>Seleb</th>
												<th>Berat</th>
												<th>Harga</th>
												<th>Jumlah</th>
											</tr>
										</thead>
										<tbody id="mdetail">
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</form>
			<!-- <form class="modal fade" id="modal_batal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" method="post" action="">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Pembatalan Bon Muat</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-12">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="text" name="modal_id" value="{{$data->id_transaksi or ''}}">
									<label class="col-form-label col-md-4">Alasan Batal</label>
									<div class="col-md-12">
										<input type="text" class="form-control kt-input kt-input--air" name="alasan_batal" id="alasan_batal">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="saveBatal">Save</button>
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
<!-- <link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
	.modal-lg {
	    max-width: 75%;
	}
</style>
@endsection
@section('js')
<!--begin::Page Vendors -->
<!-- <script src="{{asset('assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script> -->

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
	        "ajax": "{{ route('muat-data', [0]) }}",
	        "columns": [
	            {data: 'no_nota'},
	            {data: 'tgl_muat'},
	            {data: 'truk.nama_supir'},
	            {data: 'berat_muat', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'rp_muat', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'menu', orderable: false, searchable: false}
	        ]
	    });

	    $("#kt_datepicker_tgl_muat").datepicker({
			todayHighlight:1,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
		});


	    $('.kt-select2').select2();

	    $("#addList").click(function(){
	    	var temp = $("#seleb").val().split("#");
	    	var id_seleb = temp[0];
	    	var nama = temp[1];
	    	// var jml_karung = $("#karung").val();
	    	var berat = $("#berat").val();
	    	var harga = $("#harga").val();
			$("#detail").append('<tr><td><input type="hidden" name="dmuat[]" value="'+ id_seleb +'#'+ berat +'#'+ harga +'">'+ nama +'</td>><td>'+ berat +'</td><td>'+ harga +'</td><td><button class="btn btn-sm btn-danger" onclick="$(this).parent().parent().remove();">Hapus</button></td></tr>')
			// $("#karung").val('');
			$("#berat").val('');
			$("#harga").val('');
		});

		$("#filter").click(function(){
	    	var url = "{{ url('muat-data') }}/" + $('#fstatus').val();
			$('#tabel').DataTable().ajax.url(url).load();
	    });

		$(".currency").keyup(function() {
			var rp = formatRupiah(this.value);
			$(this).val(rp);
		});

	});

	function batal(kode){
		$.ajax({
	        type: "POST",
	        url: "{{route('muat-batal')}}",
	        data: {id_transaksi: kode, _token: "{{ csrf_token() }}"},
	        success: function (result)
	        {
	            $('#tabel').DataTable().ajax.reload();
	        }
	    });
	}

	function detail(kode){
		// alert(kode);
		var token = '{{csrf_token()}}';
        $.ajax({
            url: "{{route('muat-detail')}}",
            type: 'GET',
            headers: {'X-CSRF-TOKEN': token},
            data: {id_transaksi: kode},
            cache: false,
            
            success: function (result) {
            	$("#mdetail").empty();
                $.each( result.data, function( key, value ) {
                	// alert(value.harga);
				 	$("#mdetail").append(
				 		'<tr><td>'+value.seleb.nama_seleb+'</td><td>'+value.berat+'</td><td>'+value.harga+'</td><td>'+value.rp_tagihan+'</td></tr>');
				});
				$("#kt_modal_list").modal('show');
            }
        });
    
	}

	</script>
@endsection