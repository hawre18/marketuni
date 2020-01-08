<?php

namespace App\Http\Controllers\Backend;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments=Comment::with('user')->orderBy('created_at','desc')->paginate(30);
        return view('admin.comments.index',compact(['comments']));
    }
}
