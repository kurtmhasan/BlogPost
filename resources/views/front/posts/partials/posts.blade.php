@if(!empty($posts))
    @foreach($posts as $post)
        <div class="card mb-4">
            <a href="{{ route('show.profile', $post->user->id) }}"
               class="fw-bold fs-5 m-3"
               style="color: black; text-decoration: none;">
                {{ $post->user->name }}
            </a>

            <div class="card-body d-flex justify-content-between align-items-center">
                <p class="fw-bold fs-5 mb-0">{{ $post->content }}</p>
                <a href="{{ route('like.post', $post->id) }}"          {{-- fallback URL --}}
                data-url="{{ route('like.post', $post->id) }}"    {{-- AJAX için sağlam URL --}}
                   class="btn d-flex align-items-center like-btn {{ $post->isLiked ? 'btn-danger' : 'btn-outline-danger' }}"
                   data-id="{{ $post->id }}">
                    <i class="menu-icon tf-icons bx bx-heart-circle"></i>
                    <span class="text-truncate ms-1">Like</span>
                </a>

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
                <span id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>
            </div>

            <small class="text-muted ms-3 mb-2">Paylaşıldı: {{ $post->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
@endif

