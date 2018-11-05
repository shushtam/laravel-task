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
                        @if(count($products) > 0)
                            <table class="table table-striped products-table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>General Image</th>
                                    <th>Images</th>
                                    <th>Buy</th>
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
                                        <td><a href="#" data-product="{{$product}}" class="btn btn-warning show-order"
                                               data-toggle="modal" data-target="#orderModal">Buy now</a>
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
        <!-- The Modal -->
        <div class="modal order-modal" id="orderModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Order</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form class="order-form">
                            <h4>Product details</h4>
                            <div class="product-details"></div>
                            <hr>
                            <div class="form-group row">
                                <label for="account_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>

                                <div class="col-md-6">
                                    <input id="account_name" type="text"
                                           class="form-control"
                                           name="account_name" value="{{ old('account_name') }}" required autofocus>

                                    <span class="invalid-feedback account_name hidden" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="account_password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Account Password') }}</label>

                                <div class="col-md-6">
                                    <input id="account_password" type="password"
                                           class="form-control"
                                           name="account_password" value="{{ old('account_password') }}" required
                                           autofocus>

                                    <span class="invalid-feedback account_password hidden" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="create_profile"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Create Profile') }}</label>

                                <div class="col-md-6 create-profile-row">
                                    <input id="create_profile" type="checkbox"
                                           name="create_profile">

                                    <span class="invalid-feedback create_profile hidden" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="billing_street"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Billing Street') }}</label>

                                <div class="col-md-6">
                                    <input id="billing_street" type="text"
                                           class="form-control"
                                           name="billing_street" value="{{ old('billing_street') }}" required autofocus>

                                    <span class="invalid-feedback billing_street hidden" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="billing_city"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Billing City') }}</label>

                                <div class="col-md-6">
                                    <input id="billing_city" type="text"
                                           class="form-control"
                                           name="billing_city" value="{{ old('billing_city') }}" required autofocus>

                                    <span class="invalid-feedback billing_city hidden" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="billing_zip"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Billing Zip') }}</label>

                                <div class="col-md-6">
                                    <input id="billing_zip" type="text"
                                           class="form-control"
                                           name="billing_zip" value="{{ old('billing_zip') }}" required autofocus>

                                    <span class="invalid-feedback billing_zip hidden" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="billing_country"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Billing Country') }}</label>

                                <div class="col-md-6">
                                    <input id="billing_country" type="text"
                                           class="form-control"
                                           name="billing_country" value="{{ old('billing_country') }}" required
                                           autofocus>

                                    <span class="invalid-feedback billing_country hidden" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success make-order">Buy now</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/products.js')}}"></script>
@endsection
