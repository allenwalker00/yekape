<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPayment extends Model
{
    protected $table = 'transaksi_payment';
    protected $primaryKey = 'recid';
    public $timestamps = false;

    public function detail(){
        return $this->belongsTo('App\Models\TransaksiDetail', 'recid_transaksi', 'recid');
    }
}
