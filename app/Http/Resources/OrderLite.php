<?php

namespace App\Http\Resources;

use App\Http\Resources\LaborLite as LaborLiteResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderLite extends JsonResource
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
            'address' => $this->address,
            'handphone' => $this->handphone,
            'time_type' => $this->time_type,
            // 'addons_cost' => json_decode($this->addons_cost),
            // 'admin_cost' => $this->admin_cost,
            // 'salary_cut' => $this->salary_cut,
            'total_cost' => $this->total_cost,
            'labor' => new LaborLiteResource($this->labor),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
