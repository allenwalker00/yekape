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
									<button class="btn btn-outline-brand btn-icon btn-sm flaticon-more-1" id="b_filter" data-toggle="modal">
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
						<div class="kt-section" id="umumkavling-data">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('umumkavling-simpan')}}">
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
									@if($data != null)
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Cluster</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="" id="cluster" value="{{$data->cluster}} BLOK {{$data->blok}} NO {{$data->nomor}}" readonly>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">LB / LT</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air" name="" id="luas_bangun" value="{{$data->luas_bangun}} / {{$data->luas_tanah}}" readonly>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Status</label>
										<div class="col-md-3">
											<select class="form-control kt-select2" id="status" name="status" style="width: 100%">
												<option value="">Pilih Status</option>
			                                    @foreach($status as $r)
			                                    @if($data->status == $r->id)
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
											<input type="text" class="form-control kt-input kt-input--air" name="nama_pemesan" id="nama_pemesan" value="{{$data->nama_pemesan or ''}}" style="text-transform: uppercase;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Telepon Pemesan</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air" name="telp_pemesan" id="telp_pemesan" value="{{$data->telp_pemesan or ''}}" style="text-transform: uppercase;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Keterangan</label>
										<div class="col-md-6">
											<textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{$data->keterangan or ''}}</textarea>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Harga KPR (Rp)</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="harga_kpr" id="harga_kpr" value="{{number_format($data->harga_kpr, 0, ',', '.')}}">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">&nbsp;</label>
										<div class="col-md-6">
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="{{route('umumkavling-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
										</div>
									</div>
									@endif
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<form class="modal fade" id="modal_hitung" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" target="_blank">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="">Hitung</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-12">
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Cluster</label>
										<div class="col-md-8">
											<input type="text" class="form-control kt-input kt-input--air" name="" id="mcluster" readonly>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Harga</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air currency" name="" id="mharga" style="text-align: right;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Uang Muka 20%</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air currency" name="" id="muangmuka" style="text-align: right;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Angsuran UM</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air currency" name="" id="mangsuran" style="text-align: right;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Bunga (%)</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air currency" name="" id="mbunga" style="text-align: right;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Angsuran 5th</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air currency" name="" id="m5" style="text-align: right;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Angsuran 10th</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air currency" name="" id="m10" style="text-align: right;">
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-4">Angsuran 15th</label>
										<div class="col-md-6">
											<input type="text" class="form-control kt-input kt-input--air currency" name="" id="m15" style="text-align: right;">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-brand btn-info" id="hitung">Hitung</button>
							<!-- <button type="submit" class="btn btn-sm btn-success">Cetak</button> -->
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</form>

			<!-- <form class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" method="post" action="{{route('umumkavling-simpan')}}" target="_blank">
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

		$(".currency").keyup(function() {
			var rp = formatRupiah(this.value);
			$(this).val(rp);
		});

		$(".kt_datepicker").datepicker({
			todayHighlight:1,
			autoclose:!0,
		    clearBtn: true,
			format:"yyyy-mm-dd",
			orientation: "bottom left",
		});

		$('.kt-select2').select2();

		$('#tabel').DataTable({
			"responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('umumkavling-data',['filter' => '0;0;']) }}",
	        "columns": [
	            {title: 'Cluster', data: 'cluster', defaultContent: '-'},
	            {title: 'Blok', data: 'blok', defaultContent: '-'},
	            {title: 'Nomor', data: 'nomor', defaultContent: '-'},
	            {title: 'Tipe', data: 'tipe', defaultContent: '-'},
	            {title: 'LB', data: 'luas_bangun', defaultContent: '-'},
	            {title: 'LT', data: 'luas_tanah', defaultContent: '-'},
	            {title: 'Harga KPR', data: 'harga_kpr', defaultContent: '-', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. '), className: 'text-right'},
	            {title: 'Status', data: 'kavlingstatus.keterangan', defaultContent: '-'},
	            {title: 'Nama Pemesan', data: 'customer.nama', defaultContent: '-'},
	            {title: 'Telp', data: 'customer.telp', defaultContent: '-'},
	            {title: 'Tgl Booking', data: 'tgl_booking', defaultContent: '-'},
	            {title: 'Keterangan', data: ',keterangan', defaultContent: '-'},
	            // {title: 'Menu', data: 'menu', orderable: false, searchable: false},
	        ],	        
	    });

	  //   $('#tabel tbody').on( 'click', 'button', function () {
	  //       let td = $(this).closest('tr').find('td');
			// let result = {
			// 	tgl: td.get(0).innerText,
			// 	id_status: td.get(2).innerText
			// };
			// console.log(result[0])

			// // var s = result.id_status;
			// alert(result.tgl);
	  //   } );

	    
	    $("#filter").click(function(){
	    	// alert($('#tgl_start').val());
	    	var url = "{{ url('umumkavling-data') }}/" + $('#f_cluster').val() + ";" + $('#f_blok').val()+ ";" + $('#f_status').val();
	    	// alert(url);
			$('#tabel').DataTable().ajax.url(url).load();


	    });

	    $("#hitung").click(function(){
	    	var bunga = $('#mbunga').val().replace('.','').replace('.','').replace('.','')/100;

	    	var pokokpinjaman = $('#mharga').val().replace('.','').replace('.','').replace('.','') - $('#muangmuka').val().replace('.','').replace('.','').replace('.','');

	    	var x5 = -1 * pmt(bunga/12, 5*12, pokokpinjaman);
	    	var x10 = -1 * pmt(bunga/12, 10*12, pokokpinjaman);
	    	var x15 = -1 * pmt(bunga/12, 15*12, pokokpinjaman);

	    	var t5 = rupiah(x5.toFixed(2));
	    	var t10 = rupiah(x10.toFixed(2));
	    	var t15 = rupiah(x15.toFixed(2));

	    	// alert()

	    	$('#m5').val(t5);
	    	$('#m10').val(t10);
	    	$('#m15').val(t15);
			// $('#tabel').DataTable().ajax.url(url).load();
			// $("#modal_filter").modal('hide');


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

	function hitung(id){
		// alert(id);

		var token = '{{csrf_token()}}';
        $.ajax({
            url: "{{route('umumkavling-hitung')}}",
            type: 'GET',
            headers: {'X-CSRF-TOKEN': token},
            data: {id: id},
            cache: false,
            
            success: function (result) {
            	// var x = formatRupiah(result.data.harga_kpr);

            	$("#mcluster").val(result.data.cluster+' BLOK '+result.data.blok+' NO '+result.data.nomor);
            	$("#mharga").val(rupiah(result.data.harga_kpr));
            	$("#muangmuka").val(rupiah(result.data.harga_kpr*0.2));
            	$("#mangsuran").val(rupiah(result.data.harga_kpr*0.2/24));
	   			$('#mbunga').val('');
	   			$('#m5').val('');
		    	$('#m10').val('');
		    	$('#m15').val('');
				$("#modal_hitung").modal('show');
            }
        });
    
	}

	function pmt(rate_per_period, number_of_payments, present_value, future_value, type){
	    future_value = typeof future_value !== 'undefined' ? future_value : 0;
	    type = typeof type !== 'undefined' ? type : 0;

		if(rate_per_period != 0.0){
			// Interest rate exists
			var q = Math.pow(1 + rate_per_period, number_of_payments);
			return -(rate_per_period * (future_value + (q * present_value))) / ((-1 + q) * (1 + rate_per_period * (type)));

		} else if(number_of_payments != 0.0){
			// No interest rate, but number of payments exists
			return -(future_value + present_value) / number_of_payments;
		}

		return 0;
	}

	function rupiah(n){
		var bilangan = (n.toString()).replace('.', ",");
		var	number_string = bilangan.toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);
				
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

		// Cetak hasil	

		return rupiah;
		// document.write(rupiah); // Hasil 23.456.789,32
	}
	

</script>
@endsection