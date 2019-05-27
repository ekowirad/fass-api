<?php

namespace App;

use App\Labor;
use Illuminate\Database\Eloquent\Model;

class Ethnic extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function labor(){
        return $this->hasMany(Labor::class);
    }
}
