<?php

namespace App\Http\Resources;

use App\LaborFile;
use App\Http\Resources\LaborFile as LaborFileRescource;
use Illuminate\Http\Resources\Json\JsonResource;

class LaborLite extends JsonResource
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
            // 'status' => $this->status,
            'register_id' => $this->register_id,
            'name' => $this->name,
            'sex' => $this->sex,
            'age' => $this->age,
            'job_id' => $this->job_id,
            // 'skills' => explode(",", $this->skills),
            // 'dog_fear' => $this->dog_fear === '1' ? true:false,
            // 'speak_english' => $this->speak_english === '1' ? true:false,
            // 'dorm_stay' => $this->dorm_stay === '1' ? true:false,
            // 'handphone' => $this->handphone,
            // 'address' => $this->address,
            // 'price_month' => $this->price_month,
            // 'price_day' => $this->price_day,
            // 'price_hour' => $this->price_hour,
            // 'profil_pic' => new LaborFileRescource($this->profilPic($this->laborFile)),
        ];
    }

    // get profile pic from labor file
    public function profilPic($arr)
    {
        if (sizeof($arr) != 0) {
            foreach ($arr as $key => $value) {
                if ($value['type'] == 'profile_pic') {
                    $laborFile = new LaborFile;
                    $laborFile->name = $value['name'];
                    $laborFile->type = $value['type'];
                    $laborFile->id = $value['id'];
                    $laborFile->labor_id = $value['labor_id'];
                }
            }
            return $laborFile;
        }
    }
}
