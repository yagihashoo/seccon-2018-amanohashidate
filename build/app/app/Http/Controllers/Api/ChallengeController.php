<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Challenge;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $limit = (min(Input::get('limit'), 100) ?? 100) + 1;
        $offset = Input::get('offset') ?? 0;
        $filter = Input::get('filter');

        switch ($filter) {
            case 'solved':
                break;
            default:
                $filter = null;
        }

        if ($filter) {
            $challenges = Challenge::where('verified', true)->where($filter, false)->limit($limit)->offset($offset)->orderBy('created_at', 'desc')->get()->toArray();
        } else {
            $challenges = Challenge::where('verified', true)->limit($limit)->offset($offset)->orderBy('created_at', 'desc')->get()->toArray();
        }
        $hasNext = (sizeof($challenges) === $limit && array_pop($challenges) !== null);

        return response([
            'challenges' => $challenges,
            'hasNext' => $hasNext,
        ]);
    }

    public function show(Challenge $challenge)
    {
        return response($challenge);
    }

    public function create(Request $request)
    {
        // TODO: Implement team restriction
        $this->authorize('create', Challenge::class);

        $from_ip = $_SERVER['REMOTE_ADDR'];
        return response(Challenge::create([
            'setter_id' => Auth::user()->id,
            'file_id' => Uuid::generate(4)->string,
            'from_ip' => $from_ip,
        ]));
    }

    public function update(Request $request, Challenge $challenge)
    {
        $this->authorize('create', Challenge::class);
        $this->authorize('update', Challenge::class);

        $title = $request->input('challenge.title');
        $model_answer = $request->input('challenge.model_answer');
        $html = $request->input('challenge.html');

        $challenge->title = $title;
        $challenge->model_answer = $model_answer;
        $challenge->storeChallengeFile($html);
        $challenge->save();
    }

    public function verify(Challenge $challenge)
    {
        //
    }
}
