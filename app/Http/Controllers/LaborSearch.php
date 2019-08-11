<?php

namespace App\Http\Controllers;

use App\Labor;
use Illuminate\Http\Request;
use Mockery\Undefined;

class LaborSearch extends Controller
{
    public static function filter(Request $request)
    {
        $labor = (new Labor)->newQuery();

        // personal filter
        if ($request->has('searchbox')) {
            $labor->where('name', 'like', "%$request->searchbox%")
                ->orWhere('register_id', 'like', "%$request->searchbox%");
        }

        if ($request->has('ethnic_id')) {
            $labor->where('ethnic_id', $request->ethnic_id);
            // $labor->whereHas(
            //     'ethnic',
            //     function ($query) use ($request) {
            //         $query->where('name', $request->ethnic);
            //     }
            // );
        }

        if ($request->has('sex')) {
            $labor->where('sex', $request->sex);
        }
        if ($request->has('education')) {
            $labor->where('education', $request->education);
        }

        if ($request->has('marital_status')) {
            $labor->where('marital_status', $request->marital_status);
        }

        if ($request->has('status')) {
            $labor->where('status', $request->status);
        }

        if ($request->has('religion')) {
            $labor->where('religion', $request->religion);
        }

        if ($request->has('age')) {
            if ($request->age != null) {
                // $min = $labor->age['min'] == null? 0 : $labor->age['min'];
                // $max = $labor->age['max'] == null? 0 : $labor->age['max'];
                $labor->where('age', '>=', $request->age[0])->where('age', '<=', $request->age[1]);
            }
        }

        // Job filter
        if ($request->has('job_id')) {
            $labor->where('job_id', $request->job_id);
            // $labor->whereHas(
            //     'job',
            //     function ($query) use ($request) {
            //         $query->where('name', $request->job);
            //     }
            // );
        }

        if ($request->has('dog_fear')) {
            $dog_fear = $request->dog_fear == true ? 1 : 0;
            if ($dog_fear != 0) {
                $labor->where('dog_fear', $dog_fear);
            }
        }
        if ($request->has('speak_english')) {
            $speak_english = $request->speak_english == true ? 1 : 0;
            if ($speak_english != 0) {
                $labor->where('speak_english', $speak_english);
            }
        }

        if ($request->has('price')) {
            if ($request->price != null) {
                if ($request->price['min'] != 0) {
                    $labor->where($request->price['type'], '>=', $request->price['min']);
                }
                if ($request->price['max'] != 0) {
                    $labor->where($request->price['type'], '<=', $request->price['max']);
                }
            }
        }

        if ($request->has('skills')) {
            $skills = implode(",", $request->skills);
            $labor->where('skills', 'like', "%$skills%");
        }

        //locaation filter
        if ($request->has('district')) {
            $labor->whereHas(
                'district',
                function ($query) use ($request) {
                    $query->where('name', $request->district);
                }
            );
        }
        if ($request->has('regency')) {
            $labor->whereHas(
                'regency',
                function ($query) use ($request) {
                    $query->where('name', $request->regency);
                }
            );
        }
        if ($request->has('province')) {
            $labor->whereHas(
                'province',
                function ($query) use ($request) {
                    $query->where('name', $request->province);
                }
            );
        }

        return $labor->paginate(8);
    }
}
