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
            $json = file_get_contents('http://open-api.myhelsinki.fi/v1/place/653?language_filter=sv');
            $obj = json_decode($json);
            //echo $obj->name->sv;
            //$image = {{$obj->description->images[0]->url}}
        ?>
        <h1>
            {{$obj->name->sv}}
        </h1>
        <h3>
        {{$obj->location->address->street_address}}, {{$obj->location->address->locality}}
        </h3>
        {{$obj->description->body}}


        @if (!empty($obj->description->images[0]->url)) 
            <p><img src={{$obj->description->images[0]->url}} alt="Bild" width="400"></p>      
        @endif

        
        

    </div>
</div>
@endsection
