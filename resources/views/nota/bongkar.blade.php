@extends('layout')
@section('title')
	Nota Bongkar | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Nota Bongkar </h3>
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
									<b>Nota</b> - Bongkar
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<label class="col-form-label col-md-6">Status Bon</label>
							<div class="col-md-12">
								<select class="form-control kt-select2" id="fstatus" name="fstatus">
									<option value="0">Semua</option>
									<option value="1">Belum Bongkar</option>
									<option value="2">Sudah Bongkar</option>
								</select>
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
					<div class="kt-portlet__body">
						<!-- <div class="form-group m-form__group row">
							<label class="col-form-label col-md-1">Status Bon</label>
							<div class="col-md-4">
								<select class="form-control kt-select2" id="fstatus">
									<option value="0">Semua</option>
									<option value="1">Belum Bongkar</option>
									<option value="2">Sudah Bongkar</option>
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
									<th>Tgl Bongkar</th>
									<th>Seleb</th>
									<th>Supir</th>
									<th>Gudang</th>
									<th>Berat Muat</th>
									<th>Rp Muat</th>
									<th>Berat Bongkar</th>
									<th>Harga Bongkar</th>
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
									Form {{($data == null) ? 'Tambah' : 'Edit'}} Bon Bongkar
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-muat">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('bongkar-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="tipe" value="{{($data == null) ? 1 : 2}}">
									<input type="hidden" name="id_transaksi" value="{{$data->id_transaksi or ''}}">
									<input type="hidden" name="recid_bongkar" value="{{$d_bongkar->recid or ''}}">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">No Nota</label>
										<div class="col-md-6">
											<input type="text" class="form-control" readonly value="{{$data->no_nota or ''}}" id="no_nota" name="no_nota" />
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tanggal Muat</label>
										<div class="col-md-3">
											<div class="input-group date">
												<input type="text" class="form-control" readonly value="{{$data->tgl_muat or ''}}" />
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
											@if(isset($data))
											<input type="text" class="form-control" readonly value="{{$data->truk->nama_supir . ' - ' . $data->truk->nopol}}" id="supir" />
											@endif
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">List Muat</label>
										<div class="col-md-6">
											<table class="table table-sm table-head-bg-brand" id="listMuat">
												<thead class="thead-light">
													<tr>
														<th>Seleb</th>
														<th>Berat</th>
														<th>Harga</th>
													</tr>
												</thead>	
												<tbody>
													@if(isset($d_muat))
													@foreach($d_muat as $d)
													<tr>
														<td>{{$d->seleb->nama_seleb}}<input type="hidden" name="list[]" value="{{$d->id_seleb}}#{{$d->berat}}#{{$d->harga}}"></td>
														<td>{{$d->berat}}</td>
														<td>{{$d->harga}}</td>
													</tr>
													@endforeach
													@endif
												</tbody>
											</table>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tanggal Bongkar</label>
										<div class="col-md-3">
											<div class="input-group date">
												<input type="text" class="form-control kt-datepicker" value="{{$data->tgl_bongkar or ''}}" name="tgl_bongkar" />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Gudang</label>
										<div class="col-md-6">
											<select class="form-control kt-select2" name="id_gudang" id="id_gudang" style="width: 100%">
												<option selected="selected">Pilih Gudang</option>
												@foreach($gudang as $row)
												@if(isset($data))
				                                  @if($data['id_gudang'] == $row->id_gudang)
				                                    <option selected="selected" value="{{$row->id_gudang}}">{{$row->nama_gudang}}</option>
				                                  @else
				                                  	<option value="{{$row->id_gudang}}">{{$row->nama_gudang}}</option>
				                                  @endif
				                                @else
				                                	<option value="{{$row->id_gudang}}">{{$row->nama_gudang}}</option>
				                                @endif
				                              	@endforeach
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Berat Bongkar (Kg)</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="berat_bongkar" id="berat_bongkar" value="{{$data->berat_bongkar or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Harga (Rp)</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="harga_bongkar" id="harga_bongkar" value="{{$data->harga_bongkar or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Ongkos Truk (Rp)</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="ongkos_truk" id="ongkos_truk" value="{{$data->ongkos_truk or ''}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">&nbsp;</label>
										<div class="col-md-6">
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="{{route('bongkar-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
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
<!-- <script src="{{asset('assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script> -->
<!-- <script src="{{asset('assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script> -->
<!-- <script src="{{asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script> -->
<!-- <script src="{{asset('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script> -->

<script type="text/javascript">
	$(document).ready(function () {
		$('#tabel').DataTable({
			"responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('bongkar-data', [0]) }}",
	        "columns": [
	            {data: 'no_nota'},
	            {data: 'tgl_muat'},
	            {data: 'tgl_bongkar'},
	            {data: 'kd_transaksi'},
	            {data: 'truk.nama_supir'},
	            {data: 'gudang.nama_gudang', defaultContent: '-'},
	            {data: 'berat_muat', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'rp_muat', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'rek_bayar'},
	            {data: 'rek_tujuan'},
	            {data: 'menu', orderable: false, searchable: false}
	        ]
	    });

	    $(".kt-datepicker").datepicker({
			todayHighlight:1,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation:"bottom left",
		});


	    $('.kt-select2').select2();

		$(".currency").keyup(function() {
			var rp = formatRupiah(this.value);
			$(this).val(rp);
		});

	    $("#filter").click(function(){
	    	var url = "{{ url('bongkar-data') }}/" + $('#fstatus').val();
			$('#tabel').DataTable().ajax.url(url).load();
	    });
	});

	// function batal(kode){
	// 	$.ajax({
	//         type: "POST",
	//         url: "{{route('bongkar-batal')}}",
	//         data: {id_transaksi: kode, _token: "{{ csrf_token() }}"},
	//         success: function (result)
	//         {
	//             $('#tabel').DataTable().ajax.reload();
	//         }
	//     });
	// }

	function listSeleb(kode){
		// alert(kode);
		var token = '{{csrf_token()}}';
        $.ajax({
            url: "{{route('bongkar-listSeleb')}}",
            type: 'GET',
            headers: {'X-CSRF-TOKEN': token},
            data: {id_transaksi: kode},
            cache: false,
            
            success: function (result) {
            	// alert(result.data);
            	$("#listSeleb").empty();
                $.each( result.data, function( key, value ) {
				 	$("#listSeleb").append('<tr><td>'+value.seleb.nama_seleb+'</td><td>'+value.jml_karung+'</td><td>'+value.berat+'</td></tr>');
				});
            }
        });
    
	}
	</script>
@endsection