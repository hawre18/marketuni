<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request,$productId,$userId)
    {
        $comment=new Comment();
        $comment->description=$request->description;
        $comment->user_id=$userId;
        $comment->created_at=now();
        $comment->status=0;
        $comment->product_id=$productId;
        $comment->save();
        return redirect('/');
    }
}
