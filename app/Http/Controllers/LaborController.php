<?php

namespace App\Http\Controllers;

use App\Job;
use App\Labor;
use App\Ethnic;
use App\Carrier;
use App\Regency;
use App\District;
use App\Province;
use App\LaborFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\LaborSearch;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Labor as LaborResource;

class LaborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = Input::get('type');
        $allLabor = Labor::with(['carrier', 'job', 'laborFile'])->where('status', '!=', 6)->orderBy('created_at', 'desc')->paginate(8);

        if ($type == 'available') {
            $labor = Labor::with(['carrier', 'job', 'laborFile'])->where('status', 4)->orderBy('created_at', 'desc')->paginate(8);
            return LaborResource::collection($labor);
        } else {
            return LaborResource::collection($allLabor);
        }
    }

    public function indexPrt($id)
    {
        $type = Input::get('type');
        $labor = Labor::with(['carrier', 'job', 'laborFile',
        'order' => function($query){
            $query->where('status_id', 2)->orderBy('updated_at', 'desc');
        }])->where('job_id', $id)->orderBy('created_at', 'desc')->paginate(8);

        if ($type == 'size') {
            $size = Labor::where('job_id', $id)->count();
            return response()->json(['size' => $size], 200);
        } else {
            return LaborResource::collection($labor);
        }
    }


    public function store(Request $request)
    {
        $labor = $request->isMethod('put') ? Labor::findOrFail($request->id) : new Labor;
        $job = Job::find($request->job_id);
        $district = District::find($request->district_id);
        $regency = Regency::find($request->regency_id);
        $province = Province::find($request->province_id);
        $ethnic = Ethnic::find($request->ethnic_id);

        //labor personal data
        $labor->name = $request->name;
        $labor->ktp_id = $request->ktp_id;
        $labor->register_id = "";
        $labor->birth_place = $request->birth_place;
        $labor->birth_date = $request->birth_date;
        $labor->sex = $request->sex;
        $labor->education = $request->education;
        $labor->religion = $request->religion;
        $labor->marital_status = $request->marital_status;
        $labor->handphone = $request->handphone;
        $labor->address = $request->address;
        $labor->skills = implode(",", $request['skills']);
        $labor->age = $this->ageLabor($request->birth_date);
        $labor->status = $request->status;
        $labor->dog_fear = $request->dog_fear == null ? 0 : $request->dog_fear;
        $labor->speak_english = $request->speak_english == null ? 0 : $request->speak_english;
        $labor->address_now = $request->address_now;

        //labor additional data
        $labor->mother_name = $request->mother_name;
        $labor->mother_job = $request->mother_job;
        $labor->father_name = $request->father_name;
        $labor->father_job = $request->father_job;
        $labor->fam_name = $request->fam_name;
        $labor->fam_handphone = $request->fam_handphone;
        $labor->ref_name = $request->ref_name;
        $labor->ref_handphone = $request->ref_handphone;
        $labor->weight = $request->weight;
        $labor->height = $request->height;
        $labor->hair = $request->hair;
        $labor->skin = $request->skin;
        $labor->price_month = $request->price_month;
        $labor->price_day = $request->price_day;
        $labor->price_hour = $request->price_hour;


        $labor->job()->associate($job);
        $labor->district()->associate($district);
        $labor->regency()->associate($regency);
        $labor->province()->associate($province);
        $labor->ethnic()->associate($ethnic);
        $labor->save();

        $labor->register_id = "{$job->code}{$labor->id}";
        $labor->save();
        if ($request->has('carriers')) {
            // $this->storeCarrier($labor, $request);
        }


        return response()->json(['message' => 'success', 'data' => $labor]);
    }

    //checking labor age
    private function ageLabor(String $date)
    {
        $yearNow = intval(date('Y'));
        $yearLabor = intval(date('Y', strtotime($date)));

        $laborAge = $yearNow - $yearLabor;
        return $laborAge;
    }

    public function search(Request $request)
    {
        return LaborResource::collection(LaborSearch::filter($request));
    }

    // store labor files
    public function storeImage(Request $request)
    {
        $valid = false;
        // upload profile picture
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $type = 'profile_pic';
            $laborFile = LaborFile::where([['type', '=', $type], ['labor_id', '=', $request->labor_id]])->first()
                ? LaborFile::where([
                    ['type', '=', $type],
                    ['labor_id', '=', $request->labor_id]
                ])->firstOrFail() : new LaborFile;

            $laborFile->type = $type;
            $laborFile->name = $request->labor_id . '_' . $type . '.' . $image->getClientOriginalExtension();
            $laborFile->labor()->associate($request->labor_id)->save();
            $image->storeAs('public/labor_upload', $laborFile->name);
            if ($laborFile->save()) {
                $valid = true;
            }
        }

        // upload labor requirement file, ex: ktp image, image 2x4, image 4x6, etc
        if ($request->hasFile('requirement_file')) {
            foreach ($request->file('requirement_file') as $key => $req_file) {
                $laborFiles = new LaborFile;
                $type = 'requirement_file';
                $laborFiles->name = $request->labor_id . '_' . $type . '_' . str_random(40) . '.' . $req_file->getClientOriginalExtension();
                $laborFiles->type = $type;
                $laborFiles->labor()->associate($request->labor_id)->save();
                $req_file->storeAs('public/labor_upload', $laborFiles->name);
                if ($laborFiles->save()) {
                    $valid = true;
                }
            }
        }

        // return this if theres no files given
        if ($valid) {
            return response()->json(['message' => 'upload success'], 200);
        } else {
            return response()->json(['message' => 'no files given'], 200);
        }
    }

    public function destroyImage($file_id)
    {
        $laborFile = LaborFile::findOrFail($file_id);
        Storage::delete('public/labor_upload/' . $laborFile->name);
        if ($laborFile->delete()) {
            return response()->json(['message' => 'delete success']);
        }
    }


    // store labor carriers
    public function storeCarrier(Request $request)
    {
        if ($request->isMethod('post')) {
            foreach ($request->carriers as $key => $data) {
                $carrier = new Carrier;
                $carrier->name = $data["name"];
                $carrier->start = $data["start"];
                $carrier->end = $data["end"];
                $carrier->labor()->associate($request->labor_id)->save();

                $newCarriers = array();
                array_push($newCarriers, $carrier);
            }

            return $newCarriers;
        }

        if ($request->isMethod('put')) {
            $carrier = Carrier::findOrFail($request->carrier_id);
            if ($carrier->delete()) {
                return response()->json(['message' => 'delete success']);
            }
        }


        // foreach ($request->carriers as $key => $data) {
        //     $carrier = $request->isMethod('put') ? Carrier::findOrFail($data["id"]) : new Carrier;

        // return new carrier
        // }

        // delete carrier
        // if ($request->isMethod('put')) {
        //do delete carrier when update only and req carrier size and db carrier size not equals
        //     $carriers = Carrier::where('labor_id', $request->labor_id)->get();
        //     if (sizeof($carriers) != sizeof($request->carriers)) {
        //         return  $this->deleteCarrier($request, $carriers);
        //     } else {
        //         return $carriers;
        //     }
        // } else {
        //     return $newCarriers;
        // }
    }

    public function deleteCarrier(Request $request, Carrier $carriers)
    {
        $carrierIdDB = array();
        $carrierIdReq = array();
        foreach ($carriers as $key => $value) {
            array_push($carrierIdDB, $value["id"]);
        }
        foreach ($request->carriers as $key => $value) {
            array_push($carrierIdReq, $value["id"]);
        }

        $ress = array_diff($carrierIdDB, $carrierIdReq);
        if (sizeof($ress) != 0) {
            foreach ($ress as $key => $value) {
                $carrier = Carrier::findOrFail($value);
                $carrier->delete();
            }
            $changeCarriers = Carrier::where('labor_id', $request->labor_id)->get();
            return $changeCarriers;
        }
    }

    public function show($id)
    {
        $labor = Labor::with(['carrier', 'job', 'laborFile'])->findOrFail($id);
        return new LaborResource($labor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
