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
									<b>Pengeluaran Rumah Tangga</b>
								</span>
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<button class="btn btn-outline-brand btn-icon btn-sm flaticon2-plus" id="tambah">
									</button>
								</div>
								<div class="kt-portlet__head-actions">
									&nbsp;
								</div>
								<div class="kt-portlet__head-actions">
									<button class="btn btn-outline-brand btn-icon btn-sm flaticon-more-1" id="b_filter" data-toggle="modal">
									</button>
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
											<th>Tgl Bon</th>
											<th>Tgl TerimaBon</th>
											<th>Keperluan</th>
											<th>Keterangan</th>
											<th>Jumlah</th>
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
									Form {{($data == null) ? 'Tambah' : 'Edit'}} Pengeluaran Rumah Tangga
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-keluar">
							<div class="kt-section__content">
								<form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('keluar-simpan')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="tipe" value="{{($data == null) ? 1 : 2}}">
									<input type="hidden" name="id" value="{{$data->id or ''}}">
									<div class="form-group kt-form__group row">
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
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Keperluan</label>
										<div class="col-md-6">
											<select class="form-control kt-select2" id="keperluan" name="keperluan" style="width: 100%" required>
												<option value="">Pilih Keperluan</option>
			                                    @foreach($keperluan as $r)
			                                    @if($data != null && $data->id_keperluan == $r->id)
			                                    	<option value="{{$r->id}}" selected="">{{$r->keterangan}}</option>
			                                    @else
			                                    	<option value="{{$r->id}}">{{$r->keterangan}}</option>
			                                    @endif
			                                    @endforeach
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Keterangan</label>
										<div class="col-md-6">
											<textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{$data->keterangan or ''}}</textarea>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">Jumlah (Rp)</label>
										<div class="col-md-3">
											<input type="text" class="form-control kt-input kt-input--air currency" name="jumlah" id="jumlah" value="{{$data==null? "" : number_format($data->jumlah, 0, ',', '.')}}" required {{$data == null ? "" : "readonly" }}>
										</div>
									</div>
									<div class="form-group kt-form__group row">
										<label class="col-form-label col-md-2">&nbsp;</label>
										<div class="col-md-6">
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="{{route('keluar-link')}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<form class="modal fade" id="modal_filter" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" method="post" action="{{route('keluar-cetak')}}" target="_blank">
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
										<label class="col-form-label col-md-4">Keperluan</label>
										<div class="col-md-8">
											<select class="form-control kt-select2" id="f_keperluan" name="f_keperluan" style="width: 100%">
												<option value="">Pilih Keperluan (Semua)</option>
			                                    @foreach($keperluan as $r)
			                                    	<option value="{{$r->id}}">{{$r->keterangan}}</option>
			                                    @endforeach
											</select>
										</div>
									</div>
									<div class="form-group kt-form__group row">
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
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-brand btn-info" id="filter">Tampilkan Data</button>
							<button type="submit" class="btn btn-sm btn-success" name="c1" value="1">Cetak</button>
							<button type="submit" class="btn btn-sm btn-success" name="c2" value="1">Cetak Rekap</button>
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</form>

			<!-- <form class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" method="post" action="{{route('keluar-simpan')}}" target="_blank">
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
										<label class="col-form-label col-md-4">Keperluan</label>
										<div class="col-md-6">
											<select class="form-control kt-select2" id="mkeperluan" name="mkeperluan" style="width: 100%" required>
												<option value="">Pilih Keperluan</option>
			                                    @foreach($keperluan as $r)
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

		var x = $('#tabel').DataTable({
			"responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('keluar-data',['filter' => '0;'.date('Y-m-d').';'.date('Y-m-d')]) }}",
	        "columns": [
	            {data: 'id', visible: false},
	            {data: 'tgl_bon'},
	            {data: 'tgl_terimabon'},
	            {data: 'keperluan.keterangan'},
	            {data: 'keterangan'},
	            {data: 'jumlah', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. '), className: 'text-right'},
	            {data: 'menu', orderable: false, searchable: false},
	        ],

	     //    @if ( Auth::user()->tipe == 'Admin')
	     //    	"columnDefs": [ {
		    //         "targets": 3,
			   //          render: function (data, type, row, meta){
						// 	var $select = $("<select class='pilihan form-control kt-select2' id='pilihan'><option value='0'>--Pilihan--</option>@foreach($keperluan as $r)<option value='{{$r->id}}'>{{$r->keterangan}}</option>@endforeach</select>");
						//   	$select.find('option[value="'+row.id_keperluan+'"]').attr('selected', 'selected');

						// 	return $select[0].outerHTML
						// }
		    //     } ],
		        // "columnDefs": [ {
		        //     "targets": -1,
		        //     "data": null,
		        //     "defaultContent": "<button>Click!</button>"
	        	// } ]
	        @endif
	        
	    });

	  //   $('#tabel tbody').on( 'click', 'button', function () {
	  //       let td = $(this).closest('tr').find('td');
			// let result = {
			// 	tgl: td.get(0).innerText,
			// 	id_keperluan: td.get(2).innerText
			// };
			// console.log(result[0])

			// // var s = result.id_keperluan;
			// alert(result.tgl);
	  //   } );

	    
	    $("#filter").click(function(){
	    	// alert($('#tgl_start').val());
	    	var url = "{{ url('keluar-data') }}/" + $('#f_keperluan').val() + ";" + $('#tgl_start').val() + ";" + $('#tgl_end').val();
	    	// alert(url);
			$('#tabel').DataTable().ajax.url(url).load();
			$("#modal_filter").modal('hide');


	    });
	   
	});

	// function update(id){
	// 	var token = '{{csrf_token()}}';
 //        $.ajax({
 //            url: "",
 //            type: 'GET',
 //            headers: {'X-CSRF-TOKEN': token},
 //            data: {id: id},
 //            cache: false,
            
 //            success: function (result) {
 //    //         	$("#mdetail").empty();
 //    //             $.each( result.data, function( key, value ) {
 //    //             	// alert(value.harga);
	// 			//  	$("#mdetail").append(
	// 			//  		'<tr><td>'+value.seleb.nama_seleb+'</td><td>'+value.berat+'</td><td>'+value.harga+'</td><td>'+value.rp_tagihan+'</td></tr>');
	// 			// });
	// 			$("#modal_update").modal('show');
 //            }
 //        });
 //    }
	

</script>
@endsection