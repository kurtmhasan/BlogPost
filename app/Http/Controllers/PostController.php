<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function createPost(){
        return view('adminPanel.posts.create');
    }
    public function addPost(request $request){
     // dd($request->all);
        $request->validate([
        'content'=>'required|max:255|min:3',
    ]);
    $post = new Post();
    $post->content=$request->content;
    $post->user()->associate(Auth::user());
    $post->save();
        return redirect()->route('show.posts')->with('success', 'postaladın!');

    }

    public function showPosts(){
        $posts = Post::latest()->get();
        return view('front.posts.index',compact('posts'));
    }
    public function showMyPosts(){
        $posts = Auth::user()->posts()->latest()->get();
        return view('front.posts.show',compact('posts'));
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('show.my.posts')->with('delete', 'Başarıyla silindi');
    }
    public function editPost(request $request, $id){
        $post = Post::findOrFail($id);
        $post->content = $request->content;
        $post->save();
        return redirect()->route('show.my.posts')->with('edit', 'Başarıyla Düzenledin');
    }
    public function showEditPage(request $request, $id){
        $post = Post::findOrFail($id);
        return view('adminPanel.posts.edit',compact('post'));

    }
}
