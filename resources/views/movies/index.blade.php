@extends('layouts.app')

@section('menu-header')
    <div class="menu">
        <div class="row">
            <div class="col-4">
                <span class="menu-item ml-4">
                    <a href="#" id="menu-link"><i class="fa fa-bars"></i></a>
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

<div class="movie-box bg-yellow my-3"> <a href="{{ route('movies.create') }}" class="btn btn-sm btn-yellow w-100">
    <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ __('app.add_movie') }}</a>
</div>
    
@if( count($movies) > 0)
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
                            <a href="{{ route('movies.show', encrypt($movie->id)) }}" class="btn btn-sm btn-yellow w-100">{{ __('app.view_more') }}</a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    @endforeach 

    <div class="d-flex justify-content-center mb-0">
        {{ $movies->onEachSide(3)->links() }}
    </div>
@else
    <i>{{ __('app.movies_not_found') }}</i>
@endif

@endsection

@section('app-js')
    <script>
        $(document).ready(function(){
            $('#menu-link').click(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('movies.showMenu') }}",
                    method: 'GET',
                    success: function(result) {
                        $('body').html(result);
                    },
                    error: function(){
                        alert('Error!');
                    } 
                });
            });
        });
    </script>
@endsection