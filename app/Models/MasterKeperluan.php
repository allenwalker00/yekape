<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterKeperluan extends Model
{
    protected $table = 'm_keperluan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // public function keperluan(){
    //     return $this->belongsTo('App\Models\MasterKeperluan', 'id_seleb', 'id_seleb');
    // }
}
