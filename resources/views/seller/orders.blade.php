@extends('layouts.app')
@section('links')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                        @if(count($products) > 0)
                            <table class="table table-striped orders-table">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Description</th>
                                    <th>Product General Image</th>
                                    <th>Customer name</th>
                                    <th>Confirm</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    @foreach($product->orders as $order)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->description}}</td>
                                            <td>
                                                <img src="{{$product->general_image()->first()?'/images/products/'.$product->general_image()->first()->name:''}}">
                                            </td>
                                            <td>{{$order->customer->name}}</td>
                                            <td>
                                                @if(!$order->confirmed_by_seller)
                                                    <a href="{{'approve-order/'.$order->order_number}}"
                                                       class="btn btn-primary">confirm</a>
                                                @else
                                                    confirmed
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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

        <!-- The Modal -->
        <div class="modal images-modal" id="imagesModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Images</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/products.js')}}"></script>
@endsection
