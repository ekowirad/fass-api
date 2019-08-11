<?php

namespace App;

use App\Labor;
use App\Order;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'name', 'type'
    ];

    public function labor(){
        return $this->hasMany(Labor::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
    //
}
