<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $fillable = [
        'name','note_id','handphone','address','file'
    ];

      public function order(){
        return $this->belongsTo(Order::class);
    }
}
