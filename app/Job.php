<?php

namespace App;

use App\Labor;
use App\OrderLabor;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'code'
    ];

    public function labor(){
        return $this->hasMany(Labor::class);
    }

}
