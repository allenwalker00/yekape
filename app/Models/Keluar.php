<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table = 'keluar_rutin';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // public function kaspiutang(){
    //     return $this->hasMany('App\Models\KasPiutang', 'id_seleb', 'id_seleb');
    // }

    // public function muat(){
    //     return $this->hasMany('App\Models\Muat', 'id_seleb', 'id_seleb');
    // }
}
