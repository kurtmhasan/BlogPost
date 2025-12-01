<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $posts=Post::all();
    $comments=Comment::all();
    return view('adminPanel.index', compact('posts','comments'));
}
    public function AdminUserList()
    {
        $users = User::query();
        return DataTables::of($users)->addColumn('action', function ($user) {
                return $user->id;
            })->rawColumns(['action'])->make(true);
    }


public function AdminUserListPage(){
return view('adminPanel.users.userList');
}

    public function AdminDeletePost($id){
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
    public function AdminDeleteComment($id){
        $comment = Comment::findorFail($id);
        $comment->delete();
        return redirect()->back();
    }
    public function BanUser($id){
        $user = User::findorFail($id);
        if($user->is_active){
            $user->is_active = false;
            $user->save();
        }else{
            $user->is_active = true;
            $user->save();
        }
        return redirect()->back();
    }

}
