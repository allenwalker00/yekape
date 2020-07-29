@extends('layout')
@section('title')
	Buku Seleb | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Buku Seleb </h3>
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
									<b>Buku Seleb</b> - Laporan
								</span>
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<!-- <a href="" target="_blank"><button type="button" class="btn btn-sm btn-info" id="cetakAll">Cetak Laporan</button></a> -->
									<!-- <button type="button" class="btn btn-sm btn-info" id="cetak">Cetak Laporan</button> -->
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-prodi">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('bseleb-cetak')}}" target="_blank">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="kt-form kt-form--label-right kt-margin-t-10 kt-margin-b-10">
									<div class="row align-items-center">
										<div class="col-xl-8 order-2 order-xl-1">
											<div class="row align-items-center">
												<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
													<div class="kt-form__group kt-form__group--inline">
														<div class="kt-form__label">
															<label>Seleb:</label>
														</div>
														<div class="kt-form__control">
															<select class="form-control kt-select2" id="fseleb" name="fseleb">
																<option value="0" selected>Semua</option>
																@foreach($seleb as $row)
								                                  <option value="{{$row->id_seleb}}">{{$row->nama_seleb}} - {{$row->kecamatan}} - {{$row->kabupaten}}</option>
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
											<th>Tgl Muat</th>
											<th>Seleb</th>
											<th>Jml Beras</th>
											<th>Harga</th>
											<th>Supir</th>
											<th>Kirim Ke</th>
											<th>Tgl Bayar</th>
											<th>Rp Bayar</th>
											<th>Sisa Uang</th>
											<th>Metode Bayar</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div class="row">
									<label class="col-form-label col-md-4">Total Hutang : Rp. {{number_format($total_hutang*-1,2,',','.')}}</label>
								</div>
								<div class="row">
									<label class="col-form-label col-md-4">Total Piutang : Rp. {{number_format($total_piutang,2,',','.')}}</label>
								</div>
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
<link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />

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
<script src="{{asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/custom/js/vendors/bootstrap-timepicker.init.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>

<script type="text/javascript">

	$(document).ready(function () {
		$(".f_tgl").datepicker({
			todayHighlight:0,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
		});
		
		$('#tabel').DataTable({
			"responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('bseleb-data',['filter' => '0;'.date('Y-m-d').';'.date('Y-m-d')]) }}",
	        "columns": [
	            // {data: 'tgl_kas'},
	            // {data: 'jenis_kas'},
	            // {data: 'jumlah'},
	            {data: 'transaksi.tgl_muat'},
	            {data: 'seleb.nama_seleb'},
	            {data: 'berat', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right', defaultContent:'-'},
	            {data: 'harga', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right', defaultContent:'-'},
	            {data: 'transaksi.truk.nama_supir'},
	            {data: 'transaksi.gudang.nama_gudang'},
	            {data: 'payment.tgl_kas'},
	            {data: 'payment.rp_bayar', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right', defaultContent:'-'},
	            {data: 'payment.rp_kekurangan', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right', defaultContent:'-'},
	            {data: 'payment.pay_method'},
	        ],
	    });

	    $('.kt-select2').select2();
	    
	    $("#filter").click(function(){
	    	var url = "{{ url('laporan-seleb-data') }}/" + $('#fseleb').val() + ";" + $('#tgl_start').val() + ";" + $('#tgl_end').val();
	    	// alert(url);
			$('#tabel').DataTable().ajax.url(url).load();
	    });

	    $('.kt_datepicker').datepicker({
			todayHighlight:1	,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
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

</script>
@endsection