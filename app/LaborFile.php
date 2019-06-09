<?php

namespace App;

use App\Labor;
use Illuminate\Database\Eloquent\Model;

class LaborFile extends Model
{
    protected $fillable = [
        'name','type','labor_id'
    ];

    public function labor(){
        return $this->belongsTo(Labor::class);
    }
}
