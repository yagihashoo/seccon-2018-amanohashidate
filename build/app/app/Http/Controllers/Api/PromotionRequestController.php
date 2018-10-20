<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\PromotionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PromotionRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('index', PromotionRequest::class);

        $limit = (min(Input::get('limit'), 100) ?? 100) + 1;
        $offset = Input::get('offset') ?? 0;

        $promotion_reqs = PromotionRequest::where('done', false)->limit($limit)->offset($offset)->orderBy('created_at', 'asc')->get()->toArray();
        $hasNext = (sizeof($promotion_reqs) === $limit && array_pop($promotion_reqs) !== null);

        return response([
            'promotion_reqs' => $promotion_reqs,
            'hasNext' => $hasNext,
        ]);
    }

    public function show(PromotionRequest $promotionRequest)
    {
        return response($promotionRequest);
    }

    public function create(Request $request)
    {
        $this->authorize('create', PromotionRequest::class);

        return response(PromotionRequest::create([
            'user_id' => Auth::user()->id,
        ]));
    }

    public function update(Request $request, PromotionRequest $promotionRequest)
    {
        $this->authorize('update', PromotionRequest::class);

        $done = $request->input('promotionRequest');

        $promotionRequest->done = $done;
        $promotionRequest->save();
    }

}
