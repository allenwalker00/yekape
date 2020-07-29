<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasBongkar extends Model
{
    protected $table = 'kas_bongkar';
    protected $primaryKey = 'id_kbongkar';
    public $timestamps = false;

    public function transaksi(){
        return $this->belongsTo('App\Models\Transaksi', 'id_transaksi', 'id_transaksi');
    }

    public function bongkar(){
        return $this->belongsTo('App\Models\Bongkar', 'id_bongkar', 'id_bongkar');
    }

    public function kas(){
        return $this->belongsTo('App\Models\Kas', 'id_kbongkar', 'id_kbongkar');
    }
}
