<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'recid';
    public $timestamps = false;

    public function transaksi(){
        return $this->belongsTo('App\Models\Transaksi', 'id_transaksi', 'id_transaksi');
    }

    public function seleb(){
        return $this->belongsTo('App\Models\Seleb', 'id_seleb', 'id_seleb');
    }

     public function payment(){
        return $this->hasMany('App\Models\TransaksiPayment', 'recid_transaksi', 'recid');
    }
}
