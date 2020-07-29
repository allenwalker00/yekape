@extends('layout')
@section('title')
	Kas Piutang | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Kas Piutang </h3>
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
									<button class="btn btn-brand btn-elevate btn-icon-sm btn-sm" id="tambah">
										<i class="la la-plus"></i>
										Tambah
									</button>
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
								<button class="btn btn-outline-info btm-sm" id="filter">Tampilkan Data</button>
							</div>
						</div>
						<table class="table table-striped- table-bordered table-hover table-checkable" id="tabel">
							<thead>
								<tr>
									<th>Tgl Transaksi</th>
									<th>Seleb</th>
									<th>Keterangan</th>
									<th>Jumlah</th>
									<!-- <th>Actions</th> -->
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="kt-portlet kt-portlet--mobile {{($data == null) ? 'kt-hide' : ''}}" id="baru">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								<span>
									Form Entry Kas Piutang Seleb
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-seleb">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('kpiutang-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="tipe" value="{{($data == null) ? 1 : 2}}">
									<input type="hidden" name="id_transaksi" value="{{$data->id_transaksi or ''}}">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2" >Tgl Transaksi</label>
										<div class="col-md-3">
											<div class="input-group date">
												<input type="text" class="form-control kt-datepicker" value="{{$data->tgl_transaksi or ''}}" id="tgl_transaksi" name="tgl_transaksi" />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Nama Seleb</label>
										<div class="col-md-4">
											<select class="form-control kt-select2" name="id_seleb" id="id_seleb" style="width: 100%">
												<option value="0">Pilih Seleb</option>
											@foreach($seleb as $row)
				                                @if(isset($data))
				                                  @if($data->kaspiutang['id_seleb'] == $row->id_seleb)
				                                    <option selected="selected" value="{{$row->id_seleb}}">{{$row->kabupaten}} - {{$row->nama_seleb}}</option>
				                                  @else
				                                    <option value="{{$row->id_seleb}}">{{$row->kabupaten}} - {{$row->nama_seleb}}</option>
				                                  @endif
				                                @else
				                                  <option value="{{$row->id_seleb}}">{{$row->kabupaten}} - {{$row->nama_seleb}}</option>
				                                @endif
			                              	@endforeach
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Jumlah</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" value="{{$data->rp_lain or ''}}" name="rp_lain" style="text-align: right;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Keterangan</label>
										<div class="col-md-4">
											<textarea class="form-control" id="exampleTextarea" rows="3" name="ket_lain">{{$data->ket_lain or ''}}</textarea>
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
										<label class="col-form-label col-md-2">&nbsp;</label>
										<div class="col-md-6">
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="{{route('kpiutang-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
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
	        "ajax": "{{ route('kpiutang-data',['filter' => '0;0']) }}",
	        "columns": [
	            {data: 'tgl_transaksi'},
	            {data: 'seleb.nama_seleb'},
	            {data: 'ket_lain'},
	            {data: 'rp_lain', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. '), className: 'text-right'},
	            // {data: 'menu', orderable: false, searchable: false}
	        ]
	    });
	    $('.kt-select2').select2();

	    $('.kt-datepicker').datepicker({
			todayHighlight:1,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
		});

        $("#filter").click(function(){
	    	var url = "{{ url('kas-piutang-data') }}/" + $('#fseleb').val() + ";" + $('#fstatus').val();
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

		$(".currency").keyup(function() {
			var rp = formatRupiah(this.value);
			$(this).val(rp);
		});

	});
	function hapus(kode){
		$.ajax({
	        type: "POST",
	        url: "{{route('kpiutang-hapus')}}",
	        data: {id_kas: kode, _token: "{{ csrf_token() }}"},
	        success: function (result)
	        {
	            $('#tabel').DataTable().ajax.reload();
	        }
	    });
	}
	</script>
@endsection