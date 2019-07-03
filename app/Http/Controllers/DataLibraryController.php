<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\Regency;
use App\District;
use App\Ethnic;

class DataLibraryController extends Controller
{
    public function showProvinces(){
        return Province::all();
    }

    public function showRegencies(){
        return Regency::all();
    }

    public function showDistricts(){
        return District::all();
    }

    public function showEthnics(){
        return Ethnic::all();
    }
}
