<?php

namespace App\Http\Controllers;

use App\Jobs\ChallengeVerify;
use App\Submit;
use App\Challenge;
use App\Jobs\ChallengeAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        return view('top')->with([
            'challenges' => Challenge::where('status', 'VERIFIED')->orderBy('id', 'asc')->get()->toArray(),
        ]);
    }

    public function detail($id)
    {
        $challenge = Challenge::findOrFail($id);

        if ($challenge['solved']) {
            abort(403);
        }

        return view('challenge')->with([
            'challenge' => $challenge,
        ]);
    }

    public function answer($id)
    {
        $challenge = Challenge::findOrFail($id);
        $payload = Request::input('payload');

        if ($challenge['solved']) {
            abort(403);
        }

        if (!$payload) {
            abort(400);
        }

        $submit = Submit::create([
            'payload' => $payload,
            'user_id' => Auth::user()->id,
            'challenge_id' => $id,
        ]);

        ChallengeAnswer::dispatch($challenge, $payload, $submit);
        return redirect("/challenge/{$id}");
    }

    public function new()
    {
        // TODO: Implement proper access control based on Team IP

        ChallengeVerify::dispatch()->onQueue('verify');
        return redirect("/");
    }

    public function download($id)
    {
        $challenge = Challenge::findOrFail($id);

        if ($challenge['solved']) {
            abort(403);
        }

        return response($challenge['html'], 200)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', sprintf('attachment; filename="%s.html"', $id));
    }
}
