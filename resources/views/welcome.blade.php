@extends('layouts.layouts')

@section('indexcontent')
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
            My Helsinki API
        </div>

        <div class="links">

            <a href="randomplace"> Slumpmässig plats</a>
        </div>
    </div>
</div>
@endsection

