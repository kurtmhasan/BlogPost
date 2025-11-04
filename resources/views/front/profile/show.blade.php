@extends('front.layouts.app')

@section('content')

    <!-- Profil Kartı (Üst Kısım) -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                    src="https://placehold.co/100x100/343840/FFFFFF?text={{ substr($user->name ?? 'U', 0, 1) }}"
                    alt="User Avatar"
                    class="d-block rounded"
                    height="100"
                    width="100"
                    id="uploadedAvatar" />
                <div class="button-wrapper">
                    <h4 class="text-black mb-0">{{ $user->name ?? 'Kullanıcı Adı' }}</h4>
                    <p class="text-muted mb-2"> \&#64;{{ $user->username ?? 'kullaniciadi' }}</p>
                    <div class="d-flex gap-3">
                        <div class="text-center">
                            <small class="text-black fw-semibold">Post</small>
                            <h5 class="text-black mb-0">{{ $user->posts_count ?? 0 }}</h5>
                        </div>
                        <div class="text-center">
                            <small class="text-black fw-semibold">Yorum</small>
                            <h5 class="text-black mb-0">{{ $user->comments_count ?? 0 }}</h5>
                        </div>
                        <div class="text-center">
                            <small class="text-black fw-semibold">Beğeni</small>
                            <h5 class="text-black mb-0">{{ $user->likes_count ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kullanıcı Aktivitesi (Postlar, Yorumlar, Beğeniler) -->
    <div class="nav-align-top mb-4">
        <ul class="nav nav-tabs nav-fill" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profile-posts" aria-controls="navs-profile-posts" aria-selected="true">
                    <i class="tf-icons bx bx-envelope me-1"></i> Postlar
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profile-comments" aria-controls="navs-profile-comments" aria-selected="false">
                    <i class="tf-icons bx bx-reply me-1"></i> Yorumlar
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profile-likes" aria-controls="navs-profile-likes" aria-selected="false">
                    <i class="tf-icons bx bx-heart-circle me-1"></i> Beğenilenler
                </button>
            </li>
        </ul>

        <div class="tab-content p-3">
            <!-- Postlar Tabı -->
            <div class="tab-pane fade show active" id="navs-profile-posts" role="tabpanel">
                @forelse ($user->posts ?? [] as $post)
                    <div class="card text-black mb-3">
                        <div class="card-body">
                            <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            <a href="{{route('show.post.details', $post->id)}}" class="btn btn-sm btn-outline-primary float-end">Detay</a>
                        </div>
                    </div>
                @empty
                    <div class="text-center p-4">
                        <p class="text-muted">Bu kullanıcının henüz hiç postu yok.</p>
                    </div>
                @endforelse
            </div>

            <!-- Yorumlar Tabı -->
            <div class="tab-pane fade" id="navs-profile-comments" role="tabpanel">
                @forelse ($user->comments ?? [] as $comment)
                    <div class="card  text-black mb-3">
                        <div class="card-body">
                            <p class="card-text">"{{ $comment->body }}"</p>
                            <small class="text-muted">
                                <a href="{{route('show.post.details', $comment->post->id)}}" class="text-muted">
                                    {{ $comment->post->title ?? 'İlgili Post' }}
                                </a>
                                için {{ $comment->created_at->diffForHumans() }} yazdı.
                            </small>
                        </div>
                    </div>
                @empty
                    <div class="text-center p-4">
                        <p class="text-muted">Bu kullanıcının henüz hiç yorumu yok.</p>
                    </div>
                @endforelse
            </div>

            <!-- Beğenilenler Tabı -->
            <div class="tab-pane fade" id="navs-profile-likes" role="tabpanel">
                @forelse ($likes ?? [] as $like)
                    <div class="card bg-dark text-white mb-3">
                        <div class="card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">beğenilen post: {{ $like->post->content ?? 'Bilinmiyor' }}</small>
                                </div>
                                <a href="{{route('show.post.details',$like->post_id)}}" class="btn btn-sm btn-outline-primary">Posta Git</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center p-4">
                        <p class="text-muted">Bu kullanıcı henüz hiçbir postu beğenmemiş.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
