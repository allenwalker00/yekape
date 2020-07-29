@extends('layout')
@section('title')
	User Manajemen | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					<b>User</b> - Manajemen </h3>
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
				<div class="kt-portlet kt-portlet--mobile" id="data">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="la la-calendar kt-font-success"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								<span>
									<b>User</b> - Manajemen
								</span>
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section" id="data-prodi">
							<div class="kt-section__content">
								<a href="{{route('data-user-add')}}" class="btn btn-warning kt--font-light">Add User</a> <br><br>
                                @if(Session::has('status1'))
                                <div class="form-group kt-form__group kt--margin-top-10">
                                    <div class="alert alert-{{Session::get('alert')}}" role="alert">
                                        {{Session::get('status1')}}
                                    </div>
                                </div>
                                @endif

								<table class="table table-striped- table-bordered table-hover responsive" id="tabel">
									<thead>
										<tr>
											<th>username</th>
                                            <th>Nama</th>
                                            <th width="20%">Role</th>
											<th style="text-align:center">Menu</th>
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
			</div>
		</div>
		<!--end::Portlet-->
	</div>
	<!-- end:: Content -->
</div>
@endsection
@section('css')
<link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
	.modal-lg {
	    max-width: 75%;
	}
</style>
@endsection
@section('js')
<!--begin::Page Vendors -->
<script src="{{asset('assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script type="text/javascript">

    $('#tabel').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('data-user-show') }}",
        "columns": [
            {data: 'username', orderable: true, searchable: true ,},
            {data: 'nama',orderable: true, searchable: true},
            {data: 'roles',orderable: false, searchable: false},
            {data: 'menu', orderable: false, searchable: false , class: 'text-center'}
        ]
    });

</script>
@endsection