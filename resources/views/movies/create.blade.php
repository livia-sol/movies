@extends('layouts.app2')

@section('menu-header')
    <div class="menu">
        <div class="row">
            <div class="col-4">
                <span class="menu-item ml-4">
                    <i class="fa fa-bars"></i>
                </span>
            </div>
            <div class="col-4">
                <img src="{{ asset('assets/logo-imdb.png') }}" alt="Logo IMDb" class="center">
            </div>
            <div class="col-4">
                <span class="user-item pull-right mr-4">
                    <i class="fa fa-user"></i>
                </span>
            </div>
        </div>
    </div>
@endsection

@section('content')
<hr>
<div class="card center mt-4" style="width: 350px;">
    <div class="card-body">
        <h5 class="card-title title">Add informations about a movie:</h5>

        {{ Form::open( ['url' => route('movies.store'), 'class' => 'movie-box border border-light p-1', 'files' => true, 'id' => 'add_movie'] ) }}
        <div class="card-text">
            {{ Form::select('status', $status,  null, ['class' => 'form-control my-2', 'placeholder' => __('1-visible or 2-hidden') ]) }}
            {{ Form::text('name', null, ['class' => 'form-control my-2', 'placeholder' => __('Name') ]) }}
            {{ Form::text('rating', null, ['class' => 'form-control my-2', 'placeholder' => __('Rating') ]) }}
            {{ Form::textarea('description', '', ['class' => 'form-control my-1', 'placeholder' => __('Description'), 'rows' => 4 ]) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text mr-4" id="inputGroupFileAddon01">{{ __('Image') }}</span>
                </div>
                <div class="custom-file">
                    {{ Form::file('image', ['class' => 'custom-file-input', 'id' => 'inputGroupFile']) }}
                    <label class="custom-file-label" for="inputGroupFile">{{ __('Select an image:') }}</label>
                </div>
            </div>
        </div>
        <button class="btn bg-yellow my-4 btn-block" type="submit">{{ __('Save') }}</button>
        {{ Form::close() }}
    </div>
  </div>
<div class="center my-3 w-100">@if(session()->has('message')) {{ session()->get('message') }} @endif</div>

@endsection