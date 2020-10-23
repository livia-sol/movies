@extends('layouts.app2')

@section('content')
<a href="{{ route('movies.index')}}"><i class="fa fa-arrow-left back-arrow mt-2 ml-3"></i></a>
    <div class="menu-content text-menu">
        This is a full screen menu
            <br><br>
        Close me from "Back Arrow"
    </div>
@endsection