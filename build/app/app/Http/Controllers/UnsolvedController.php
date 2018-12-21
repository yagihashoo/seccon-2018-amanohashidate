<?php

namespace App\Http\Controllers;

use App\Challenge;

class UnsolvedController extends Controller
{
    public function index()
    {
        $challenges = Challenge::where('status', 'VERIFIED')->orderBy('id', 'asc')->get()->toArray();

        $res = implode("\n", array_column($challenges, 'title'));
        return response($res, 200)->header('Content-Type', 'text/plain');
    }
}
