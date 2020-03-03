<?php

namespace App\Http\Controllers;

use App\OrderPayment;
use Illuminate\Http\Request;
use App\Http\Resources\OrderPayment as OrderPaymentResource;
use App\Order;
use Exception;
use Illuminate\Support\Facades\Mail;

class OrderPaymentController extends Controller
{
    public function index()
    {
        $payment = OrderPayment::orderBy('created_at', 'desc')->paginate(8);
        return OrderPaymentResource::collection($payment);
    }

    public function store(Request $request)
    {
        //Checking note_id exist in orders table
        //Checking if note_id has exist in order_payments table, avoid spams
        if (
            Order::where([['note_id', '=', $request->note_id], ['status_id', '=', $request->status_id]])->first()
            && !OrderPayment::where('note_id', $request->note_id)->first()
        ) {
            // search order based on note_id
            $order = Order::where('note_id', $request->note_id)->firstOrFail();
            $payment = new OrderPayment;

            // store order payment
            $payment->name = $request->name;
            $payment->note_id = $request->note_id;
            $payment->handphone = $request->handphone;
            $payment->address = $request->address;
            $payment->order()->associate($order->id);
            $payment->file = $this->storeImage($request);

            if ($payment->save()) {
                try {
                    Mail::send('payment_mail', ['order' => $order], function ($msg) {
                        $msg->subject('Konfirmasi Pembayaran');
                        $msg->from('kasihkeluargayayasan@gmail.com', 'Sistem Yayasan Kasih Keluarga');
                        $msg->to('ekowiradharma@gmail.com');
                    });
                    return response()->json(['message' => 'success', 'data' => $payment]);
                } catch (Exception $e) {
                    return response(['status' => false, 'errors' => $e->getMessage()]);
                }
            }
        } else {
            return response()->json(['message' => 'Nomor nota tidak ditemukan atau sudah dikonfirmasi'], 401);
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
