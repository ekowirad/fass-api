<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Labor;
use App\Job;
use App\Carrier;
use App\District;
use App\Regency;
use App\Province;
use App\Http\Resources\Labor as LaborResource;
use App\Ethnic;

class LaborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $labor = Labor::with(['carrier', 'job'])->paginate(5);
        // return $labor;
        return LaborResource::collection($labor);
    }

    public function store(Request $request)
    {
        $labor = $request->isMethod('put')? Labor::findOrFail($request->id) : new Labor;
        $job = Job::find($request->job_id);
        $district = District::find($request->district_id);
        $regency = Regency::find($request->regency_id);
        $province = Province::find($request->province_id);
        $ethnic = Ethnic::find($request->ethnic_id);

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
        $labor->status = $request->status;
        $labor->dog_fear = $request->dog_fear;
        $labor->speak_english = $request->speak_english;


        $labor->job()->associate($job);
        $labor->district()->associate($district);
        $labor->regency()->associate($regency);
        $labor->province()->associate($province);
        $labor->ethnic()->associate($ethnic);
        $labor->save();


        $labor->register_id = "{$labor->job->code}{$labor->id}";
        $this->storeCarrier($request['carriers'], $labor, $request);

        return response()->json(['message' => 'success', 'data' => $labor]);
    }


    public function storeCarrier(Array $carriers,Labor $labor, Request $request)
    {
        $carrier;
        foreach ($carriers as $key => $data) {
            $carrier = $request->isMethod('put')? Carrier::findOrFail($data["id"]) : new Carrier;
            $carrier->name = $data["name"];
            $carrier->start = $data["start"];
            $carrier->end = $data["end"];
            $labor->carrier()->save($carrier);
            $carrier->labor()->associate($labor->id)->save();
            # code...
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
