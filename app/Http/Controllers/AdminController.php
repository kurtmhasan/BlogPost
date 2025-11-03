<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $posts=Post::all();
    $comments=Comment::all();
    return view('adminPanel.index', compact('posts','comments'));
}
    public function AdmindeletePost($id){
        $post = POST::findorFail($id);
        $post->delete();
        return redirect()->back()->with('success', 'Post başarıyla silindi.');

    }
    public function ChangeComment($id){
        $comment = Comment::findorFail($id);
        if($comment){
            $comment->body = 'Admin tarafından silindi';
            $comment->save();
        }
        return redirect()->back();
    }
    public function AdmindeleteComment($id){
        $comment = Comment::findorFail($id);
        $comment->delete();
        return redirect()->back();
    }

}
