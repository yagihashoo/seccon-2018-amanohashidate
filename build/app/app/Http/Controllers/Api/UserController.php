<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function me()
    {
        return response(Auth::user());
    }

    public function index(Request $request)
    {
        $this->authorize('index', User::class);

        $limit = (min(Input::get('limit'), 100) ?? 100) + 1;
        $offset = Input::get('offset') ?? 0;

        $users = User::limit($limit)->offset($offset)->orderBy('name')->get()->toArray();
        $hasNext = (sizeof($users) === $limit && array_pop($users) !== null);

        return response([
            'users' => $users,
            'hasNext' => $hasNext,
        ]);
    }

    public function show(User $user)
    {
        return response($user);
    }

}
