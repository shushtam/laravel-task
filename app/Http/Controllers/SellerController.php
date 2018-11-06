<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProduct;
use App\Http\Requests\UpdateProduct;
use App\Image;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    public function index()
    {
        return \redirect('home');
    }

    public function create()
    {
        return view('seller.create');
    }

    public function store(AddProduct $request)
    {
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->confirmed = 0;
            $product->seller_id = Auth::id();
            $product->save();
            $imageName = 'product' . preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime()) . '.' . $request->general_image->getClientOriginalExtension();
            $request->general_image->move(public_path('images/products'), $imageName);
            Image::create(["product_id" => $product->id, "name" => $imageName, "general" => 1]);
            $images = [];
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $imageName = 'product' . preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime()) . '.' . $image->getClientOriginalExtension();
                    $images[] = ["product_id" => $product->id, "name" => $imageName, "general" => 0];
                    $image->move(public_path('images/products'), $imageName);
                }
                Image::insert($images);
            }

            Session::flash('message', 'Added successfully!');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception $e) {
            Session::flash('message', 'Something went wrong.');
            Session::flash('alert-class', 'alert-danger');
        }
        return Redirect::back();

    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->with('images')->first();
        return view('seller.edit')->with('product', $product);
    }

    public function update(UpdateProduct $request, $id)
    {
        try {
            $product = Product::where('id', $id)->first();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->confirmed = 0;
            $product->seller_id = Auth::id();
            $product->save();
            if ($request->hasFile('general_image')) {
                $image = $product->general_image()->first();
                unlink(public_path() . '/images/products/' . $image->name);
                Image::where('id', $image->id)->delete();
                $imageName = 'product' . preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime()) . '.' . $request->general_image->getClientOriginalExtension();
                $request->general_image->move(public_path('images/products'), $imageName);
                Image::create(["product_id" => $product->id, "name" => $imageName, "general" => 1]);
            }

            if ($request->has('images')) {
                $images = [];
                foreach ($request->images as $image) {
                    $imageName = 'product' . preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime()) . '.' . $image->getClientOriginalExtension();
                    $images[] = ["product_id" => $product->id, "name" => $imageName, "general" => 0];
                    $image->move(public_path('images/products'), $imageName);
                }
                Image::insert($images);
            }

            Session::flash('message', 'Updates successfully!');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception $e) {
            Session::flash('message', 'Something went wrong.');
            Session::flash('alert-class', 'alert-danger');
        }
        return Redirect::back();
    }

    public function delete($id)
    {
        $product = Product::find($id);
        try {
            Product::where('id', $product->id)->delete();
            Session::flash('message', 'Deleted successfully!');
            Session::flash('alert-class', 'alert-success');
            return Redirect::back();
        } catch (\Exception $e) {
            Session::flash('message', 'Something went wrong.');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::back();
        }
    }

    public function deleteImage($id)
    {
        $image = Image::find($id);
        try {
            unlink(public_path() . '/images/products/' . $image->name);
            Image::where('id', $image->id)->delete();
            Session::flash('message', 'Deleted successfully!');
            Session::flash('alert-class', 'alert-success');
            return Redirect::back();
        } catch (\Exception $e) {
            Session::flash('message', 'Something went wrong.');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::back();
        }

    }

    public function viewOrders()
    {
        $user = User::find(Auth::id());
        $products = $user->products()->whereHas('orders')->with('orders.customer')->get();
        return view('seller.orders')->with('products', $products);
    }

    public function approveOrder($order)
    {
        $order = Order::where('order_number', $order)->with('customer')->first();
        $data = ['order' => $order];
        try {
            $order->confirmed_by_seller = 1;
            $order->save();
            Mail::send('emails.order-confirmation', $data, function ($message) use ($order) {
                $message->to($order->customer->email, $order->customer->name)
                    ->subject('Order Confirmation');
                $message->from('simpleshop@gmail.com', 'Simple Shop');
            });
            Session::flash('message', 'Email sent successfully!');
            Session::flash('alert-class', 'alert-success');
            return Redirect::back();
        } catch (\Exception $e) {
            Session::flash('message', 'Something went wrong.');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::back();
        }
    }
}
