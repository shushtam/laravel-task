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
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{url('/products/create')}}" class="btn btn-success">Add new</a>
                            <a href="{{url('view-orders')}}" class="btn btn-primary">View orders</a>
                        </div>
                        @if(count($products) > 0)
                            <table class="table table-striped products-table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>General Image</th>
                                    <th>Images</th>
                                    <th>Confirmed</th>
                                    <th>Edit</th>
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
                                        <td><a href="#" data-images="{{$product->images_except_general}}"
                                               class="btn btn-primary show-images" data-toggle="modal"
                                               data-target="#imagesModal">Show</a>
                                        </td>
                                        <td>{{$product->confirmed ? 'yes' : 'no'}}</td>
                                        <td><a href="{{url('/products/'.$product->id.'/edit')}}"
                                               class="btn btn-info">Edit</a></td>
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
