<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Services\PostService;
use App\Services\NewsService;

class PostController extends Controller
{
    public function index(Request $request, PostService $postService, NewsService $newsService)
    {
        // A. Postları Servisten Çek
        // Ayrıca isLiked döngüsüne de gerek kalmadı, servis bunu SQL içinde halletti.
        $posts = $postService->getLatestPosts(3);

        // B. Görüntülenme Sayısını Yönet
        $postService->handleViewIncrements($posts);

        if ($request->ajax() && $request->has('load_more')) {
            return view('front.posts.partials.posts', compact('posts'))->render();
        }

        $news = $newsService->getTechHeadlines();

        return view('front.posts.index', compact('posts', 'news'));
    }

    public function createPost(){
        return view('adminPanel.posts.create');
    }
    public function addPost(Request $request){

        $request->validate([
            'content' => 'required|max:255|min:3',
            'images' => 'array', // Opsiyonel: Gelen veri dizi olmalı
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Her bir dosya için kural
        ]);

    $post = new Post();
    $post->content=$request->content;
    $post->user()->associate(Auth::user());
    $post->save();
    if($request->hasfile('images')){
        foreach($request->file('images') as $image){
            $path = $image->store('images', 'public');
            $post->images()->create([
                'image_path' => $path
            ]);
        }
    }

        return redirect()->route('index')->with('success', 'postaladın!');

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
