<?php

namespace App\Http\Controllers;

use App\Events\TourCreated;
use App\Events\TourUpdated;
use App\Http\Requests\TourRequest;
use App\Models\Tour;
use http\Env\Response;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $tours = Tour::public()->paginate(20);

        return view('tours.index', [
            'tours' => $tours
        ]);
    }

    public function show($tourId)
    {
        $tour = Tour::public()->findOrFail($tourId);

        $enabledDates = $tour->dates()->enabled()->pluck('date')->toArray();

        return view('tours.show', [
            'tour' => $tour,
            'enabledDates' => $enabledDates,
        ]);
    }

    public function store(TourRequest $request)
    {
        $tour = Tour::create([
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'itinerary' => $request->input('itinerary')
        ]);

        $dates = explode(',', $request->input('dates'));
        event(new TourCreated($tour, $dates));

        return redirect(route('listings.index'));
    }

    public function create(Tour $tour)
    {
        return view('tours.create_and_edit', [
            'tour' => $tour
        ]);
    }

    public function edit(Tour $tour)
    {
        $this->authorize('update', $tour);

        $enabledDates = $tour->dates()->enabled()->pluck('date')->toArray();
        $disabledDates = $tour->dates()->disabled()->pluck('date')->toArray();

        return view('tours.create_and_edit', [
            'tour' => $tour,
            'enabledDates' => $enabledDates,
            'disabledDates' => $disabledDates
        ]);
    }

    public function update(TourRequest $request, Tour $tour)
    {
        $this->authorize('update', $tour);

        $tour->update([
            'name' => $request->input('name'),
            'itinerary' => $request->input('itinerary')
        ]);

        $dates = explode(',', $request->input('dates'));

        event(new TourUpdated($tour, $dates));

        if ($tour->status === 'public') {
            return redirect(route('tours.show', ['tour' => $tour->id]));
        }

        return redirect(route('listings.index'));
    }

    public function publish(Tour $tour)
    {
        $this->authorize('update', $tour);

        $tour->update([
            'status' => 1
        ]);

        return redirect(route('tours.show', ['tour' => $tour->id]));
    }
}
