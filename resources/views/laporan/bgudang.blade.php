@extends('layout')
@section('title')
	Buku Gudang | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Buku Gudang </h3>
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
									<b>Buku Gudang</b> - Laporan
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-prodi">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('bgudang-cetak')}}" target="_blank">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="kt-form kt-form--label-right kt-margin-t-10 kt-margin-b-10">
									<div class="row align-items-center">
										<div class="col-xl-8 order-2 order-xl-1">
											<div class="row align-items-center">
												<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
													<div class="kt-form__group kt-form__group--inline">
														<div class="kt-form__label">
															<label>Gudang:</label>
														</div>
														<div class="kt-form__control">
															<select class="form-control kt-select2" id="fgudang" name="fgudang">
																<option value="0" selected>Semua</option>
																@foreach($gudang as $row)
								                                  <option value="{{$row->id_gudang}}">{{$row->nama_gudang}} - {{$row->pemilik}}</option>
								                              	@endforeach
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
													<div class="kt-form__group kt-form__group--inline">
														<div class="kt-form__label">
															<label>Periode:</label>
														</div>
														<div class="kt-form__control">
															<div class="input-group date">
																<input type="text" class="form-control kt_datepicker" readonly value="{{date('Y-m-d')}}" id="tgl_start" name="tgl_start" />
																<div class="input-group-append">
																	<span class="input-group-text">
																		<i class="la la-calendar"></i>
																	</span>
																</div>
															</div>
															<div class="input-group date">
																<input type="text" class="form-control kt_datepicker" readonly value="{{date('Y-m-d')}}" id="tgl_end" name="tgl_end" />
																<div class="input-group-append">
																	<span class="input-group-text">
																		<i class="la la-calendar"></i>
																	</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
													<div class="kt-form__group kt-form__group--inline">
														<div class="kt-form__control">
															<button type="button" class="btn btn-sm btn-pill btn-success" id="filter">Tampilkan</button>
															<button type="submit" class="btn btn-sm btn-pill btn-info" id="cetak">Cetak</button>
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
								<table class="table table-bordered table-hover m-table" id="tabel">
									<thead>
										<tr>
											<th>ID</th>
											<th>No Nota</th>
											<th>Tgl Bongkar</th>
											<th>Gudang</th>
											<th>Berat</th>
											<th>Harga</th>
											<th>Jumlah</th>
											<th>Tgl Lunas</th>
											<th>Actions</th>
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
			<form class="modal fade" id="kt_modal_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Detail Bongkar</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-12">
									<table class="table table-sm table-head-bg-brand" >
										<thead class="thead-light">
											<tr>
												<th>Nota</th>
												<th>Tgl Kas</th>
												<th>Rp Bayar</th>
												<th>Kekurangan</th>
												<th>Metode Bayar</th>
												<th>Rek Bayar</th>
												<th>Rek Tujuan</th>
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
		$('.kt_datepicker').datepicker({
			todayHighlight:1	,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
		});
		
		$('#tabel').DataTable({
			"responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('bgudang-data',['filter' => '0;'.date('Y-m-d').';'.date('Y-m-d')]) }}",
	        "columns": [
	            {data: 'id_gudang', class: 'kt-hide'},
	            {data: 'no_nota'},
	            {data: 'tgl_bongkar'},
	            {data: 'gudang.nama_gudang'},
	            {data: 'detail[0].berat', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'detail[0].harga', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'rp_bongkar', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'detail[0].tgl_lunas'},
	            {data: 'menu', orderable: false, searchable: false}
	        ],
	    });

	    $('.kt-select2').select2();

	    $("#filter").click(function(){
	    	var url = "{{ url('laporan-gudang-data') }}/" + $('#fgudang').val() + ";" + $('#tgl_start').val() + ";" + $('#tgl_end').val();
	    	// alert(url);
			$('#tabel').DataTable().ajax.url(url).load();
	    });

	    // $("#cetak").click(function(){
	    // 	// alert($('#fseleb').val());
	    // 	$fseleb = $('#fseleb').val();
	    // 	$.ajax({
		   //      type: "POST",
		   //      url: "{{route('bseleb-cetak')}}",
		   //      data: {filter: fseleb, _token: "{{ csrf_token() }}"},
		   //      success: function (result)
		   //      {
		   //          // $('#tabel').DataTable().ajax.reload();
		   //      }
		   //  });
	    // });

	 //    function cetak(filter){
		// // alert(kode);
		// $.ajax({
	 //        type: "POST",
	 //        url: "{{route('bseleb-cetak')}}",
	 //        data: {filter: filter, _token: "{{ csrf_token() }}"},
	 //        success: function (result)
	 //        {
	 //            $('#tabel').DataTable().ajax.reload();
	 //        }
	 //    });
	// }
	   
	});

	function detail(kode){
		var token = '{{csrf_token()}}';
        $.ajax({
            url: "{{route('laporan-gudang-detail')}}",
            type: 'GET',
            headers: {'X-CSRF-TOKEN': token},
            data: {recid: kode},
            cache: false,
            
            success: function (result) {
            	$("#mdetail").empty();
                $.each( result.data, function( key, value ) {
                	// alert(value.keterangan);
				 	$("#mdetail").append('<tr><td>'+value.recid_transaksi+'</td><td>'+value.tgl_kas+'</td><td>'+value.rp_bayar+'</td><td>'+value.rp_kekurangan+'</td><td>'+value.pay_method+'</td><td>'+value.rek_bayar+'</td><td>'+value.rek_tujuan+'</td></tr>');
				});
				$("#kt_modal_list").modal('show');
            }
        });
    
	}

</script>
@endsection