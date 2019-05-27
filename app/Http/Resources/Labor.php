<?php

namespace App\Http\Resources;

use App\Http\Resources\Carrier as CarrierRescource;
use Illuminate\Http\Resources\Json\JsonResource;

class Labor extends JsonResource
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
            'ktp_id' => $this->ktp_id,
            'register_id' => $this->register_id,
            'name' => $this->name,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date,
            'education' => $this->education,
            'religion' => $this->religion,
            'ethnic' => $this->ethnic,
            'job_id' => $this->job_id,
            'marital_status' => $this->marital_status,
            'skills' => explode(",", $this->skills),
            'address' => $this->address,
            'handphone' => $this->handphone,
            'carrier' => CarrierRescource::collection($this->carrier)

        ];
    }
}
