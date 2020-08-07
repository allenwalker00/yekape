<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KavlingStatus extends Model
{
    protected $table = 'kavling_status';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // public function keperluan(){
    //     return $this->belongsTo('App\Models\MasterKeperluan', 'id_keperluan', 'id');
    // }
}
