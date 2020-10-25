@extends('layouts.app2')

@section('content')

    <div class="bg-yellow">    
        <a href="{{ route('movies.index')}}" id="arrow-link"><i class="fa fa-arrow-left back-arrow mt-2 ml-3"></i></a>
        <div class="menu-content text-menu">
            This is a full screen menu
                <br><br>
            Close me from "Back Arrow"
        </div>
    </div>

@endsection

@section('app-js')
    <script>
        $(document).ready(function(){
            $('#arrow-link').click(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('movies.index') }}",
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