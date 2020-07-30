<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use DB;
use App\User;
use App\Models\Roles;
use App\Models\RolesUser;
use Hash;
use Auth;

class UserController extends Controller{
    
    public function index(){
        return view('user.index');
    }

    public function show(){
        $query = User::with('roles')->select('*');

        return Datatables::of($query)
                        ->addColumn('menu', function($model) {
                            $edit = '<a href="' . route("data-user-edit", ['id' => $model->id]) . '" class="btn btn-sm btn-warning m--font-light">Edit</a>';
                            $hapus = '<a onclick="return confirm(\'Apakah anda yakin untuk menghapus data ini ?\')"  href="'.route('data-user-delete', ['id' => $model->id]).'" class="btn btn-sm btn-danger">Hapus</a>';
                            $reset = '<a onclick="return confirm(\'Apakah anda yakin untuk reset password ?\')"  href="'.route('resetpassword', ['user' => $model->id]).'" class="btn btn-sm btn-info">Reset Password</a>';
                            return $edit.'&nbsp'.$reset .'&nbsp'.$hapus;
                        })
                        ->editColumn('roles', function($model) {
                            $ff = null;
                            foreach($model->roles as $role){
                                $ff .= '- '.$role->role.'<br>'; 
                            }
                            return $ff;
                        })
                        ->rawColumns(['menu','roles'])
                        ->make(true);
    }

    public function add(){
        $roles = Roles::all();
        return view('user.add', ['roles' => $roles]);
    }

    public function post(Request $request){

        // dd($request);

        DB::transaction(function() use ($request){
            $nama = $request->nama;
            $username = $request->username;
            $password = Hash::make($request->password);
            
            $user = new User();
            $user->nama = $nama;
            $user->username = $username;
            $user->password = $password;
            $user->tipe = $request->tipe;
            $user->remember_token = $request->_token;
            $user->doc = date('Y-m-d H:i:s');
            $user->save();

            foreach($request->roles as $row){
                $roles = new RolesUser();
                $roles->user_id = $user->id;
                $roles->role_id = $row;
                $roles->save();
            }
            
        });

        return redirect()->route('data-user')->with(array('status' => 'Data berhasil diinputkan / diperbarui', 'alert' => 'success'));
    }


    public function delete($id){
        DB::transaction(function() use ($id){
            User::find($id)->delete();
            RolesUser::where('user_id',$id)->delete();
        });
        return redirect()->route('data-user')->with(array('status' => 'Data berhasil dihapus', 'alert' => 'success'));
    }


    public function edit($id){
        $data = User::with('roles')
                    ->select('*')
                    ->where('id',$id)->first();

        $roles = Roles::whereHas('user',function($sql) use ($data){
                        $sql->where('username',$data->username);
                    },'=',0)->get();


        return view('user.edit', ['data' => $data,'roles' => $roles]);
    }

    public function post_edit(Request $request){

        DB::transaction(function() use ($request){
            $id = $request->id;
            $nama = $request->nama;
            $username = $request->username;
            
            $user = User::find($id);
            $user->nama = $nama;
            $user->username = $username;
            $user->save();

            foreach($request->roles as $row){

                $aa = RolesUser::where('user_id',$id)->where('role_id',$row)->first();
                if($aa == null){
                    $roles = new RolesUser();
                    $roles->user_id = $user->id;
                    $roles->role_id = $row;
                    $roles->save();
                }

            }
            RolesUser::where('user_id',$id)->whereNotIn('role_id',$request->roles)->delete();
            
        });

        return redirect()->route('data-user')->with(array('status1' => 'Data berhasil diinputkan / diperbarui', 'alert' => 'success'));
    }

    public function gantiPasswordSimpan(Request $temp){
        if(Hash::check($temp->old, Auth::user()->password)){
            $aa = User::find(Auth::user()->id);
            $aa->password = Hash::make($temp->baru);
            $aa->save();
            $st = 1;
        }else{
            $st = 9;
        }
        return redirect()->route('dashboard')->with('status', $st);
    }

    public function reset_password($user){
        $user = User::find($user);
        $user->password = Hash::make($user->username);
        $user->save();
        return redirect()->route('data-user')->with(array('status1' => 'Password berhasil direset sesuai dengan nip !!', 'alert' => 'warning'));
        // return redirect()->route('datapetugas-link')->with(array('status' => 'Password berhasil direset ke "12345" !!', 'alert' => 'warning')); 
    }
    
}
