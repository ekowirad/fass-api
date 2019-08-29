<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Revenue;
use App\Income;
use App\Expense;
use App\Http\Resources\Revenue as RevenueResource;
use App\Job;
use App\Labor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RevenueController extends Controller
{
    public function store(Request $request)
    {
        $revenue = new Revenue;
        $revenue->user()->associate($request->user_id)->save();
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
        $revenue_id = Input::get('revenue_id');
        switch ($type) {
            case 1:
                return Expense::where('revenue_id', $revenue_id)->get();
                break;
            case 2:
                return Income::where('revenue_id', $revenue_id)->get();
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
    {
        $start= Input::get('start_date');
        $end= Input::get('end_date');

        $revenue = Revenue::with(['order.labor', 'expense', 'income'])->whereBetween(DB::raw('DATE(created_at)'), array($start, $end))->get();;
        $labor = $this->laborJobCount($revenue);
        return response()->json([
            'data_report' => RevenueResource::collection($revenue),
            'data_labor' => $labor
        ], 200);
    }

    // count jobs labor from all order, to get most job demand and less job demand
    private function laborJobCount($revenue){
        $jobsArr = array_fill(0, Job::all()->count(), 0);
        foreach ($revenue as $key => $value) {
            foreach ($value['order'] as $key => $value) {
                $idx = $value['labor']['job_id'];
                $jobsArr[$idx-1] += 1;
                // echo $value['labor']['job_id'];
            }
        }

        return $jobsArr;
    }

    public function destroy($id)
    { }
}
