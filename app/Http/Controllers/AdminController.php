<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function confirmProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->confirmed = 1;
            $product->save();
            Session::flash('message', 'Updated successfully.');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        return Redirect::back();
    }

    public function confirmOrder($order)
    {
        $order = Order::where('order_number', $order)->first();
        if ($order) {
            $order->confirmed = 1;
            $order->save();
            Session::flash('message', 'Updated successfully.');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        return Redirect::back();

    }

    public function deleteSeller($id)
    {
        try {
            User::where('id', $id)->delete();
            Session::flash('message', 'Deleted successfully.');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception $e) {
            Session::flash('message', 'Something went wrong.');
            Session::flash('alert-class', 'alert-danger');
        }
        return Redirect::back();
    }
}
