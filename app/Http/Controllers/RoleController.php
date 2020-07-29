<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use DB;
use App\Models\Menus;
use App\Models\Roles;
use App\Models\MenusRoles;
use Hash;

class RoleController extends Controller{
    
    public function index(){
        return view('role.index');
    }

    public function show(){
        $query = Roles::with('menus')->select('*');

        return Datatables::of($query)
                        ->editColumn('role', function($model) {
                            $edit = '<a href="'.route("data-role-edit", ['id' => $model->id]).'"
                            class="btn btn-sm btn-primary margin-bottom-5" style="color:#fff;"><i class="fa fa-gears"></i> Setting</a>';

                            return $model->role.'<br>'.$edit;
                        })
                        ->addColumn('menu', function($model) {
                            $hapus = '<a onclick="return confirm(\'Apakah anda yakin untuk menghapus data ini ?\')"  href="'.route('data-user-delete', ['id' => $model->id]).'" class="btn btn-sm btn-danger">Hapus</a>';
                            return $hapus;
                        })
                        ->addColumn('menus', function($model) {
                            $ff = null;
                            foreach($model->menus as $menu){
                                $btn = '<a class="pull-right" href="Del-DataRoleMenus/role='.$model->id.'/menu='.$menu->id.'" onClick="return confirm(\' Apakah anda yakin akan menghapus data ini ??\')"><i class="fa fa-times text-danger"></i></a>';
                                $btn_header = '<a class="pull-right btn btn-primary btn-sm" href="Del-DataRoleHeadMenus/role='.$model->id.'/menu='.$menu->id.'" 
                                        onClick="return confirm(\' Apakah anda yakin akan menghapus data ini ?? Menghapus menu header berarti anda akan menghapus semua sub menu nya !!\')">
                                        Hard Delete</a>';
                                $btn_sub_header = '<a class="pull-right btn btn-warning btn-sm m--font-light" href="Del-DataRoleSubHeadMenus/role='.$model->id.'/menu='.$menu->id.'" 
                                        onClick="return confirm(\' Apakah anda yakin akan menghapus data ini ?? Menghapus menu header berarti anda akan menghapus semua sub menu nya !!\')">
                                        Sub Head Delete</a>';
                                
                                if($menu->tipe == 3){
                                    $ff .= '<br><b>'.$menu->nama.'</b>'.$btn_sub_header.'</br>';
                                }else if($menu->tipe == 1){
                                    $ff .= '<br><b>'.$menu->nama.'</b>'.$btn_header.'</br>';
                                }
                                else{
                                    $ff .= '<br>- '.$menu->nama.' '.$btn.'</br>'; 
                                }
                                
                            }
                            return $ff;
                        })
                        ->rawColumns(['menu','menus','role'])
                        ->make(true);
    }

    public function add(){
        $role = Roles::all();
        $head_menu = Menus::HeadMenu()->get();
        $sub_head = Menus::SubHead()->get();
        $subhead_menu = Menus::SubHeadMenu()->get();
        $sub_menu = Menus::SubMenu()->get();
        return view('role.add' , ['role' => $role,'head_menu' => $head_menu ,'sub_head' => $sub_head,'subhead_menu' => $subhead_menu,'sub_menu' =>$sub_menu]);
    
    }

    public function post(Request $request){

        DB::transaction(function() use ($request){
            $role = $request->role;
            $menu = $request->menus;


            $added_role = new Roles();
            $added_role->role = $role;
            $added_role->save();


            foreach($menu as $row){

                $aa = explode('||',$row);
                $head_menu = $aa[0];
                $sub_menu = $aa[1];

                // head menu
                $checking_data = MenusRoles::SingleMenuRole($added_role->id,$head_menu)->get();
                if(count($checking_data) == 0){
                    $data = new MenusRoles();
                    $data->menus_id = $head_menu;
                    $data->roles_id = $added_role->id;
                    $data->save();
                }

                // submenu
                $checking_data_ = MenusRoles::SingleMenuRole($added_role->id,$sub_menu)->get();
                if(count($checking_data_) == 0){
                    $data = new MenusRoles();
                    $data->menus_id = $sub_menu;
                    $data->roles_id = $added_role->id;
                    $data->save();
                }

            }  
        });

        return redirect()->route('data-role')->with(array('status' => 'Data berhasil diinputkan / diperbarui', 'alert' => 'success'));
    }

    public function post_edit(Request $request){

        DB::transaction(function() use ($request){
            $role = $request->role;
            $menu = $request->menus;

            foreach($menu as $row){

                $aa = explode('||',$row);
                $head_menu = $aa[0];
                $sub_menu = $aa[1];

                // head menu
                $checking_data = MenusRoles::SingleMenuRole($role,$head_menu)->get();
                if(count($checking_data) == 0){
                    $data = new MenusRoles();
                    $data->menus_id = $head_menu;
                    $data->roles_id = $role;
                    $data->save();
                }

                // submenu
                $checking_data_ = MenusRoles::SingleMenuRole($role,$sub_menu)->get();
                if(count($checking_data_) == 0){
                    $data = new MenusRoles();
                    $data->menus_id = $sub_menu;
                    $data->roles_id = $role;
                    $data->save();
                }

            }  
        });

        return redirect()->route('data-role')->with(array('status' => 'Data berhasil diinputkan / diperbarui', 'alert' => 'success'));
    }

    public function edit($id){
        // $data = Roles::with('menus')
        //             ->select('*')
        //             ->where('id',$id)->first();

        // $menus = Menus::whereHas('roles',function($sql) use ($data){
        //                 $sql->select(DB::raw('roles.id as srole_id'))->where('srole_id',$data->id);
        //             },'=',0)->get();

        $role = Roles::find($id);
        $head_menu = Menus::HeadMenu()->get();
        $sub_head = Menus::SubHead()->get();
        $subhead_menu = Menus::SubHeadMenu()->get();
        $sub_menu = Menus::SubMenu()->get();


        return view('role.edit' , ['role' => $role,'head_menu' => $head_menu ,'sub_head' => $sub_head,'subhead_menu' => $subhead_menu,'sub_menu' =>$sub_menu]);
    }

    public function del_dataroleallmenus($role){   
        $data = MenusRoles::RoleMenus($role)->delete();
        return redirect()->back()->with(array('status' => 'Berhasil menghapus semua menu terpilih', 'alert' => 'warning')); 
    }

    public function del_datarolemenus($role,$menu){   
        $data = MenusRoles::SingleMenuRole($role,$menu)->delete();
        return redirect()->back()->with(array('status' => 'Berhasil menghapus menu terpilih', 'alert' => 'warning')); 
    }

    public function del_dataroleheadmenus($role,$menu){
        DB::transaction(function() use ($role, &$menu){
            $data = MenusRoles::SingleMenuRole($role,$menu)->delete(); // delete single submenu
            $head_urut_menu = Menus::find($menu);
            $submenu = Menus::SelectSubMenu(substr($head_urut_menu->urut,0,1))->pluck('id');
            MenusRoles::where('roles_id',$role)->whereIn('menus_id',$submenu)->delete();
        });
        return redirect()->back()->with(array('status' => 'Berhasil menghapus head menu terpilih', 'alert' => 'success')); 
    }

    public function del_datarolesubheadmenus($role,$menu){
        DB::transaction(function() use ($role, &$menu){
            $data = MenusRoles::SingleMenuRole($role,$menu)->delete(); // delete single submenu
            $head_urut_menu = Menus::find($menu);
            $submenu = Menus::SelectSubMenu(substr($head_urut_menu->urut,0,2))->pluck('id');
            MenusRoles::where('roles_id',$role)->whereIn('menus_id',$submenu)->delete();
        });
        return redirect()->back()->with(array('status' => 'Berhasil menghapus sub head menu terpilih', 'alert' => 'success')); 
    }

    public function get_childmenu(Request $request){
        $aa = explode('||',$request->menu_id);
        $head_menu = $aa[0];
        $sub_menu = $aa[1];

        $data = Menus::find($sub_menu);
        $child = Menus::SelectSubMenu(substr($data->urut,0,2))->where('tipe',4)->get();
        return response()->json(['data' => $child , 'head' => $sub_menu]);
    }

}
