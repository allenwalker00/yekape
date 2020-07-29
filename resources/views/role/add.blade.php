@extends('layout')
@section('title')
	Add Kategori User | {{env('APP_NAME')}}
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    <b>Role</b> - Add Kategori User
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
                                    <b>Role</b> - Add Kategori User
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
                                <form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('data-role-post')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Role</label>
                                        <div class="col-md-8">
                                            <input class="form-control kt-input kt-input--air" required name="role" type="text" placeholder="kategori user" />
                                        </div>
                                    </div>


                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Menus</label><br>
                                        <div class="col-md-8">
                                            <select class="form-control m-select2 kt-input--air" name="menus[]" multiple="multiple" id="roles_select" required="">
                                                <option value="">Pilih Menu</option>
                                                @foreach($head_menu as $row)
                                                    <optgroup label="{{$row->nama}}">
                                                    <!-- untuk menu tanpa submenu -->
                                                    @foreach($sub_head as $sh)
                                                        @if(substr($row->urut,0,1) == substr($sh->urut,0,1))
                                                            <option value="{{$row->id}}||{{$sh->id}}">{{$sh->nama}}</option>
                                                        @endif
                                                    @endforeach
                                                    <!-- end untuk menu tanpa submenu -->
                                                    <!-- start head sub menu -->
                                                    @foreach($subhead_menu as $subhead)
                                                        <!-- <option value="{{$row->id}}||{{$subhead->id}}"><b>{{$subhead->nama}}</b></option> -->
                                                        @if(substr($row->urut,0,1) == substr($subhead->urut,0,1))
                                                            <option value="{{$row->id}}||{{$subhead->id}}">- {{$subhead->nama}}</option>
                                                            @foreach($sub_menu as $subrow)
                                                                @if(substr($subhead->urut,0,2) == substr($subrow->urut,0,2))
                                                                    <option value="{{$subhead->id}}||{{$subrow->id}}">&nbsp&nbsp&nbsp{{$subrow->nama}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <!-- end of head sub menu -->
                                                    </optgroup>
                                                @endforeach
                                            </select>
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
<script src="{{asset('assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<!--begin::Page Resources -->
<script type="text/javascript">
    $('#roles_select').select2({
        placeholder: 'Tentukan Menu Setiap Role...',
        width: 'resolve',
        multiple:true,
    });

</script>
@endsection