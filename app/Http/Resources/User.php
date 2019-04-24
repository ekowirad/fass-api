<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'api_token' => $this->api_token,
            'phone' => $this->phone,
            'address' => $this->address,
            'email' => $this->email,
            'role' => $this->role,
            'created_at' => $this->created_at
        ];
    }
}
