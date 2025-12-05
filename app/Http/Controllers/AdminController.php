<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['user'])
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        if ($request->ajax()) {
            return view('adminPanel.posts.partials.posts', compact('posts'))->render();
        }

        return view('adminPanel.index', compact('posts'));
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
        return redirect()->back()->with('deleteP', 'Post başarıyla silindi.');

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
        return redirect()->back()->with('deleteC', 'Yorum başarıyla silindi.');
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

    public function AdminShowUser($id){
        $user = User::findorFail($id);
        return view('adminPanel.users.showUser', compact('user'));
    }

}
