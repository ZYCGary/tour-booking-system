<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $listings = Tour::Listings(Auth::user())->get();

        return view('listings.index', [
            'listings' => $listings
        ]);
    }
}
