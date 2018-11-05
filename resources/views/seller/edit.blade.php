@extends('layouts.app')
@section('links')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class') }}">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Edit product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/products/'.$product->id.'/update') }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') ?  old('name') : $product->name}}" required
                                           autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" step="0.01"
                                           class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                           name="price" value="{{ old('price') ? old('price') : $product->price }}"
                                           required autofocus>

                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" required
                                              class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              name="description">{{ old('description') ? old('description')  : $product->description  }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(count($product->images_except_general) > 0)
                                <h3 class="mb-3">Delete images</h3>
                                <div class="form-group row">
                                    <div class="col-md-6">

                                        @foreach($product->images_except_general as $image)
                                            <div class="mb-3"><img src="{{'/images/products/'.$image->name}}"
                                                                   class="product-images"> <a
                                                        href="{{url('/images/'.$image->id.'/delete')}}"
                                                        class="btn btn-danger">delete</a></div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <h3 class="mb-3">Add new images</h3>

                            <div class="form-group row">
                                <label for="images"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Images') }}</label>

                                <div class="col-md-6">
                                    <input id="images" type="file" multiple="multiple"
                                           class="form-control{{ $errors->has('images') ? ' is-invalid' : '' }}"
                                           name="images[]">

                                    @if ($errors->has('images'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('images') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <h3>General image</h3>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail">
                                            <img src="{{$product->general_image()->first()?'/images/products/'.$product->general_image()->first()->name:''}}"
                                                 alt="...">
                                        </div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <button class="fileinput-new btn btn-primary btn-select-image">Select image</button>
                                                <a href="#pablo" class="btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                <input type="file"
                                                       class="form-control edit-general-image {{ $errors->has('general_image') ? ' is-invalid' : '' }}"
                                                       name="general_image"/>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($errors->has('general_image'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('general_image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-2 float-md-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('js/products.js')}}"></script>
@endsection
