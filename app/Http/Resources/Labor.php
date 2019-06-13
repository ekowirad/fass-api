<?php

namespace App\Http\Resources;

use App\Carrier;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Carrier as CarrierRescource;
use App\Http\Resources\LaborFile as LaborFileRescource;
use App\LaborFile;

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
            'mother_name' => $this->mother_name,
            'mother_job' => $this->mother_job,
            'father_name' => $this->father_name,
            'father_job' => $this->father_job,
            'fam_name' => $this->fam_name,
            'fam_handphone' => $this->fam_handphone,
            'ref_name' => $this->ref_name,
            'ref_handphone' => $this->ref_handphone,
            'weight' => $this->weight,
            'height' => $this->height,
            'hair' => $this->hair,
            'skin' => $this->skin,
            'price_month' => $this->price_month,
            'price_day' => $this->price_day,
            'price_hour' => $this->price_hour,
            'carriers' => CarrierRescource::collection($this->carrier),
            'profil_pic' => new LaborFileRescource($this->profilPic($this->laborFile)),
            'labor_files' => LaborFileRescource::collection($this->laborFile($this->laborFile)),
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

    public function laborFile($arr)
    {
        if (sizeof($arr) != 0) {
            foreach ($arr as $key => $value) {
                if ($value['type'] == 'profile_pic') {
                    unset($arr[$key]);
                }
            }
            // return $arr;
        }
        return $arr;

    }
}
