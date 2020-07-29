<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bongkar extends Model
{
    protected $table = 'b_detailbongkar';
    protected $primaryKey = 'id_bongkar';
    public $timestamps = false;

    public function transaksi(){
        return $this->belongsTo('App\Models\Transaksi', 'id_transaksi', 'id_transaksi');
    }

    public function gudang(){
        return $this->belongsTo('App\Models\Gudang', 'id_gudang', 'id_gudang');
    }
}
