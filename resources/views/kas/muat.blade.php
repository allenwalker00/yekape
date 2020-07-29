@extends('layout')
@section('title')
	Kas Muat | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Kas Muat </h3>
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
						<div class="form-group m-form__group row">
							<label class="col-form-label col-md-1">Seleb</label>
								<div class="col-md-3">
									<select class="form-control kt-select2" name="fseleb" id="fseleb" style="width: 100%">
										<option selected="selected" value="0">Pilih Seleb</option>
										@foreach($seleb as $row)
		                                  <option value="{{$row->id_seleb}}">{{$row->kabupaten}} - {{$row->nama_seleb}}</option>
		                              	@endforeach
									</select>
								</div>
							<label class="col-form-label col-md-1">Status Bayar</label>
							<div class="col-md-2">
								<select class="form-control kt-select2" id="fstatus">
									<option value="0">Semua</option>
									<option value="1">Lunas</option>
									<option value="2">Belum Lunas</option>
								</select>
							</div>
							<label class="col-form-label col-md-1">&nbsp;</label>
							<div class="col-md-2">
								<button class="btn btn-outline-info" id="filter">Tampilkan Data</button>
							</div>
						</div>
						<table class="table table-striped- table-bordered table-hover table-checkable" id="tabel">
							<thead>
								<tr>
									<th>No Nota</th>
									<th>Tgl Muat</th>
									<th>Seleb</th>
									<th>Berat</th>
									<th>Harga</th>
									<th>Jumlah</th>
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
									Form Entry Kas Muat
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-seleb">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('kmuat-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="recid" value="{{$data->recid or ''}}">
									<input type="hidden" name="id_transaksi" value="{{$data->id_transaksi or ''}}">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">No. Nota</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" name="no_nota" value="{{$transaksi->no_nota or ''}}" readonly>
										</div>
										<label class="col-form-label col-md-1" style="text-align: right;">Tgl Muat</label>
										<div class="col-md-2">
											<input type="text" class="form-control kt-input kt-input--air" value="{{$transaksi->tgl_muat or ''}}" readonly>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Nama Seleb</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" value="{{$data->seleb->nama_seleb or ''}}" readonly name="nama_seleb">	
										</div>
										<label class="col-form-label col-md-1" style="text-align: right;">Deposito</label>
										<div class="col-md-2">
											<input type="text" class="form-control kt-input kt-input--air" value="{{$data->seleb->saldo or ''}}" id="deposit" name="deposit" readonly style="text-align: right">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tagihan</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" value="{{$data->rp_tagihan or ''}}" name="rp_tagihan" id="rp_tagihan" style="text-align: right" readonly>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tgl Bayar</label>
										<div class="col-md-3">
											<div class="input-group date">
												<input type="text" class="form-control kt_datepicker" value="{{$data->tgl_bayar or ''}}" id="tgl_bayar" name="tgl_bayar" />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									@if(isset($data))
									@if($data->seleb->saldo > 0)
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Tipe Bayar</label>
										<div class="col-md-3">
											<select class="form-control kt-select2" id="pay_type" style="width: 100%" name="pay_type">
		                                	@if($data->seleb->saldo >= $data->rp_tagihan)
		                                		<option value="deposit">Deposit</option>
		                                	@else
		                                		<option value="split">Split</option>
											@endif
											</select>
										</div>
									</div>
									@endif
									@endif
									<div class="form-group kt-form__group row bayar">
										<label class="col-form-label col-md-2">Metode Bayar</label>
										<div class="col-md-3">
											<select class="form-control kt-select2" id="pay_method" style="width: 100%" name="pay_method">
												<option value="transfer">Transfer</option>
												<option value="tunai">Tunai</option>
											</select>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control kt-hide" name="rekening" id="" placeholder="Rekening" value="">
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
											<a href="{{route('kmuat-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
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
<link href="{{asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
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

<script type="text/javascript">
	$(document).ready(function () {
		$("#tambah").click(function(){
			$("#data").addClass('kt-hide');
			$("#baru").removeClass('kt-hide');
		});
		$('#tabel').DataTable({
			"responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('kmuat-data',['filter' => '0;0']) }}",
	        "columns": [
	            {data: 'transaksi.no_nota'},
	            {data: 'transaksi.tgl_muat'},
	            {data: 'seleb.nama_seleb'},
	            {data: 'berat', render: $.fn.dataTable.render.number(',', '.', 0, ''), class: 'text-right'},
	            {data: 'harga', render: $.fn.dataTable.render.number(',', '.', 0, ''), class: 'text-right'},
	            {data: 'rp_tagihan', render: $.fn.dataTable.render.number(',', '.', 0, ''), class: 'text-right'},
	            {data: 'tgl_lunas'},
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
	    	var url = "{{ url('kas-muat-data') }}/" + $('#fseleb').val() + ";" + $('#fstatus').val();
			$('#tabel').DataTable().ajax.url(url).load();
	    });

		$("#deposit").val(formatRupiah($("#deposit").val()));
		$("#rp_tagihan").val(formatRupiah($("#rp_tagihan").val()));

		$(".currency").keyup(function() {
			var rp = formatRupiah(this.value);
			$(this).val(rp);
		});

		if ($("#pay_type").val() == "deposit") {
			$('.rekening').val('');
			$('.rekening').addClass('kt-hide');
			$('.bayar').addClass('kt-hide');
		}else{
			$('.bayar').removeClass('kt-hide');
			if ($("#pay_method").val() == "tunai") {
				$('.rekening').val('');
				$('.rekening').addClass('kt-hide');
			}else{
				$('.rekening').removeClass('kt-hide');
			}			
		}

		$("#pay_method").change(function(){
			if ($(this).val() == "tunai") {
				$('.rekening').val('');
				$('.rekening').addClass('kt-hide');
			}else{
				$('.rekening').removeClass('kt-hide');
			}
		});


	});

	function hapus(kode){
		$.ajax({
	        type: "POST",
	        url: "{{route('kmuat-hapus')}}",
	        data: {id_kas: kode, _token: "{{ csrf_token() }}"},
	        success: function (result)
	        {
	            $('#tabel').DataTable().ajax.reload();
	        }
	    });
	}
	</script>
@endsection