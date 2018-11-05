@extends('layouts.app')
@section('links')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
                <a href="{{url('/view-products')}}" class="btn btn-success">View Products</a>
            </div>
            <div class="col-md-10">
                @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class') }}">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Orders</div>

                    <div class="card-body">
                        @if(count($orders) > 0)
                            <table class="table table-striped orders-table">
                                <thead>
                                <tr>
                                    <th>Order number</th>
                                    <th>Account username</th>
                                    <th>Billing Street</th>
                                    <th>Billing City</th>
                                    <th>Billing Zip</th>
                                    <th>Billing Country</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Description</th>
                                    <th>General Image</th>
                                    <th>Confirmed</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->order_number}}</td>
                                        <td>{{$order->account_username}}</td>
                                        <td>{{$order->billing_street}}</td>
                                        <td>{{$order->billing_city}}</td>
                                        <td>{{$order->billing_zip}}</td>
                                        <td>{{$order->billing_country}}</td>
                                        <td>{{$order->product->name}}</td>
                                        <td>{{$order->product->price}}</td>
                                        <td>{{$order->product->description}}</td>
                                        <td>
                                            <img src="{{$order->product->general_image()->first()?'/images/products/'.$order->product->general_image()->first()->name:''}}">
                                        </td>
                                        <td>{{$order->confirmed ? 'yes' : 'no'}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No orders</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/products.js')}}"></script>
@endsection
