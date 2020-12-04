<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    public function index()
    {
        $tours = Tour::public()->paginate(20);

        return view('tours.index', [
            'tours' => $tours
        ]);
    }
}
