<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class OrderLabor extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'sex', 'religion', 'education', 'marital_status', 'speak_english', 'dog_fear', 'age', 'skills', 'time_type', 'price', 'job_id', 'ethnic_id', 'order_id'
    ];

      public function order(){
        return $this->belongsTo(Order::class);
    }
}
