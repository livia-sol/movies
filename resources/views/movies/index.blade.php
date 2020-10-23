@extends('layouts.app')

@section('menu-header')
    <div class="menu">
        <div class="row">
            <div class="col-4">
                <span class="menu-item ml-4">
                    <a href="{{ route('movies.showMenu')}}"><i class="fa fa-bars"></i></a>
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
    @foreach($movies as $movie)
        <div class="movie-box my-3">
            <div class="row">
                <div class="col-6">
                    <img src="{{ asset('assets/movies-images/'.$movie->image) }}" alt="{{ $movie->name }}">
                </div>
                <div class="col-6">
                    <div class="height-col">
                        <div class="title">{{ $movie->name }}</div>

                        <div class="descript">
                            <div><i class="fa fa-star star"></i>{{ $movie->rating }}</div>
                            <div>{!! $movie->description !!}</div>
                        </div>

                        <div class="button">
                            <a href="#" class="btn btn-sm bg-yellow w-100">View more</a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    @endforeach 
    
@endsection