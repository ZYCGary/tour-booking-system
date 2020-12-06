<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('tour')->paginate(20);

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
        $status = $request->input('status');

        $enabledDates = Tour::findOrFail($tour_id)->dates()->enabled()->pluck('date')->toArray();

        if (!in_array($tour_date, $enabledDates)) {
            return redirect(route('bookings.create', ['tour' => $tour_id]));
        }

        $booking = Booking::create([
            'tour_id' => $request->input('tour_id'),
            'tour_date' => $request->input('tour_date'),
            'status' => $status
        ]);

        event(new BookingCreated($request, $booking));

        return redirect(route('bookings.index'));
    }

    public function edit(Booking $booking)
    {
        $tour = $booking->tour;
        $enabledDates = $tour->dates()->enabled()->pluck('date')->toArray();
        $passengers = $booking->passengers;

        return view('bookings.edit', [
            'tour' => $tour,
            'enabledDates' => $enabledDates,
            'booking' => $booking,
            'passengers' => $passengers
        ]);
    }
}
