<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
    public function likePost(Request $request, $post_id){
        $user = Auth::user();
        $exists = Like::where('post_id', $post_id)->where('user_id', $user)->exists();

        if(!$exists){
            $post = Post::findOrFail($post_id);
            $like = new Like();
            $like->post()->associate($post);
            $like->user()->associate($request->user());
            $like->save();
        }
        else{
            $like = Like::where('post_id', $post_id)->first();
            $like->delete();
        }
        return redirect()->back();
    }

    public function countLike($post_id){
        dd($post_id);
        return view('front.posts.index', compact('sayi'));
    }
}
