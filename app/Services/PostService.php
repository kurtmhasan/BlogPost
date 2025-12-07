<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getLatestPosts($perPage = 3)
    {
        return Post::with('user')
            ->withExists(['likes as is_liked' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
    public function handleViewIncrements($posts)
    {
        // Ekrana basılan postların ID'lerini al
        $postIds = $posts->pluck('id')->toArray();

        // session tarayıcıdaki depomuz o depodan daha önce görülen idleri çekiyoruz
        $seenKey = 'seen_posts';
        $seenPosts = session()->get($seenKey, []);

        // ekrana basılan post idler - session dan gelen idler
        $newIdsToIncrement = array_diff($postIds, $seenPosts);

        //  Eğer artırılacak yeni bir post varsa işlem yap
        if (!empty($newIdsToIncrement)) {
            // Veritabanı Optimizasyonu:
            // Döngüye girip tek tek update atmak yerine "WHERE IN" ile toplu güncelleme yapıyoruz.
            Post::whereIn('id', $newIdsToIncrement)->increment('views');

            //  Session'ı güncelle ki kullanıcı F5 atarsa sayı tekrar artmasın
            session()->put($seenKey, array_merge($seenPosts, $newIdsToIncrement));
        }
    }
}
