<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        if ($role->name == 'seller') {
            $products = Product::where("seller_id", $user->id)->with('images')->get();
            return view('seller.dashboard')->with('products', $products);
        } elseif ($role->name == 'customer') {
            $orders = $user->orders()->with('product.images')->get();
            return view('customer.dashboard')->with('orders', $orders);
        } elseif ($role->name == 'superadmin') {
            $products = Product::with('images')->get();
            $orders = Order::with('product.seller', 'customer')->get();
            $sellerRoleId = Role::where('name', 'seller')->first()->id;
            $customerRoleId = Role::where('name', 'customer')->first()->id;
            $sellers = User::where('role_id', $sellerRoleId)->get();
            $customers = User::where('role_id', $customerRoleId)->get();
            return view('admin.dashboard')->with(['products' => $products, 'orders' => $orders, 'sellers' => $sellers, 'customers' => $customers]);
        } else {
            return redirect('/');
        }
    }
}
