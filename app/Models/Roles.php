<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model {

    protected $table = 'roles';
    //protected $primaryKey = 'id';
    public $timestamps = false;

    public function user(){
        return $this->belongsToMany('App\User','roles_user','role_id','user_id');
    }

    public function menus(){
        return $this->belongsToMany('App\Models\Menus','menus_roles')->orderBy('urut','ASC');
    }

    public function roleuser() {
        return $this->hasMany('App\Models\RolesUser', 'role_id', 'id');
    }
    
}
