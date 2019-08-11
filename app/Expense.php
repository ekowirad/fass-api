<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'name', 'nominal', 'revenue_id'
    ];

    public function revenue(){
      return  $this->belongsTo(Revenue::class);
    }
}
