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

        <!-- Pretty print random place -->
        <h1>{{$randomPlace->name->sv}}</h1>
        <h3>{{$randomPlace->location->address->street_address}}, {{$randomPlace->location->address->locality}}</h3>
        {{$randomPlace->description->body}}

        <!-- Print image only if there is an image address -->
        @if (!empty($randomPlace->description->images[0]->url)) 
            @for ($x = 0; $x <= count($randomPlace->description->images)-1; $x++)
            <p><img src={{$randomPlace->description->images[$x]->url}} alt="Bild" width="400"></p>
            @endfor     
        @endif


        <p>
            <!-- WWW link -->
            <a href={{$randomPlace->info_url}}>www</a>
            <!-- Address to Google Map  -->
            <a href="https://www.google.com/maps/place/{{$randomPlace->location->address->street_address}},+{{$randomPlace->location->address->postal_code}}+{{$randomPlace->location->address->locality}}">map</a>
        </p>
        <!-- Reload page, with new place -->
        <p><a href="<?php $_SERVER['PHP_SELF']; ?>">Visa en annan plats</a></p>


        <!-- Save data -->
        

</div>
@endsection
