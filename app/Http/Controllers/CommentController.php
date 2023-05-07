<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Http\Resources\Resource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreRequest $request)
    {
        $userId = auth()->id();
        $commentIsExist = Comment::query()
            ->where('user_id', $userId)
            ->where('service_id', $request->serviceId)
            ->first();
        if($commentIsExist) {
            return (new Resource(false, ['Önceden bu servise yorum yapılmıştır.']))->response();
        }

        $comment = new Comment();
        $comment->description = $request->description;
        $comment->star = $request->star;
        $comment->user_id = $userId;
        $comment->service_id = $request->serviceId;
        $comment->save();

        return (new Resource(true))->response();
    }
}
