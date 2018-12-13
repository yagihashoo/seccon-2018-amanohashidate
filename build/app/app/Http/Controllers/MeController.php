<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    public function index()
    {
        return view('me')->with('user', Auth::user());
    }
}
