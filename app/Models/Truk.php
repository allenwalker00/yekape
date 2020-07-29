<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truk extends Model
{
    protected $table = 'm_truk';
    protected $primaryKey = 'id_truk';
    public $timestamps = false;

    public function transaksi(){
        return $this->hasMany('App\Models\Transaksi', 'id_truk', 'id_truk');
    }
}
