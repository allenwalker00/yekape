<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seleb extends Model
{
    protected $table = 'm_seleb';
    protected $primaryKey = 'id_seleb';
    public $timestamps = false;

    public function kaspiutang(){
        return $this->hasMany('App\Models\KasPiutang', 'id_seleb', 'id_seleb');
    }

    public function muat(){
        return $this->hasMany('App\Models\Muat', 'id_seleb', 'id_seleb');
    }
}
