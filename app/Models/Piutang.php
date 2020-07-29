<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    protected $table = 'kas_piutang';
    protected $primaryKey = 'id';
    public $timestamps = false;

     public function seleb(){
        return $this->belongsTo('App\Models\Seleb', 'id_seleb', 'id_seleb');
    }
}
