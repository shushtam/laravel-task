@extends('layouts.app')

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
                    <div class="card-header">{{ __('Add new product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/products') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>

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
                                           name="price" value="{{ old('price') }}" required autofocus>

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
                                              name="description">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

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
                                <label for="general_image"
                                       class="col-md-4 col-form-label text-md-right">{{ __('General image') }}</label>

                                <div class="col-md-6">
                                    <input id="general_image" type="file"
                                           class="form-control{{ $errors->has('general_image') ? ' is-invalid' : '' }}"
                                           name="general_image" required>

                                    @if ($errors->has('general_image'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('general_image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
