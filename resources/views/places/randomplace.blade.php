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


        <?php

            // Fetch all places
            $jsonAllPlaces = file_get_contents('http://open-api.myhelsinki.fi/v1/places/?language_filter=sv');
            $objAllPlaces = json_decode($jsonAllPlaces);

            // Save all id:s to array $allId
            $allId = array();
            for ($x = 0; $x <= count($objAllPlaces->data)-1; $x++) {
                $allId[$x] = $objAllPlaces->data[$x]->id;
            }

            // Generate random id and save data to $randomPlace
            $randomId = random_int(0, count($allId));
            $randomPlace = $allId[$randomId] = $objAllPlaces->data[$randomId];
        ?>

        <!-- Pretty print random place -->
        <h1>{{$randomPlace->name->sv}}</h1>
        <h3>{{$randomPlace->location->address->street_address}}, {{$randomPlace->location->address->locality}}</h3>
        {{$randomPlace->description->body}}

        <!-- Print image only if there is an image address -->
        @if (!empty($randomPlace->description->images[0]->url)) 
            <p><img src={{$randomPlace->description->images[0]->url}} alt="Bild" width="400"></p>      
        @endif

        <!-- Reload page, with new place -->
        <p><a href="<?php $_SERVER['PHP_SELF']; ?>">Visa en annan plats</a></p>
        

    </div>
</div>
@endsection
