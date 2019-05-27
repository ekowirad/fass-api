<?php

namespace App;

use App\Labor;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    //disable timestamp 'created_at' and 'updated_at'
    public $timestamps = false;

    protected $fillable = [
        'name','start','end'
    ];

    public function labor(){
        return $this->belongsTo(Labor::class);
    }
}
