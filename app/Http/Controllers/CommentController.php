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

                $user_comment_by_posts = Comment::where('user_id', $user->id)->orderBy('created_at', 'desc')->get()->groupBy('post_id');

                /*
                $commentArr = [];
                foreach($user_comment_by_posts as $post){
                    $tempArr = [];
                    foreach($post as $comment){
                        $tempArr[] = $comment;
                    }
                    $commentArr[] = ['post_id' => $post, 'comments' => $tempArr];
                }
*/

      /*  $commentArr = [];
        foreach($user_comment_by_posts as $post => $comments){
            $commentArr[] = ['post_id' => $post, 'comments' => $comments->all()];
            }
                dd($commentArr);*/

        $user = Auth::user();
        $posts =$user->comments()->with('post')->latest()->get()->groupBy('post_id');
        return view('front.myComments.showMyComments', compact('posts', 'user'));
    }

}
