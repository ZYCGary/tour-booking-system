<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DraftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $drafts = Tour::drafts(Auth::user())->get();

        return view('drafts.index', [
            'drafts' => $drafts
        ]);
    }
}
