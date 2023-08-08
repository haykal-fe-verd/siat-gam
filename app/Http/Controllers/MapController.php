<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function showMap(Request $request, $latitude, $longitude)
    {
        return view('map', compact('latitude', 'longitude'));
    }
}
