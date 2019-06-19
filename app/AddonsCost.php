<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class AddonsCost extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'cost', 'order_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    //
}
