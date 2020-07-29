@extends('layout')
@section('title')
	Edit Kategori User | {{env('APP_NAME')}}
@endsection
@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Manage Role Menu </h3>
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
            <div class="col-md-6 col-sm-12">
                <div class="kt-portlet kt-portlet--mobile" id="data">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="la la-calendar kt-font-success"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                <span>
                                    Manage Role Menu
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
                                @if(Session::has('status'))
                                    <div class="alert alert-{{Session::get('alert')}}" role="alert">
                                        {{Session::get('status')}}
                                    </div>
                                @endif
                                <form class="kt-form kt-form--fit kt-form--label-align-right" method="post" action="{{route('data-user-post-edit')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="id" value="{{$role->id}}">

                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Role</label>
                                        <div class="col-md-8">
                                            <input class="form-control kt-input kt-input--air" disabled="" name="role" type="text" placeholder="Kategori User / Role" value="{{$role->role}}" />
                                        </div>
                                    </div>
                                    <div class="form-group kt-form__group row">
                                        <label class="col-form-label col-md-2">Tambah Menu</label><br>
                                        <div class="col-md-8">
                                            <select class="form-control m-select2 kt-input--air" id="menus">
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
                                                                <option value="{{$row->id}}||{{$subhead->id}}"> - {{$subhead->nama}}</option>
                                                                @foreach($sub_menu as $subrow)
                                                                    @if(substr($subhead->urut,0,2) == substr($subrow->urut,0,2))
                                                                        <option value="{{$subhead->id}}||{{$subrow->id}}">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$subrow->nama}}</option>
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
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="kt-portlet kt-portlet--mobile" id="data">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="la la-calendar kt-font-success"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                <span>
                                    Menu Setiap Role
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
                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('data-role-post-edit')}}">


                    <!-- additional -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="kt-portlet__body">
                            <div class="kt-section" id="data-prodi">
                                <div class="kt-section__content">
                                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="m-alert__icon">
                                        <i class="flaticon-exclamation-1"></i>
                                        <span></span>
                                    </div>
                                    <div class="m-alert__text">
                                        <strong>
                                            Warning!
                                        </strong>
                                        Tidak akan terinput double !!
                                    </div>
                                    <div class="m-alert__close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                                <input type="text" value="{{$role->id}}" hidden name="role"/>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td align="center">Menu</td>
                                            <td align="center">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody id="table_menu">
                                        @foreach($role->menus as $row)
                                            <tr>
                                                <td>{{$row->nama}}</td>
                                                @if($row->tipe == 1)
                                                    <td align="center">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('dataroleheadmenus-del' , ['role' => $role->id, 'menu' => $row->id]) }}"
                                                        onClick="return confirm(' Apakah anda yakin akan menghapus data ini ?? Menghapus menu header berarti anda akan menghapus semua sub menu nya !!')">
                                                        Hapus Menu Utama</a>
                                                    </td>
                                                @elseif($row->tipe == 3)
                                                    <td align="center">
                                                        <a class="btn btn-warning btn-sm m--font-light" href="{{route('datarolesubheadmenus-del' ,['role' => $role->id, 'menu' => $row->id] )}}" 
                                                        onClick="return confirm(' Apakah anda yakin akan menghapus data ini ?? Menghapus menu header berarti anda akan menghapus semua sub menu nya !!')">
                                                        Hapus Sub Menu Utama</a>
                                                    </td>
                                                @else
                                                    <td align="center"><a href="{{route('datarolemenus-del' , ['role' => $role->id, 'menu' => $row->id])}}"  class="btn btn-danger"
                                                    onClick="return confirm(\' Apakah anda yakin akan menghapus data ini ??\')"><i class="fa fa-times"></i></a></td>
                                                @endif
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="kt-portlet__foot kt-portlet__foot--fit">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-warning kt--font-light">Submit</button>
                                <a href="{{URL::previous()}}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    <!--end::Form-->
                    </form>
                    
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
<script type="text/javascript">
    $('#menus').select2({
        placeholder: 'Tentukan Menu Setiap Role...',
        width: 'resolve',
        // multiple:true,
    });

    $("#menus").change(function(){
		var menu_id = $("#menus option:selected").val();
		var menu_name = $("#menus option:selected").text();
        var token = '{{ csrf_token() }}';
        
		
		$("#table_menu").append('<tr>'+
				'<td>'+menu_name+' <input hidden type="text" value="'+ menu_id +'" name="menus[]"/></td>'+
				'<td align="center"><a href="javascript:void(0)" class="btn btn-danger" onclick="del($(this).parent().parent())"><i class="fa fa-times"></i></a></td>'+
		'</tr>');


        // ajax menu
        // var submenuparent_id = menu_id.split("||");
            $.ajax({
                url: "{{route('get-childmenu')}}",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': token},
                data: {menu_id: menu_id},
                cache: false,
                success: function (result) {
                    console.log(result);
                    if(result.data.length > 0){
                        for(i=0 ; i < result.data.length; i++){
                            $("#table_menu").append('<tr>'+
                                    '<td>'+ result.data[i]['nama'] +' <input hidden type="text" value="'+ result.head +'||'+ result.data[i]['id'] +'" name="menus[]"/></td>'+
                                    '<td align="center"><a href="javascript:void(0)" class="btn btn-danger" onclick="del($(this).parent().parent())"><i class="fa fa-times"></i></a></td>'+
                            '</tr>');
                        }
                    }
                }
            });
	});

	function del(rm){
		var aa = confirm('Yakin menghapus data ini ?');
		if(aa){
			$(rm).remove();
		}else{
			return false;
		}
	}


</script>
@endsection