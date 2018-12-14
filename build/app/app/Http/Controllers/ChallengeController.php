<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;

class ChallengeController extends Controller
{
    public function index()
    {
        return view('top')->with([
            'challenges' => Challenge::where('verified', true)->orderBy('id', 'asc')->get()->toArray(),
        ]);
    }

    public function detail($id)
    {
        return view('challenge')->with([
            'challenge' => Challenge::findOrFail($id),
        ]);
    }
}
