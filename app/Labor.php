<?php

namespace App;

use App\Job;
use App\Order;
use App\Ethnic;
use App\Status;
use App\Carrier;
use App\Regency;
use App\District;
use App\Province;
use App\LaborFile;
use Illuminate\Database\Eloquent\Model;


class Labor extends Model
{
    protected $fillable = [
        'name','register_id','ktp_id','birth_place','birth_date','age','ethnic','education','religion','marital_status','handphone','district','regency','province','address','skills','job_id','mother_name','mother_job','father_name','father_job','fam_name','fam_handphone','ref_name','ref_handphone','weight','height','skin','hair','price_month','price_day','price_hour'
    ];

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function laborFile(){
        return $this->hasMany(LaborFile::class);
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

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }


}
