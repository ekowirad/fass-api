<?php

namespace App\Http\Controllers;

use App\OrderPayment;
use Illuminate\Http\Request;
use App\Http\Resources\OrderPayment as OrderPaymentResource;

class OrderPaymentController extends Controller
{
    public function index()
    {
        $payment = OrderPayment::orderBy('created_at', 'desc')->paginate(8);
        return OrderPaymentResource::collection($payment);
    }

    public function store(Request $request)
    {
        $payment = new OrderPayment;

        $payment->name = $request->name;
        $payment->note_id = $request->note_id;
        $payment->handphone = $request->handphone;
        $payment->address = $request->address;
        $payment->file = $this->storeImage($request);

        if ($payment->save()) {
            return response()->json(['message' => 'success', 'data' => $payment]);
        }
    }

    public function storeImage(Request $request)
    {
        $image = $request->file('payment_file');
        $img_name = $request->note_id . '_' . str_random(20) . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/user_upload', $img_name);

        return $img_name;
    }

    public function show($id)
    {
        $payment = OrderPayment::findOrFail($id);
        return new OrderPaymentResource($payment);
    }

    public function destroy($id)
    {
        echo "heeeeeelp";
    }
}
