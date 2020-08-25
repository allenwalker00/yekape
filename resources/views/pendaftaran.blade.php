@extends('public_layout')
@section('title')
	Pendaftaran Customer | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					&nbsp; </h3>
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
				<div class="kt-portlet kt-portlet--mobile" id="form">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="la la-book"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								<span>
									Form Pendaftaran Customer
								</span>
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-pengajuanBound">
							<div class="kt-section__content">
								<div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
									<div class="kt-grid__item">

										<!--begin: Form Wizard Nav -->
										<div class="kt-wizard-v3__nav">
											<div class="kt-wizard-v3__nav-items">
												<a class="kt-wizard-v3__nav-item" href="{{url('pendaftaran#s1')}}" data-ktwizard-type="step" data-ktwizard-state="current">
													<div class="kt-wizard-v3__nav-body">
														<div class="kt-wizard-v3__nav-label">
															<span>1</span> Pilih Unit
														</div>
														<div class="kt-wizard-v3__nav-bar"></div>
													</div>
												</a>
												<a class="kt-wizard-v3__nav-item" href="{{url('pendaftaran#s2')}}" data-ktwizard-type="step" data-ktwizard-state="current">
													<div class="kt-wizard-v3__nav-body">
														<div class="kt-wizard-v3__nav-label">
															<span>2</span> Data Diri
														</div>
														<div class="kt-wizard-v3__nav-bar"></div>
													</div>
												</a>
												<a class="kt-wizard-v3__nav-item" href="{{url('pendaftaran#s3')}}" data-ktwizard-type="step">
													<div class="kt-wizard-v3__nav-body">
														<div class="kt-wizard-v3__nav-label">
															<span>3</span> Dokumen Pelengkap
														</div>
														<div class="kt-wizard-v3__nav-bar"></div>
													</div>
												</a>
											</div>
										</div>

										<!--end: Form Wizard Nav -->
									</div>
									<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

										<!--begin: Form Wizard Form-->
										<form class="kt-form" id="kt_form" method="post" action="{{route('pendaftaran-simpan')}}" enctype="multipart/form-data">
											<input type="text" class="kt-hide" name="_token" value="{{csrf_token()}}">
											<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current" id="s1">
												<div class="kt-form__section kt-form__section--first">
													<div class="kt-wizard-v3__form">
														<div class="form-group">
															<img alt="Logo" src="{{asset('assets/ykp.jpeg')}}" style="width: 100%; height: auto;" class="kt-header__brand-logo-default"/>
														</div>
														
														<div class="form-group">
															<label>Lokasi</label>
															<select class="form-control" id="cluster" style="width: 100%" required>
																<option value="">Pilih Lokasi</option>
							                                    @foreach($cluster as $r)
						                                    		<option value="{{$r->cluster}}">{{$r->cluster}}</option>
							                                    @endforeach
															</select>
														</div>
														<div class="row" id="rowletak">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Letak</label>
																	<select class="form-control" id="letak" style="width: 100%" required>
																		<option value="">Pilih Letak</option>
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Tipe</label>
																	<select class="form-control" id="tipe" style="width: 100%" required>
																		<option value="">Pilih Tipe</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="row" id="rowblok">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Blok</label>
																	<select class="form-control" id="blok" style="width: 100%" required>
																		<option value="">Pilih Blok</option>
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Nomor</label>
																	<select class="form-control" id="nomor" name="kavling" style="width: 100%" required>
																		<option value="">Pilih Nomor</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!--begin: Form Wizard Step 2-->
											<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current" id="s2">
												<div class="kt-heading kt-heading--md">Isi Data Diri Anda</div>
												<div class="kt-form__section kt-form__section--first">
													<div class="kt-wizard-v3__form">
														<div class="form-group">
															<label>No KTP</label>
															<input type="text" class="form-control" name="noktp" required>
														</div>
														<div class="form-group">
															<label>Nama</label>
															<input type="text" class="form-control" name="nama" required>
														</div>
														<div class="form-group">
															<label>Jalan</label>
															<input type="text" class="form-control" name="jalan" required>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Kelurahan</label>
																	<input type="text" class="form-control" name="kel" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Kecamatan</label>
																	<input type="text" class="form-control" name="kec" required>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Kabupaten/Kota</label>
																	<input type="text" class="form-control" name="kab" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Provinsi</label>
																	<input type="text" class="form-control" name="prov" required>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Tempat Lahir</label>
																	<input type="text" class="form-control" name="tmp_lahir" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Tanggal Lahir</label>
																	<div class="input-group date">
																		<input type="text" class="form-control" id="kt_datepicker_birthday" name="tgl_lahir" required/>
																		<div class="input-group-append">
																			<span class="input-group-text">
																				<i class="la la-calendar"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Telephone</label>
																	<input type="text" class="form-control" name="telp" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Email</label>
																	<input type="text" class="form-control" name="email" required>
																</div>
															</div>
														</div>														
													</div>
												</div>
											</div>

											<!--begin: Form Wizard Step 3-->
											<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" id="s3">
												<div class="kt-heading kt-heading--md">Upload Dokumen Pendukung</div>
												<div class="kt-form__section kt-form__section--first">
													<div class="kt-wizard-v3__form">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Photo</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="photo" required>
																		<label class="custom-file-label" id="photolabel" for="photo">Choose file</label>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>KTP</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="ktp" required>
																		<label class="custom-file-label" id="ktplabel" for="ktp">Choose file</label>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>KK</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="kk" required>
																		<label class="custom-file-label" id="kklabel" for="kk">Choose file</label>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>NPWP</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="npwp" required>
																		<label class="custom-file-label" id="npwplabel" for="npwp">Choose file</label>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>SK Pegawai</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="sk" required>
																		<label class="custom-file-label" id="sklabel" for="sk">Choose file</label>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Slip Gaji</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="slipgaji" required>
																		<label class="custom-file-label" id="slipgajilabel" for="slipgaji">Choose file</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--end: Form Wizard Step 3-->

											<!--begin: Form Actions -->
											<div class="kt-form__actions">
												<div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
													Previous
												</div>
												<div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit" id="cobasubmit">
													Submit
												</div>
												<div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next" id="next">
													Next Step
												</div>
											</div>
											<input type="submit" class="kt-hidden" value="submit!" id="f_submit" name="submit"/>
											<!--end: Form Actions -->
										</form>

										<!--end: Form Wizard Form-->
									</div>
								</div>
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

<!-- <link href="{{asset('assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" /> -->
<link href="{{asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/demo1/pages/wizard/wizard-3.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
	.modal-lg {
	    max-width: 75%;
	}
</style>
@endsection
@section('js')
<!--begin::Page Vendors -->
<script src="{{asset('assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
<!-- <script src="{{asset('assets/js/demo1/pages/wizard/wizard-3.js')}}" type="text/javascript"></script> -->

<script type="text/javascript">
	$(document).ready(function () {
	    $('.kt-select2').select2();

	    @if(isset($data))
		    var tipe = "{{$data->tipe}}"
		    $("#tipe").val(tipe); 
	    @endif
	    

	    $("#kt_datepicker_birthday,#kt_datepicker_start,#kt_datepicker_end").datepicker({
			todayHighlight:0,
			autoclose:!0,
		    clearBtn: true,
			format:"dd-mm-yyyy",
		});

		var wizard = new KTWizard('kt_wizard_v3', {
			startStep: 1,
		});

		$("#Y").change(function(){
			if ($(this).val() == "X") {
				$('#div-other').removeClass('kt-hidden');
			}else{
				$('#div-other').addClass('kt-hidden');
			}
		});

		wizard.on('change', function(wizard) {
			KTUtil.scrollTop();	
		});
		
		$('div[data-ktwizard-type="action-submit"]').click(function(){
			$("#f_submit").trigger( "click" );
		});

		$("#cluster").change(function(){
	        var token = '{{csrf_token()}}';
	        var cluster = $('#cluster option:selected').val();

	        if (cluster == ''){
	        	$('#letak').empty();
	        	$('#tipe').empty();
	        	$('#blok').empty();
	        	$('#nomor').empty();
	        	$("#letak").append('<option value="">Pilih Letak</option>');
	        	$("#tipe").append('<option value="">Pilih Tipe</option>');
	        	$("#blok").append('<option value="">Pilih Blok</option>');
	        	$("#nomor").append('<option value="">Pilih Nomor</option>');
	        }else{
	        	$.ajax({
		            url: "{{route('lokasi-bycluster')}}",
		            type: 'POST',
		            headers: {'X-CSRF-TOKEN': token},
		            data: {cluster: cluster},
		            cache: false,
		            
		            success: function (result) {
		                $('#letak').empty();
			        	$('#tipe').empty();
			        	$('#blok').empty();
			        	$('#nomor').empty();
			        	$("#letak").append('<option value="">Pilih Letak</option>');
			        	$("#tipe").append('<option value="">Pilih Tipe</option>');
			        	$("#blok").append('<option value="">Pilih Blok</option>');
			        	$("#nomor").append('<option value="">Pilih Nomor</option>');
						for(i = 0; i < result.data.length; i++){
		                    $("#letak").append('<option value="'+result.data[i]['tipe']+'">'+ result.data[i]['tipe'] +'</option>');
		                }
		            }
		        });
	        }

	    });

	    $("#letak").change(function(){
	        var token = '{{csrf_token()}}';
	        var cluster = $('#cluster option:selected').val();
	        var letak = $('#letak option:selected').val();
	        if (letak == ''){
	        	$('#tipe').empty();
	        	$('#blok').empty();
	        	$('#nomor').empty();
	        	$("#tipe").append('<option value="">Pilih Tipe</option>');
	        	$("#blok").append('<option value="">Pilih Blok</option>');
	        	$("#nomor").append('<option value="">Pilih Nomor</option>');
	        }else{
	        	$.ajax({
		            url: "{{route('lokasi-byletak')}}",
		            type: 'POST',
		            headers: {'X-CSRF-TOKEN': token},
		            data: {cluster: cluster, letak: letak},
		            cache: false,
		            
		            success: function (result) {
		                $('#tipe').empty();
			        	$('#blok').empty();
			        	$('#nomor').empty();
			        	$("#tipe").append('<option value="">Pilih Tipe</option>');
			        	$("#blok").append('<option value="">Pilih Blok</option>');
			        	$("#nomor").append('<option value="">Pilih Nomor</option>');
						for(i = 0; i < result.data.length; i++){
		                    $("#tipe").append('<option value="'+result.data[i]['luas_bangun']+'">'+ result.data[i]['luas_bangun'] +'</option>');
		                }
		            }
		        });
	        }
	    });

	    $("#tipe").change(function(){
	        var token = '{{csrf_token()}}';
	        var cluster = $('#cluster option:selected').val();
	        var letak = $('#letak option:selected').val();
	        var tipe = $('#tipe option:selected').val();

	        if (tipe == ''){
	        	$('#blok').empty();
	        	$('#nomor').empty();
	        	$("#blok").append('<option value="">Pilih Blok</option>');
	        	$("#nomor").append('<option value="">Pilih Nomor</option>');
	        }else{
	        	$.ajax({
		            url: "{{route('lokasi-bytipe')}}",
		            type: 'POST',
		            headers: {'X-CSRF-TOKEN': token},
		            data: {cluster: cluster, letak: letak, tipe: tipe},
		            cache: false,
		            
		            success: function (result) {
		                $('#blok').empty();
			        	$('#nomor').empty();
			        	$("#blok").append('<option value="">Pilih Blok</option>');
			        	$("#nomor").append('<option value="">Pilih Nomor</option>');
						for(i = 0; i < result.data.length; i++){
		                    $("#blok").append('<option value="'+result.data[i]['blok']+'">'+ result.data[i]['blok'] +'</option>');
		                }
		            }
		        });
	        }
	    });

	    $("#blok").change(function(){
	        var token = '{{csrf_token()}}';
	        var cluster = $('#cluster option:selected').val();
	        var letak = $('#letak option:selected').val();
	        var tipe = $('#tipe option:selected').val();
	        var blok = $('#blok option:selected').val();

	        if (blok == ''){
	        	$('#nomor').empty();
	        	$("#nomor").append('<option value="">Pilih Nomor</option>');
	        }else{
	        	$.ajax({
		            url: "{{route('lokasi-byblok')}}",
		            type: 'POST',
		            headers: {'X-CSRF-TOKEN': token},
		            data: {cluster: cluster, letak: letak, tipe: tipe, blok: blok},
		            cache: false,
		            
		            success: function (result) {
		                $('#nomor').empty();
	        			$("#nomor").append('<option value="">Pilih Nomor</option>');
						for(i = 0; i < result.data.length; i++){
		                    $("#nomor").append('<option value="'+result.data[i]['id']+'">'+ result.data[i]['nomor'] +'</option>');
		                }
		            }
		        });
	        }
	    });
		

	});

</script>
@endsection