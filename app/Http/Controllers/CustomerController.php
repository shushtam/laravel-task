<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeOrder;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function makeOrder(MakeOrder $request)
    {
        try {
            $order = new Order();
            $order->order_number = 'order' . preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime());
            $order->account_username = $request->account_name;
            $order->account_password = Hash::make($request->account_password);
            $order->create_profile = $request->create_profile;
            $order->billing_street = $request->billing_street;
            $order->billing_city = $request->billing_city;
            $order->billing_zip = $request->billing_zip;
            $order->billing_country = $request->billing_country;
            $order->customer_id = Auth::id();
            $order->product_id = $request->product_id;
            $order->confirmed = 0;
            $order->confirmed_by_seller = 0;
            $order->save();
            Session::flash('message', 'Order made successfully.');
            Session::flash('alert-class', 'alert-success');
            return response()->json(['status' => 200, 'message' => 'Order made successfully.']);
        } catch (\Exception $e) {
            Session::flash('message', 'Something went wrong.');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::back();
        }
    }

    public function viewProducts()
    {
        $products = Product::with('images')->get();
        return view('customer.products')->with('products', $products);
    }
}
