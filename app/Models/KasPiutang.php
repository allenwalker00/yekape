<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasPiutang extends Model
{
    protected $table = 'kas_piutang';
    protected $primaryKey = 'id_kpiutang';
    public $timestamps = false;

    public function kas(){
        return $this->belongsTo('App\Models\Kas', 'id_kpiutang', 'id_kpiutang');
    }

    public function seleb(){
        return $this->belongsTo('App\Models\Seleb', 'id_seleb', 'id_seleb');
    }
}
