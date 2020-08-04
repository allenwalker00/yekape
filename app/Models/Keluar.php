<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table = 'keluar_rutin';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function keperluan(){
        return $this->belongsTo('App\Models\MasterKeperluan', 'id_keperluan', 'id');
    }
}
