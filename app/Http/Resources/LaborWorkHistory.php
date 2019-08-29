<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LaborWorkHistory extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
