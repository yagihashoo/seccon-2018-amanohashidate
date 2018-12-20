<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Support\Facades\Auth;
use App\Submit;

class MeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $challenges = Challenge::where('setter_id', $user->id)->orderBy('created_at', 'desc')->limit(20)->get();
        $submissions = Submit::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(20)->get();

        return view('me')->with('user', $user)->with([
            'challenges' => $challenges,
            'submissions' => $submissions,
        ]);
    }
}
