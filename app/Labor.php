<?php

namespace App;

use App\Job;
use App\Ethnic;
use App\Carrier;
use App\Regency;
use App\District;
use App\Province;
use Illuminate\Database\Eloquent\Model;


class Labor extends Model
{
    protected $fillable = [
        'name','register_id','ktp_id','birth_place','birth_date','age','ethnic','education','religion','marital_status','handphone','district','regency','province','address','skills','job_id'
    ];

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function carrier(){
        return $this->hasMany(Carrier::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
    public function regency(){
        return $this->belongsTo(Regency::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function ethnic(){
        return $this->belongsTo(Ethnic::class);
    }


}
