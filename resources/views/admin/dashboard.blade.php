@extends('layouts.app')
@section('links')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class') }}">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header">
                                    <a class="btn btn-success" data-toggle="collapse" href="#products">
                                        Products
                                    </a>
                                    <a class="btn btn-success" data-toggle="collapse" href="#orders">
                                        Orders
                                    </a>
                                    <a class="btn btn-success" data-toggle="collapse" href="#sellers">
                                        Sellers
                                    </a>
                                    <a class="btn btn-success" data-toggle="collapse" href="#customers">
                                        Customers
                                    </a>
                                </div>
                                <div id="products" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        @if(count($products) > 0)
                                            <table class="table table-striped products-table">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Description</th>
                                                    <th>General Image</th>
                                                    <th>Images</th>
                                                    <th>Confirm</th>
                                                    <th>Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td>{{$product->name}}</td>
                                                        <td>{{$product->price}}</td>
                                                        <td>{{$product->description}}</td>
                                                        <td>
                                                            <img src="{{$product->general_image()->first()?'/images/products/'.$product->general_image()->first()->name:''}}">
                                                        </td>
                                                        <td><a href="#"
                                                               data-images="{{$product->images_except_general}}"
                                                               class="btn btn-primary show-images" data-toggle="modal"
                                                               data-target="#imagesModal">Show</a>
                                                        </td>
                                                        <td>
                                                            @if(!$product->confirmed)
                                                                <a href="{{'confirm-product/'.$product->id}}"
                                                                   class="btn btn-success">confirm</a>
                                                            @else
                                                                confirmed
                                                            @endif
                                                        </td>
                                                        <td><a href="{{url('/products/'.$product->id.'/delete')}}"
                                                               class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            no products
                                        @endif
                                    </div>
                                </div>
                                <div id="orders" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        @if(count($orders) > 0)
                                            <table class="table table-striped orders-table">
                                                <thead>
                                                <tr>
                                                    <th>Order number</th>
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Product Description</th>
                                                    <th>Product General Image</th>
                                                    <th>Customer name</th>
                                                    <th>Seller name</th>
                                                    <th>Confirm</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{$order->order_number}}</td>
                                                        <td>{{$order->product->name}}</td>
                                                        <td>{{$order->product->price}}</td>
                                                        <td>{{$order->product->description}}</td>
                                                        <td>
                                                            <img src="{{$order->product->general_image()->first()?'/images/products/'.$product->general_image()->first()->name:''}}">
                                                        </td>
                                                        <td>{{$order->customer->name}}</td>
                                                        <td>{{$order->product->seller->name}}</td>
                                                        <td>
                                                            @if(!$order->confirmed)
                                                                <a href="{{'confirm-order/'.$order->order_number}}"
                                                                   class="btn btn-success">confirm</a>
                                                            @else
                                                                confirmed
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            no orders
                                        @endif
                                    </div>
                                </div>
                                <div id="sellers" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        @if(count($sellers) > 0)
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($sellers as $seller)
                                                    <tr>
                                                        <td>{{$seller->name}}</td>
                                                        <td>{{$seller->username}}</td>
                                                        <td>{{$seller->email}}</td>
                                                        <td><a href="{{url('/sellers/'.$seller->id.'/delete')}}"
                                                               class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            no sellers
                                        @endif
                                    </div>
                                </div>
                                <div id="customers" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        @if(count($customers) > 0)
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($customers as $customer)
                                                    <tr>
                                                        <td>{{$customer->name}}</td>
                                                        <td>{{$customer->username}}</td>
                                                        <td>{{$customer->email}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            no customers
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
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