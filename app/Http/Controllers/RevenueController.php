<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Revenue;

class RevenueController extends Controller
{
    public function store(Request $request){
        $revenue = new Revenue;

        $revenue->user()->associate($request->user_id);
        $revenue->save();

    }

    public function show($id){
        $revenue = Revenue::with(['user', 'order', 'income'])->findOrFail($id);

        return $revenue;
    }

    public function index(){

    }

    public function destroy($id){

    }
}
