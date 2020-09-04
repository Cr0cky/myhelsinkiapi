<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(){

        // At a later point it might be a good idea to move this API call to a service or domain.



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



        return view('places.randomplace', ['randomPlace' => $randomPlace]);
    }
}
