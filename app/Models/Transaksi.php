<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    public function truk(){
        return $this->belongsTo('App\Models\Truk', 'id_truk', 'id_truk');
    }

    public function gudang(){
        return $this->belongsTo('App\Models\Gudang', 'id_gudang', 'id_gudang');
    }

    public function saldo(){
        return $this->belongsTo('App\Models\Saldo', 'id_transaksi', 'id_transaksi');
    }

    public function detail(){
        return $this->hasMany('App\Models\TransaksiDetail', 'id_transaksi', 'id_transaksi');
    }

    public function seleb(){
        return $this->belongsTo('App\Models\Seleb', 'id_seleb_piutang', 'id_seleb');
    }
}
