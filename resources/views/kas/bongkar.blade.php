@extends('layout')
@section('title')
	Kas Bongkar | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Kas Bongkar </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
			</div>
			
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<!--begin::Portlet-->
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="kt-portlet  {{($data == null) ? '' : 'kt-hide'}}" id="data">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="la la-cog"></i>
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
									&nbsp;
									<!-- <button class="btn btn-brand btn-elevate btn-icon-sm" id="tambah">
										<i class="la la-plus"></i>
										Tambah
									</button> -->
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="m-form__group row">
							<label class="col-sm-3">Status Bayar</label>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-sm-4">
								<select class="form-control kt-select2" id="fstatus">
									<option value="0">Semua</option>
									<option value="1">Lunas</option>
									<option value="2">Belum Lunas</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-md-2">
								<button class="btn btn-outline-info" id="filter">Tampilkan Data</button>
							</div>
						</div>
						<table class="table table-striped- table-bordered table-hover table-checkable" id="tabel">
							<thead>
								<tr>
									<th>No Nota</th>
									<th>Tgl Muat</th>
									<th>Tgl Bongkar</th>
									<th>Seleb</th>
									<th>Gudang</th>
									<th>Supir</th>
									<th>Berat Bongkar</th>
									<th>Harga Bongkar</th>
									<th>Rp Bongkar</th>
									<th>Rp Bayar</th>
									<th>Kekurangan</th>
									<th>Tgl Lunas</th>
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
									Form Entry Pembayaran Gudang
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-seleb">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('kbongkar-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="id_transaksi" value="{{$data->id_transaksi or ''}}">
									<input type="hidden" name="recid" value="{{$detail->recid or ''}}">
									<input type="hidden" name="id_gudang" value="{{$data->id_gudang or ''}}">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">No. Nota</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" name="no_nota" value="{{$data->no_nota or ''}}" readonly>
										</div>
										<label class="col-form-label col-md-1" style="text-align: right;">Tgl Bongkar</label>
										<div class="col-md-2">
											<input type="text" class="form-control kt-input kt-input--air" value="{{$data->tgl_bongkar or ''}}" readonly>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Nama Gudang</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" value="{{$data->gudang->nama_gudang or ''}}" readonly name="nama_gudang">	
										</div>
										<label class="col-form-label col-md-1" style="text-align: right;">Piutang</label>
										<div class="col-md-2">
											<input type="text" class="form-control kt-input kt-input--air" value="{{$data->gudang->saldo or ''}}" style="text-align: right" name="piutang" id="piutang" readonly>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tagihan</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" value="{{$tagihan or ''}}" style="text-align: right" id="rp_tagihan" name="rp_tagihan" readonly>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tgl Bayar</label>
										<div class="col-md-3">
											<div class="input-group date">
												<input type="text" class="form-control kt_datepicker" id="tgl_bayar" name="tgl_bayar" />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group kt-form__group row bayar">
										<label class="col-form-label col-md-2">Metode Bayar</label>
										<div class="col-md-3">
											<select class="form-control kt-select2" id="pay_method" style="width: 100%" name="pay_method">
												<option value="transfer">Transfer</option>
												<option value="tunai">Tunai</option>
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row rekening">
										<label class="col-form-label col-md-2">Rekening Bayar</label>
										<div class="col-md-3">
											<input type="text" class="form-control" name="rek_bayar" placeholder="" value="">
										</div>
									</div>
									<div class="form-group kt-form__group row rekening">
										<label class="col-form-label col-md-2">Rekening Tujuan</label>
										<div class="col-md-3">
											<input type="text" class="form-control" name="rek_tujuan" placeholder="" value="">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Jumlah</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" value="{{$data->rp_bayar or ''}}" name="rp_bayar" style="text-align: right">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">&nbsp;</label>
										<div class="col-md-6">
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="{{route('kbongkar-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
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
<!-- <link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" /> -->
<!-- <link href="{{asset('assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" /> -->
<!-- <link href="{{asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
	.modal-lg {
	    max-width: 100%;
	}
</style>
@endsection
@section('js')
<!--begin::Page Vendors -->
<!-- <script src="{{asset('assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script> -->
<!-- <script src="{{asset('assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script> -->
<!-- <script src="{{asset('assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script> -->
<!-- <script src="{{asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script> -->
<!-- <script src="{{asset('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script> -->
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
	        "ajax": "{{ route('kbongkar-data',['filter' => '0']) }}",
	        "columns": [
	            {data: 'no_nota'},
	            {data: 'tgl_muat'},
	            {data: 'tgl_bongkar'},
	            {data: 'kd_transaksi'},
	            {data: 'gudang.nama_gudang'},
	            {data: 'truk.nama_supir'},
	            {data: 'berat_bongkar', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'rek_bayar', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'rp_bongkar', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'rp_lain', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'rp_muat', render: $.fn.dataTable.render.number(',', '.', 0, ''), className: 'text-right'},
	            {data: 'tgl_lunas_bongkar'},
	            {data: 'menu', orderable: false, searchable: false}
	        ]
	    });

	    $('.kt-select2').select2();

	    $('.kt_datepicker').datepicker({
			todayHighlight:1,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
		});

        $("#filter").click(function(){
	    	var url = "{{ url('kas-bongkar-data') }}/" + $('#fstatus').val();
	    	// alert(url);
			$('#tabel').DataTable().ajax.url(url).load();
	    });

	    $("#pay_method").change(function(){
			if ($(this).val() == "tunai") {
				$('.rekening').val('');
				$('.rekening').addClass('kt-hide');
			}else{
				$('.rekening').removeClass('kt-hide');
			}
		});

		$("#piutang").val(formatRupiah($("#piutang").val()));
		$("#rp_tagihan").val(formatRupiah($("#rp_tagihan").val()));

		$(".currency").keyup(function() {
			var rp = formatRupiah(this.value);
			$(this).val(rp);
		});

	});

	// function hapus(kode){
	// 	// alert(kode);
	// 	$.ajax({
	//         type: "POST",
	//         url: "{{route('kbongkar-hapus')}}",
	//         data: {id_seleb: kode, _token: "{{ csrf_token() }}"},
	//         success: function (result)
	//         {
	//             $('#tabel').DataTable().ajax.reload();
	//         }
	//     });
	// }
	</script>
@endsection