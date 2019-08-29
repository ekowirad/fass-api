<?php

namespace App\Http\Resources;

use App\Http\Resources\OrderLite as OrderLiteResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Revenue extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $this->totalIncome($this->order, $this->income);
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'total_revenue' => $this->totalIncome($this->order, $this->income),
            'total_expense' => $this->totalExpense($this->expense),
            'order' =>OrderLiteResource::collection($this->order),
            'expense' => $this->expense,
            'income' => $this->income,
        ];
    }


    public function totalExpense($expense){
        $totalExpense = 0;
        foreach ($expense as $key => $value) {
            $totalExpense += $value['nominal'];

        }
        return $totalExpense;
    }

    public function totalIncome($order, $income){
        $totalOrder = 0;
        $totalIncome = 0;
        foreach ($order as $key => $value) {
            $totalOrder += $value['total_cost'];
        }
        foreach ($income as $key => $value) {
            $totalIncome += $value['nominal'];
        }
        return $totalOrder + $totalIncome;

    }
}
