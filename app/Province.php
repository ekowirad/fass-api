<?php

namespace App;

use App\Labor;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function labor(){
        return $this->hasMany(Labor::class);
    }

}
