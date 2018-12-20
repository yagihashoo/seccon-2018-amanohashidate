<?php

namespace App\Http\Controllers;

use App\Jobs\ChallengeVerify;
use Illuminate\Http\Request;
use App\Challenge;
use App\Jobs\ChallengeAnswer;

class ChallengeController extends Controller
{
    public function index()
    {
        return view('top')->with([
            'challenges' => Challenge::where('status', 'VERIFIED')->where('solved', false)->orderBy('id', 'asc')->get()->toArray(),
        ]);
    }

    public function detail($id)
    {
        return view('challenge')->with([
            'challenge' => Challenge::findOrFail($id),
        ]);
    }

    public function answer($id)
    {
        // TODO: Implement proper access control
        $challenge = Challenge::findOrFail($id);
        ChallengeAnswer::dispatch($challenge, 'alert("XSS")');
        return redirect("/challenge/{$id}");
    }

    public function new()
    {
        // TODO: Implement proper access control based on Team IP

        ChallengeVerify::dispatch()->onQueue('verify');
        return redirect("/");
    }
}
