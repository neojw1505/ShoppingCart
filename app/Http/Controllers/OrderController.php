<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    //
    public function index()
    {
        return view('partials.user-orders');
    }

    public function confirm(Request $request)
    {
        $this->storeBillingDetails($request);
        $billing = Billing::where('userId', Auth::user()->id)->get();
        $this->storePaymentDetails($request);
        $payment = Payment::where('userId', Auth::user()->id)->get();
        $orderId = $this->storeOrders();
        $this->storeOrderDetails($orderId);
        return view('user-orders-cfm', ['billing' => $billing, 'payment' => $payment]);
    }


    private function storeBillingDetails(Request $request)
    {
        $data = [
            'userId' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'PaymentId' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
        ];
        Billing::create($data);
    }


    private function storeOrders()
    {
        $data = [
            'userId' => Auth::user()->id,
            'total' => number_format(\Cart::session(Auth::user()->id)->getsubTotal()
                + 0.07 * (\Cart::session(Auth::user()->id)->getsubTotal()), 2),
        ];
        $orders =  Order::create($data);
        return $orders->id;
    }

    private function storeOrderDetails($orderId)
    {
        $userId = Auth::user()->id;
        $cartCollection = \Cart::session($userId)->getContent();
        foreach ($cartCollection as $cartCollection) {
            $data = [
                'orderId' =>  $orderId,
                'productId' => $cartCollection->id,
                'quantity' => $cartCollection->quantity,
            ];
            OrderDetail::create($data);
        }
    }

    private function storePaymentDetails(Request $request)
    {
        $data = [
            'userId' => Auth::user()->id,
            'name' => $request->card_name,
            'address' => $request->card_address,
            'cardNumber' => $request->card_number,
            'cardExpiry' => $request->card_expiry,
            'cardCVC' => $request->card_cvc,
        ];
        Payment::create($data);
    }

    public function showOrdersDetails(Request $request)
    {
        $orderdetails = DB::table('order_details')
            ->join('products', 'order_details.productId', '=', 'products.id')
            ->select('order_details.*', 'products.*')
            ->where('order_details.orderId', '=', $request->id)
            ->get();

        $orders = [
            'orderId' => $request->id,
            'created_at' => $request->date,
        ];

        return view('user-orders-details', ['orders' => $orders, 'orderdetails' => $orderdetails]);
    }

    public function showOrderSummary(Request $request)
    {
        $orderdetails = DB::table('order_details')
            ->join('products', 'order_details.productId', '=', 'products.id')
            ->join('orders', 'order_details.orderId', '=', 'orders.orderId')
            ->select('order_details.*', 'products.name', 'products.details', 'products.price', 'products.image_path', 'orders.*')
            ->where('order_details.orderId', '=', $request->id)
            ->get();
        return view('user-orders-summary', ['orderdetails' => $orderdetails]);
    }
}
