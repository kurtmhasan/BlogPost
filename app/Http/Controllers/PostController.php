<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
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

        $request->validate([
            'content'=>'required|max:255|min:3',
        ]);

        $post = Post::findOrFail($id);
        $post->content = $request->content;
        $post->save();
        return redirect()->route('show.my.posts')->with('edit', 'Başarıyla Düzenledin');
    }
    public function showEditPage(request $request, $id){
        $post = Post::findOrFail($id);
        return view('adminPanel.posts.edit',compact('post'));

    }

    public function showPostDetails($id){
        $post = Post::findOrFail($id);
        //$comments = Comment::with('post')->where('post_id', $id)->get();
       // $comments = $post->comments()->latest()->get();
        $comments = $this->getComments($id);
        return view('front.posts.details',compact('post', 'comments'));
    }
  /*  public function getCommentTree($post_id=1)
    {
        // Yorumları al
        $comments = Comment::with('user')
            ->where('post_id', $post_id)
            ->get()
            ->toArray();

        // ID'ye göre indeksle
        $byParent = [];
        foreach ($comments as $comment) {
            $byParent[$comment['parent_id']][] = $comment;
        }

        // Recursive fonksiyon
        $buildTree = function ($parentId) use (&$buildTree, &$byParent) {
            $branch = [];

            if (!isset($byParent[$parentId])) {
                return $branch;
            }

            foreach ($byParent[$parentId] as $comment) {
                $comment['children'] = $buildTree($comment['id']);
                $branch[] = $commBVent;
            }

            return $branch;
        };

        $tree = $buildTree(null); // root seviyesindeki yorumlar (parent_id = null)
dd($tree);
        return response()->json([
            'success' => true,
            'data' => $tree
        ]);
    }
*/

    function commentJsonBuilder($comments)
    {
        $arr=[];
        foreach ($comments as $comment) {
            $sub = null;
            if (Comment::where('parent_id', $comment->id)->count() > 0){
                $sub = $this->commentJsonBuilder(Comment::where('parent_id', $comment->id)->get());
            }
            array_push($arr, ['comment'=>$comment, 'subComment' =>$sub]);
        }

        return $arr;
    }



    function getComments($post_id)
    {
        $comments = Comment::where('Post_id',$post_id)->where('sub', 0)->get();
        return $this->commentJsonBuilder($comments);
    }

}
