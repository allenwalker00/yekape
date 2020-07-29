<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model {

    protected $table = 'menus';
    //protected $primaryKey = 'id';
    public $timestamps = false;

    public function scopeHeadMenu($query){
        $query->where('tipe',1)->orderBy('urut','ASC');
    }

    public function scopeSubHead($query){
        $query->where('tipe',2)->orderBy('urut','ASC');
    }

    public function scopeSubHeadMenu($query){
        $query->where('tipe',3)->orderBy('urut','ASC');
    }

    public function scopeSubMenu($query){
        $query->where('tipe',4)->orderBy('urut','ASC');
    }

    public function scopeSelectSubMenu($query,$menu_urut){
        $query->where('urut','LIKE',$menu_urut.'%')->orderBy('urut','ASC');
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Roles','menus_roles');
    }
    
}
