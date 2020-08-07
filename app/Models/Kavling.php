<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kavling extends Model
{
    protected $table = 'kavling';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function kavlingstatus(){
        return $this->belongsTo('App\Models\KavlingStatus', 'status', 'id');
    }
}
