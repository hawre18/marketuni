<?php

namespace App\Http\Controllers\Backend;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index()
    {
        $comments=Comment::with('user')->orderBy('created_at','desc')->paginate(30);
        return view('admin.comments.index',compact(['comments','product']));
    }

    public function action(Request $request,$id)
    {
        if ($request->has('action')){
            if ($request->input('action')=='approved'){
            $comment=Comment::findorfail($id);
            $comment->status=1;
            $comment->save();
            }else{
            if($request->has('action')){
             $comment=Comment::findorfail($id);
             $comment->status=0;
             $comment->save();
                }
            }
            return redirect('/admins/comments');

        }

    }
    public function delete($id)
    {
        $comment=Comment::findorfail($id);
        $comment->delete();
        Session::flash('comments','برند با موفقیت حذف شد');
        return redirect('/admins/comments');

    }

}
