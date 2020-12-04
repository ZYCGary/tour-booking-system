<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $tours = Tour::public()->paginate(20);

        return view('tours.index', [
            'tours' => $tours
        ]);
    }

    public function store(Request $request)
    {
        $tour = Tour::create([
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'itinerary' => $request->input('itinerary')
        ]);

        return redirect(route('drafts.index'));
    }

    public function create(Tour $tour)
    {
        return view('tours.create_and_edit', [
            'tour' => $tour
        ]);
    }
}
