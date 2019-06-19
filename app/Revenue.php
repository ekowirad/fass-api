<?php

namespace App;

use App\User;
use App\Order;
use App\Income;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable = [
        'user_id'
    ];

    public function order(){
       return $this->hasMany(Order::class);
    }

    public function income(){
       return $this->hasMany(Income::class);

    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
