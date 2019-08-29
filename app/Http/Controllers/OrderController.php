<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Labor;
use App\OrderLabor;
use App\Revenue;
use App\AddonsCost;
use App\Http\Resources\Order as AppOrder;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = $request->isMethod('put') ? Order::findOrFail($request->id) : new Order;

        $order->name = $request->name;
        $order->handphone = $request->handphone;
        $order->address = $request->address;
        $order->time_type = $request->time_type;
        // daily order
        $order->day_start = $request->day_start;
        $order->day_end = $request->day_end;

        // hours order
        $order->hour_date = $request->hour_date;
        $order->hour_start = $request->hour_start;
        $order->hour_end = $request->hour_end;

        //sales data
        if ($request->has('addons_cost')) {
            if ($request->addons_cost != null) {
                $order->addons_cost = json_encode($request->addons_cost);
            }
        }
        $order->salary_cut = $request->salary_cut;
        $order->admin_cost = $request->admin_cost;
        $order->total_cost = $request->total_cost;
        if ($request->has('revenue_id')) {
            $order->revenue()->associate($request->revenue_id);
        }
        $order->status()->associate($request->status_id)->save();
        $order->note_id = time() . '-' . $order->id . '-' . $request->time_type;
        $order->save();

        // labor available
        if ($request->has('labor_id')) {
            $order->labor()->associate($request->labor_id);
        }
        $order->save();

        // labor requirement if theres no labor available
        if ($request->has('order_labor')) {
            if ($request->order_labor != null) {
                $this->storeRequirementLabor($request, $order->id);
            }
        }
        // addons cost
        // if ($request->has('addons_costs')) {
        //     $this->storeAddonsCost($request, $order->id);
        // }

        return response()->json(['message' => 'success', 'data' => $order]);
    }

    // store require labor
    private function storeRequirementLabor(Request $req, $order_id)
    {
        $orderLabor = $req->isMethod('put') ? OrderLabor::findOrFail($req->order_labor['id'])  : new OrderLabor;
        foreach ($req->order_labor as $key => $value) {
            if ($key != 'age' && $key != 'skills' && $key != 'price') {
                $orderLabor->$key = $value;
            } else {
                // to store array data from age, skills, and range price
                if ($value != null) {
                    $orderLabor->$key = json_encode($value);
                }
            }
        }
        $orderLabor->order()->associate($order_id);
        $orderLabor->save();
    }

    // store addons cost
    private function storeAddonsCost(Request $req, $order_id)
    {
        foreach ($req->addons_costs as $key => $addons_cost) {
            $addonsCost = new AddonsCost;
            $addonsCost->name = $addons_cost['name'];
            $addonsCost->cost = $addons_cost['cost'];
            $addonsCost->order()->associate($order_id)->save();
        }
    }

    public function index()
    {
        $order = Order::with(['order_labor', 'labor'])->where('status_id', 1)->orderBy('created_at', 'desc')->paginate(8);
        return AppOrder::collection($order);
    }

    public function show($id)
    {
        $order = Order::with(['order_labor', 'labor'])->findOrFail($id);
        return new AppOrder($order);
    }


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if ($order->delete()) {
            return response()->json(['message' => 'success']);
        }
    }
}
