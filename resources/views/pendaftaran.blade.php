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
				<!-- <div class="kt-subheader__breadcrumbs">
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">
						Pricing Tables 1 </a>

					<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span>
				</div> -->
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
												<a class="kt-wizard-v3__nav-item" href="" data-ktwizard-type="step" data-ktwizard-state="current">
													<div class="kt-wizard-v3__nav-body">
														<div class="kt-wizard-v3__nav-label">
															<span>1</span> Data Diri
														</div>
														<div class="kt-wizard-v3__nav-bar"></div>
													</div>
												</a>
												<!-- <a class="kt-wizard-v3__nav-item" href="" data-ktwizard-type="step">
													<div class="kt-wizard-v3__nav-body">
														<div class="kt-wizard-v3__nav-label">
															<span>2</span> Purpose
														</div>
														<div class="kt-wizard-v3__nav-bar"></div>
													</div>
												</a> -->
												<a class="kt-wizard-v3__nav-item" href="" data-ktwizard-type="step">
													<div class="kt-wizard-v3__nav-body">
														<div class="kt-wizard-v3__nav-label">
															<span>2</span> Dokumen Pelengkap
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
										<form class="kt-form" id="kt_form" method="post" action="{{route('pendaftaran-simpan')}}">
											<input type="text" class="kt-hide" name="_token" value="{{csrf_token()}}">
											<!--begin: Form Wizard Step 1-->
											<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
												<div class="kt-heading kt-heading--md">Isi Data Diri Anda</div>
												<div class="kt-form__section kt-form__section--first">
													<div class="kt-wizard-v3__form">
														<div class="form-group">
															<label>Nama</label>
															<input type="text" class="form-control" name="surname">
														</div>
														<div class="form-group">
															<label>Jalan</label>
															<input type="text" class="form-control" name="first_name">
														</div>
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Kelurahan</label>
																	<input type="text" class="form-control" name="nationality">
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Kecamatan</label>
																	<input type="text" class="form-control" name="passport">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Kabupaten/Kota</label>
																	<input type="text" class="form-control" name="nationality">
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Provinsi</label>
																	<input type="text" class="form-control" name="passport">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Tempat Lahir</label>
																	<input type="text" class="form-control" name="gender">
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Tanggal Lahir</label>
																	<div class="input-group date">
																		<input type="text" class="form-control" id="kt_datepicker_birthday" name="birthday" />
																		<div class="input-group-append">
																			<span class="input-group-text">
																				<i class="la la-calendar"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<!-- <div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>State</label>
																	<input type="text" class="form-control" name="state">
																</div>
															</div>
															<div class="col-xl-3">
																<div class="form-group">
																	<label>Country</label>
																	<input type="text" class="form-control" name="country">
																</div>
															</div>
															<div class="col-xl-3">
																<div class="form-group">
																	<label>Zip Code</label>
																	<input type="text" class="form-control" name="zip_code">
																</div>
															</div>
														</div> -->
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Telephone</label>
																	<input type="text" class="form-control" name="telephone">
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Email</label>
																	<input type="text" class="form-control" name="email">
																</div>
															</div>
														</div>														
													</div>
												</div>
											</div>

											<!--end: Form Wizard Step 1-->

											<!--begin: Form Wizard Step 2-->
											<!-- <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
												<div class="kt-heading kt-heading--md">Enter the Details of your Purpose</div>
												<div class="kt-form__section kt-form__section--first">
													<div class="kt-wizard-v3__form">
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Currently Enrolled at</label>
																	<input type="text" class="form-control" name="enrolled_at">
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Year Stundent</label>
																	<input type="text" class="form-control" name="year">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Purpose of the visit</label>
																	<select name="visit_purpose" class="form-control">
																		<option value="">Select</option>
																		<option value="Clinical Elective">Clinical Elective</option>
																		<option value="Student Research Project">Student Research Project</option>
																	</select>
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Expected Graduation</label>
																	<input type="text" class="form-control" name="date_graduate">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Clinical Elective Preference</label>
																	<select name="clinical_preferance" class="form-control" id="Y">
																		<option value="">Select</option>
																		<option value="Clinical Elective">Clinical Elective</option>
																		<option value="Student Research Project">Student Research Project</option>
																		<option value="Other">Others</option>
																	</select>
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group kt-hidden" id="div-other">
																	<label>Others</label>
																	<input type="text" class="form-control" name="clinical_preferance_other">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Inclusive Date Start</label>
																	<div class="input-group date">
																		<input type="text" class="form-control" id="kt_datepicker_start" name="inclusive_date_start" />
																		<div class="input-group-append">
																			<span class="input-group-text">
																				<i class="la la-calendar"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Inclusive Date End</label>
																	<div class="input-group date">
																		<input type="text" class="form-control" id="kt_datepicker_end" name="inclusive_date_end" />
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
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Insurance</label>
																	<input type="text" class="form-control" name="insurance_name">
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Insurance Number</label>
																	<input type="text" class="form-control" name="insurance_number">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div> -->
											<!--end: Form Wizard Step 2-->

											<!--begin: Form Wizard Step 3-->
											<div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
												<div class="kt-heading kt-heading--md">Upload Dokumen Pendukung</div>
												<div class="kt-form__section kt-form__section--first">
													<div class="kt-wizard-v3__form">
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>Photo</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="photo">
																		<label class="custom-file-label" id="photolabel" for="photo">Choose file</label>
																	</div>
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>KTP</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="cv">
																		<label class="custom-file-label" id="cvlabel" for="cv">Choose file</label>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label>KK</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="passport">
																		<label class="custom-file-label" id="passportlabel" for="passport">Choose file</label>
																	</div>
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label>NPWP</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" name="intens">
																		<label class="custom-file-label" id="intenslabel" for="intens">Choose file</label>
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

		// Change event
		wizard.on('change', function(wizard) {
			KTUtil.scrollTop();	
		});
		
		$('div[data-ktwizard-type="action-submit"]').click(function(){
			// alert('aa');
			$("#f_submit").trigger( "click" );
		});
		

	});
</script>
@endsection