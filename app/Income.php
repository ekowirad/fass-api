<?php

namespace App;

use App\Revenue;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'name', 'nominal', 'revenue_id'
    ];

    public function revenue(){
      return  $this->belongsTo(Revenue::class);
    }
}
