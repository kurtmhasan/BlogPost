@if(!empty($posts))
    @foreach($posts as $post)
        <div class="card mb-4">
            <a href="{{ route('show.profile', $post->user->id) }}"
               class="fw-bold fs-5 m-3"
               style="color: black; text-decoration: none;">
                {{ $post->user->name }}
            </a>

            <div class="card h-100">

                {{-- 1. BÖLÜM: RESİM ALANI (Body'nin dışına taşıdık) --}}
                @if($post->images->count() > 0)
                    <img src="{{ asset('storage/' . $post->images->first()->image_path) }}"
                         class="card-img-top"
                         alt="Post Resmi"
                         style="height: 250px; object-fit: cover; width: 100%;">
                @else
                    <img src="https://placehold.co/400x250?text=Gorsel+Yok"
                         class="card-img-top"
                         alt="Varsayılan Resim"
                         style="height: 250px; object-fit: cover; background-color: #eee;">
                @endif

                {{-- 2. BÖLÜM: İÇERİK VE ETKİLEŞİM (Body alanı) --}}
                <div class="card-body d-flex flex-column">

                    {{-- İçerik Metni (Esnek alan, butonu aşağı iter) --}}
                    <p class="card-text fw-bold fs-5 mb-4">
                        {{ $post->content }}
                    </p>

                    {{-- Buton Alanı (En alta yapışık ve sağa hizalı) --}}
                    <div class="mt-auto d-flex justify-content-end align-items-center">
                        <a href="{{ route('like.post', $post->id) }}"
                           data-url="{{ route('like.post', $post->id) }}"
                           class="btn like-btn d-flex align-items-center {{ $post->isLiked ? 'btn-danger' : 'btn-outline-danger' }}"
                           data-id="{{ $post->id }}">
                            <i class="menu-icon tf-icons bx bx-heart-circle fs-4"></i> {{-- İkon boyutunu düzelttim --}}
                            <span class="ms-2">Like</span>
                        </a>
                    </div>

                </div>
            </div>

            <form action="{{ route('comment.add', $post->id) }}" method="POST" class="p-3 pt-0">
                @csrf
                <input type="text" name="body" class="form-control mb-1" placeholder="Yorum yap…">
                <button type="submit" class="btn btn-outline-primary">Gönder</button>
            </form>

            <div class="card-body d-flex justify-content-between align-items-center">
                <a href="{{ route('show.post.details', $post->id) }}"
                   class="text-decoration-none small text-secondary p-3">
                    Detay
                </a>
                <span  id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>
            </div>

            <small class="text-muted ms-3 mb-2">Paylaşıldı: {{ $post->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
@endif

