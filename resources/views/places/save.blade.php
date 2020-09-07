@extends('layouts.layouts')

@section('randomplace')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            My Helsinki
        </div>
        <h2>Saved Places</h2>



        <!-- Show saved places -->
        @foreach($savedPlaces as $place)
            <div>
                {{ $place->name }} <br> {{ $place->description }} <br> {{ $place->http }}
            </div> 
        @endforeach           
    </div>
</div>
@endsection
