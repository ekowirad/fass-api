<?php

namespace App\Http\Controllers;

use App\Labor;
use Illuminate\Http\Request;

class LaborSearch extends Controller
{
    public static function filter(Request $request)
    {
        $labor = (new Labor)->newQuery();

        // personal filter
        if ($request->has('searchbox')) {
            $labor->where('name', 'like', "%$request->name%")
                ->orWhere('register_id', 'like', "%$request->register_id%");
        }

        if ($request->has('ethnic')) {
            $labor->whereHas(
                'ethnic',
                function ($query) use ($request) {
                    $query->where('name', $request->ethnic);
                }
            );
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
            $labor->where('age', '>=', $request->age['min'])->where('age', '<=', $request->age['max']);
        }

        // Job filter
        if ($request->has('job')) {
            $labor->whereHas(
                'job',
                function ($query) use ($request) {
                    $query->where('name', $request->job);
                }
            );
        }
        if ($request->has('price_month')) {
            $labor->where('price_month', '>=', $request->price_month['min'])->where('price_month', '<=', $request->price_month['max']);
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

        return $labor->paginate(10);
    }
}
