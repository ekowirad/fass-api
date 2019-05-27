<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Labor;

class Job extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function labor(){
        return $this->hasMany(Labor::class);
    }
}
