<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment(Request $request, $post_id){
        //dd($request->all());
        $request->validate([
                'body'=>'required|max:255|min:3',
            ]);
     //   dd($request->body);
        $comment = new Comment();
        $comment->user()->associate(Auth::user());
        $comment->post_id = $post_id;
        $comment->body = $request->body;
        $comment->save();
        return redirect()->back()->with('success', 'Yorumladın');
    }

    public function showMyComments(){
        $user = Auth::user();
     //   $comments= Comment::with('post')->where('user_id', $user->id)->get();
         // $comments = $user->comments()->with('post')->latest()->get();
        $posts =$user->comments()->with('post')->latest()->get()->groupBy('post_id');
        //$i=0;
        // dd($comments[2]->post->user->name);
     //  dd($comments->toArray());
        return view('front.myComments.showMyComments', compact('posts', 'user'));
    }

}
