<?php

namespace App;

use App\Revenue;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{

    public function revenue(){
        $this->belongsTo(Revenue::class);
    }
}
