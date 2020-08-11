<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // public function kavlingstatus(){
    //     return $this->belongsTo('App\Models\KavlingStatus', 'status', 'id');
    // }
}
