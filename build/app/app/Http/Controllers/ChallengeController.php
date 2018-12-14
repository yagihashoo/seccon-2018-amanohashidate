<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id');

        $challenge = Challenge::where('verified', true)->where('id', $id)->first();

        return view('challenge')->with('challenge', $challenge);
    }
}
