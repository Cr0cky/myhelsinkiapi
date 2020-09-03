@extends('layouts.layouts')

@section('apicontent')
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

            // Loop out all id:s
            for ($x = 0; $x <= count($objAllPlaces->data)-1; $x++) {
                echo $objAllPlaces->data[$x]->id."<br>";
            }
        ?>

        <!--{{$objAllPlaces->data[5]->id}}-->



        <!-- Pretty print one place -->
        <?php
            $json = file_get_contents('http://open-api.myhelsinki.fi/v1/place/573?language_filter=sv');
            $obj = json_decode($json);
        ?>
        <h1>
            {{$obj->name->sv}}
        </h1>
        <h3>
        {{$obj->location->address->street_address}}, {{$obj->location->address->locality}}
        </h3>
        {{$obj->description->body}}

        <!-- Do not try to print image if there is no image -->
        @if (!empty($obj->description->images[0]->url)) 
            <p><img src={{$obj->description->images[0]->url}} alt="Bild" width="400"></p>      
        @endif

        
        

    </div>
</div>
@endsection
