<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenusRoles extends Model {

    protected $table = 'menus_roles';
    //protected $primaryKey = 'id';
    public $timestamps = false;

    public function scopeSingleMenuRole($query, $role, $menu){
        $query->where('roles_id',$role)->where('menus_id',$menu);
    }

    public function scopeRoleMenus($query, $role){
        $query->where('roles_id',$role);
    }
}
