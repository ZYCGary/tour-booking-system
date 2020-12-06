<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::submitted()->with('tour')->paginate(20);

        return view('bookings.index', [
            'bookings' => $bookings
        ]);
    }

    public function create($tourId)
    {
        $tour = Tour::public()->findOrFail($tourId);
        $enabledDates = $tour->dates()->enabled()->pluck('date')->toArray();

        return view('bookings.create', [
            'tour' => $tour,
            'enabledDates' => $enabledDates
        ]);
    }

    public function store(BookingRequest $request)
    {
        $tour_id = $request->input('tour_id');
        $tour_date = $request->input('tour_date');

        $enabledDates = Tour::findOrFail($tour_id)->dates()->enabled()->pluck('date')->toArray();

        if (!in_array($tour_date, $enabledDates)) {
            return redirect(route('bookings.create', ['tour' => $tour_id]));
        }

        Booking::create([
            'tour_id' => $request->input('tour_id'),
            'tour_date' => $request->input('tour_date'),
            'status' => 0
        ]);

        return redirect(route('bookings.index'));
    }
}
