<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasLain extends Model
{
    protected $table = 'kas_lain';
    protected $primaryKey = 'id_klain';
    public $timestamps = false;

    public function kas(){
        return $this->belongsTo('App\Models\Kas', 'id_klain', 'id_klain');
    }
}
