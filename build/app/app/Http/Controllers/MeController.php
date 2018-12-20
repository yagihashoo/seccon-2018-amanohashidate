<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $challenges = Challenge::where('setter_id', $user->id)->orderBy('created_at', 'asc')->paginate(20);

        return view('me')->with('user', $user)->with('challenges', $challenges);
    }
}
