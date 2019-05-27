<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\Regency;
use App\District;

class LocationController extends Controller
{
    public function showProvinces(){
        return Province::all();
    }

    public function showRegencies(){
        return Regencies::all();
    }

    public function showDistricts(){
        return Districts::all();
    }
}
