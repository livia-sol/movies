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
                <img src="{{ asset('assets/logo-imdb.png') }}" alt="Logo IMDb" class="logo-center">
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
    <div class="movie-box my-3 bg-light">    
        <div class="row">
            <div class="col-12 d-flex justify-content-center my-1">
                <img src="{{ asset('assets/movies-images/'.$movie->image) }}" alt="{{ $movie->name }}">
            </div>
        </div>
        <div class="row my-1">
            <div class="col-12 movie-description  m-2 py-3 px-4">
                <div class="title">
                    {{ $movie->name }}
                </div>
                <div>
                    <i class="fa fa-star star"></i>{{ $movie->rating }}
                </div>
                <div>
                    {!! $movie->description !!}</div>
                </div>
            </div>
            <div class="col-12 m-2 p-2">
                <div class="row w-100">
                    <div class="col-6">
                        <a href="{{ route('movies.edit', encrypt($movie->id) ) }}" class="btn btn-yellow" >{{ __('Edit') }}</a></div>
                    <div class="col-6">
                        <form action="{{ route('movies.destroy', encrypt($movie->id) ) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-yellow pull-right">{{ __('Delete') }}</button>
                        </form>
                    {{-- <a href="" class="btn btn-yellow pull-right" >{ __('Delete') }}</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
