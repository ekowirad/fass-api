<?php

namespace App;

use App\Labor;
use App\Status;
use App\Revenue;
use App\AddonsCost;
use App\OrderLabor;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'note_id', 'name', 'handphone', 'address', 'time_type', 'day_start', 'day_end', 'hour_date', 'hour_start', 'hour_end', 'addons_cost', 'status', 'labor_id', 'order_labor_id', 'revenue_id', 'admin_cost', 'salary_cut', 'total_cost'
    ];

    public function revenue()
    {
        return $this->belongsTo(Revenue::class);
    }

    public function labor()
    {
        return $this->belongsTo(Labor::class);
    }

    public function addons_cost()
    {
        return $this->hasMany(AddonsCost::class);
    }

    public function order_labor()
    {
        return $this->hasOne(OrderLabor::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
