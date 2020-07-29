<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasMuat extends Model
{
    protected $table = 'kas_muat';
    protected $primaryKey = 'id_kmuat';
    public $timestamps = false;

    public function transaksi(){
        return $this->belongsTo('App\Models\Transaksi', 'id_transaksi', 'id_transaksi');
    }

    public function kas(){
        return $this->belongsTo('App\Models\Kas', 'id_kmuat', 'id_kmuat');
    }

    public function muat(){
        return $this->belongsTo('App\Models\Muat', 'id_muat', 'id_muat');
    }
}
