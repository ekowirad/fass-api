<?php

namespace App\Http\Resources;

use App\OrderLabor;
use App\Http\Resources\LaborLite as LaborLiteResource;
use App\Http\Resources\OrderAddons as OrderAddonsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderLabor as OrderLaborResource;


class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'note_id' => $this->note_id,
            'name' => $this->name,
            'handphone' => $this->handphone,
            'address' => $this->address,
            'time_type' => $this->time_type,

            'day_start' => $this->day_start,
            'day_end' => $this->day_end,
            'day_cost' => $this->day_cost,

            'hour_date' => $this->hour_date,
            'hour_start' => $this->hour_start,
            'hour_end' => $this->hour_end,
            'hour_cost' => $this->hour_cost,

            'revenue_id' => $this->revenue_id,
            'admin_cost' => $this->admin_cost,
            'salary_cut' => $this->salary_cut,
            'total_cost' => $this->total_cost,
            'addons_costs' => OrderAddonsResource::collection($this->addons_cost),

            'labor ' => new LaborLiteResource($this->labor),
            'order_labor' => new OrderLaborResource($this->order_labor),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
