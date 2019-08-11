<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Revenue;
use App\Income;
use App\Expense;
use Illuminate\Support\Facades\Input;

class RevenueController extends Controller
{
    public function store(Request $request)
    {
        $revenue = new Revenue;
        $revenue->user()->associate($request->user_id);
        if($revenue->save()){
            return response()->json($revenue, 200);

        }
    }

    public function storeExpenseIncome(Request $request)
    {
        $data = $request->type == 1 ? new Expense : new Income;

        $data->name = $request->name;
        $data->nominal = $request->nominal;
        $data->revenue()->associate($request->revenue_id)->save();
        if($data->save()){
            return response()->json($data, 200);
        }
    }

    public function showExpenseIncome($type)
    {
        switch ($type) {
            case 1:
                return Expense::all();
                break;
            case 2:
                return Income::all();
                break;
            default:
                return null;
                break;
        }
    }

    public function show($id)
    {
        $revenue = Revenue::with(['user', 'order', 'income'])->findOrFail($id);

        return $revenue;
    }

    public function index()
    { }

    public function destroy($id)
    { }
}
