<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderPayment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'note_id' => $this->note_id,
            'name' => $this->name,
            'address' => $this->address,
            'handphone' => $this->handphone,
            'file' => asset("storage/user_upload/$this->file")
        ];

        // return parent::toArray($request);
    }
}
