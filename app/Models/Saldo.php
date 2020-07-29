<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $table = 'm_saldo';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function trans(){
        return $this->belongsTo('App\Models\Transaksi', 'id_transaksi', 'id_transaksi');
    }
}
