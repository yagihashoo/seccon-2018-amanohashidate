<?php

namespace App\Http\Controllers;

use App\Challenge;

class TopController extends Controller
{
    public function index()
    {
        $challenges = Challenge::where('verified', true)->orderBy('created_at', 'asc')->paginate(20);

        return view('top')->with('challenges', $challenges);
    }
}
