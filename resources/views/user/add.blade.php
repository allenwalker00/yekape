@extends('layout')
@section('title')
	Add User | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    <b>Manajemen</b> - Add User
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
                                    <b>Manajemen</b> - Add User
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
                                <form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('data-user-post')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Tipe User</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="tipe">
                                                <option value="dosen">Dosen</option>
                                                <option value="mahasiswa">Mahasiswa</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Mahasiswa</label><br>
                                        <div class="col-md-8">
                                            <select class="form-control m-select2 m-input--air" name="mahasiswa" id="mhs_select" required="">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Dosen</label><br>
                                        <div class="col-md-8">
                                            <select class="form-control m-select2 m-input--air" name="dosen" id="dosen_select" required="">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Nama</label>
                                        <div class="col-md-8">
                                            <input class="form-control m-input m-input--air" required name="nama" type="text" placeholder="nama lengkap"/>
                                        </div>
                                    </div>

                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Username</label>
                                        <div class="col-md-8">
                                            <input class="form-control m-input m-input--air" required name="username" type="text" placeholder="username login"/>
                                        </div>
                                    </div>
                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Role Petugas</label><br>
                                        <div class="col-md-8">
                                            <select class="form-control m-select2 m-input--air" name="roles[]" multiple="multiple" id="roles_select" required="">
                                                @foreach($roles as $row)
                                                    <option value="{{$row->id}}" kode="{{$row->kode}}" >{{$row->role}}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block" style="color:red">{{$errors->first('role')}}</span>
                                        </div>
                                    </div>

                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Password</label>
                                        <div class="col-md-8">
                                            <input class="form-control m-input m-input--air" required name="password"  type="password" placeholder="password"/>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">&nbsp;</label>
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <a href="{{redirect()->back()}}"><button type="button" id="kembali" class="btn btn-secondary">Kembali</button></a>
                                        </div>
                                    </div>
                                    
                                </form>
                                
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
<style type="text/css">
	.modal-lg {
	    max-width: 75%;
	}
</style>
@endsection
@section('js')
<!--begin::Page Vendors -->
<script src="{{asset('assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<!--begin::Page Resources -->
<script src="{{asset('assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $('#roles_select').select2({
        placeholder: 'Tentukan Role User...',
        width: 'resolve',
        multiple:true,
    });
    $("#mhs_select").select2({
        placeholder: "Search for Mahasiswa",
        allowClear: true,
        minimumInputLength: 3,
        ajax: {
            url: "{{route('carimahasiswa-json')}}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nim + ' - ' + item.nama,
                            id: item.nim
                        }
                    }),
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        }
    });
    $("#dosen_select").select2({
        placeholder: "Search for Dosen",
        allowClear: true,
        minimumInputLength: 3,
        ajax: {
            url: "{{route('caridosen-json')}}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nip + ' - ' + item.nama,
                            id: item.nim
                        }
                    }),
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        }
    });
    


</script>
@endsection