<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderLabor extends JsonResource
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
            'sex' => $this->note_id,
            'religion' => $this->name,
            'education' => $this->handphone,
            'marital_status' => $this->address,
            'speak_english' => $this->speak_english,
            'dog_fear' => $this->dog_fear,
            'age' => json_decode($this->age),
            'skills' => json_decode($this->skills),
            'ethnic_id' => $this->ethnic_id,
            'job_id' => $this->job_id,
            'time_type' => $this->time_type,
            'price' => json_decode($this->price),
        ];
    }
}
