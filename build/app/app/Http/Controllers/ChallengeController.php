<?php

namespace App\Http\Controllers;

use App\Jobs\ChallengeVerify;
use App\Submit;
use App\Challenge;
use App\Jobs\ChallengeAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use App\Team;

class ChallengeController extends Controller
{
    public function index()
    {
        return view('top')->with([
            'challenges' => Challenge::where('status', 'VERIFIED')->orderBy('challenges.id', 'asc')
                ->leftJoin('teams', 'challenges.from_ip2', '=', 'teams.id')
                ->get(['title', 'challenges.id as id', 'teams.id as team_id', 'teams.name as team_name']),
        ]);
    }

    public function detail($id)
    {
        $challenge = Challenge::findOrFail($id);

        if ($challenge['status'] === Challenge::$status_solved) {
            abort(403);
        }

        return view('challenge')->with([
            'challenge' => $challenge,
            'team' => Team::where('id', $challenge->from_ip2)->first(),
        ]);
    }

    public function answer($id)
    {
        $challenge = Challenge::findOrFail($id);
        $payload = Request::input('payload');
        $from_ip = explode('.', $_SERVER['REMOTE_ADDR']);

        if ($challenge['status'] === Challenge::$status_solved) {
            abort(403);
        }

        if (!$payload) {
            abort(400);
        }

        if ($challenge->from_ip2 === $from_ip[2]) {
            Request::session()->flash('error', 'This is the challenge of your team');
        } else {
            $submit = Submit::create([
                'payload' => $payload,
                'user_id' => Auth::user()->id,
                'challenge_id' => $id,
                'from_ip' => implode('.', $from_ip),
            ]);

            ChallengeAnswer::dispatch($challenge->id, $payload, $submit->id);

            Request::session()->flash('message', 'Queued, wait a while');
        }
        return redirect("/challenge/{$id}");
    }

    public function upload()
    {
        return view('upload')->with([
            'isUpdate' => false,
            'challenge' => null,
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $title = Request::input('title');
        $html = Request::input('html');
        $model_answer = Request::input('model_answer');
        $from_ip = explode('.', $_SERVER['REMOTE_ADDR']);

        $existingChallenge = Challenge::where('from_ip2', $from_ip[2])
            ->whereIn('status', [
                Challenge::$status_verified,
            ])->get();

        if (sizeof($existingChallenge) > 0) {
            Request::session()->flash('error', 'The challenge of your team is still alive');
        } else {
            $challenge = Challenge::create([
                'setter_id' => $user->id,
                'title' => $title,
                'html' => $html,
                'model_answer' => $model_answer,
                'from_ip0' => $from_ip[0],
                'from_ip1' => $from_ip[1],
                'from_ip2' => $from_ip[2],
                'from_ip3' => $from_ip[3],
            ]);

            ChallengeVerify::dispatch($challenge->id, $model_answer)->onQueue('verify');
            Request::session()->flash('message', 'Queued, wait a while for verification');
        }
        return redirect("/upload");
    }

    public function updateIndex($id)
    {
        $challenge = Challenge::findOrFail($id);

        if ($challenge['status'] !== Challenge::$status_verified) {
            abort(403);
        }

        if ($challenge['setter_id'] !== Auth::user()->id) {
            abort(403);
        }

        return view('upload')->with([
            'isUpdate' => true,
            'challenge' => $challenge,
        ]);
    }

    public function update($id)
    {
        $challenge = Challenge::findOrFail($id);
        $title = Request::input('title');
        $model_answer = Request::input('model_answer');

        if ($challenge['setter_id'] !== Auth::user()->id) {
            abort(403);
        }

        if ($challenge['status'] !== Challenge::$status_verified) {
            abort(403);
        }

        if (!$title or $title === $challenge->title) {
            abort(400);
        }

        $challenge->update([
            'title' => $title,
            'status' => Challenge::$status_none,
        ]);

        ChallengeVerify::dispatch($challenge->id, $model_answer)->onQueue('verify');

        return redirect("/me");
    }

    public function download($id)
    {
        $challenge = Challenge::findOrFail($id);

        if ($challenge['status'] === Challenge::$status_solved) {
            abort(403);
        }

        return response($challenge['html'], 200)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', sprintf('attachment; filename="%s.html"', $id));
    }

    public function rule()
    {
        return view('rule');
    }
}
