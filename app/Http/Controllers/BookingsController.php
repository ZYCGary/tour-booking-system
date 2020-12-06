<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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
}
