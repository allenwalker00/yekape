<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muat extends Model
{
    protected $table = 'b_detailmuat';
    protected $primaryKey = 'id_muat';
    public $timestamps = false;

    public function seleb(){
        return $this->belongsTo('App\Models\Seleb', 'id_seleb', 'id_seleb');
    }

    public function transaksi(){
        return $this->hasOne('App\Models\Transaksi', 'id_transaksi', 'id_transaksi');
    }

    public function kasmuat(){
        return $this->hasOne('App\Models\KasMuat', 'id_muat', 'id_muat');
    }
}
