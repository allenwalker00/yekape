<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'kas_transaksi';
    protected $primaryKey = 'id_kas';
    public $timestamps = false;

    // public function transaksi(){
    //     return $this->belongsTo('App\Models\Transaksi', 'id_transaksi', 'id_transaksi');
    // }

    // public function muat(){
    //     return $this->belongsTo('App\Models\Muat', 'id_muat', 'id_muat');
    // }

    // public function bongkar(){
    //     return $this->belongsTo('App\Models\Bongkar', 'id_bongkar', 'id_bongkar');
    // }

    public function saldo(){
        return $this->belongsTo('App\Models\Saldo', 'id_kas', 'id_kas');
    }

    public function kaslain(){
        return $this->belongsTo('App\Models\KasLain', 'id_klain', 'id_klain');
    }

    public function kaspiutang(){
        return $this->belongsTo('App\Models\KasPiutang', 'id_kpiutang', 'id_kpiutang');
    }

    public function kasmuat(){
        return $this->belongsTo('App\Models\KasMuat', 'id_kmuat', 'id_kmuat');
    }

    public function kasbongkar(){
        return $this->belongsTo('App\Models\KasBongkar', 'id_kbongkar', 'id_kbongkar');
    }
}
