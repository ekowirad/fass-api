<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Labor;

class OrderController extends Controller
{
    public function store(Request $request){
        $order = $request->isMethod('put') ? Order::findOrFail($request->id) : new Order;

        $order->name = $request->name;
        $order->handphone = $request->handphone;
        $order->address = $request->address;
        $order->time_type = $request->time_type;
        $order->day_start = $request->day_start;
        $order->day_end = $request->day_end;
        $order->hour_date = $request->hour_date;
        $order->hour_start = $request->hour_start;
        $order->hour_end = $request->hour_end;
        $order->status = $request->status;

        if($request->has('labor_id')){
            $labor = Labor::find($request->labor_id);
        }


    }

    private function salaryCut(Labor $labor, Order $order){
            //month salary cut
            if($order->time_type == 0){
                // salary cut for babysitter and care giver
                if($labor->job_id != 1){
                    if($labor->dorm_stay){

                    }else{

                    }
                // salary cut for maid
                }else{

                }


            }
    }

    public function index(){

    }

    public function destroy($id){

    }
}
