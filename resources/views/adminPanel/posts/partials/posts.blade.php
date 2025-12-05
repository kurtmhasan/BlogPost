@foreach($posts as $post)
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{route('admin.show.user',$post->user->id)}}" style="color: inherit; text-decoration: none;" >
            <span class="fw-bold fs-5">{{ $post->user->name }}</span>
            </a>
            {{-- Buton İşlemleri --}}
            <form action="{{ route('admin.ban.user', $post->user->id) }}" method="POST">
                @csrf
                @if($post->user->is_active)
                    <button type="submit" class="btn btn-sm btn-outline-danger">Banla</button>
                @else
                    <button type="submit" class="btn btn-sm btn-outline-primary">Ban Kaldır</button>
                @endif
            </form>
        </div>

        <div class="card-body position-relative">
            <form action="{{ route('admin.deletePost', $post->id) }}" method="POST" class="position-absolute" style="top: 1.25rem; right: 1.25rem;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
            </form>
            <p class="fw-bold fs-5 mb-0">{{ $post->content }}</p>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('show.post.details', $post->id) }}" class="text-decoration-none small text-secondary">Detay</a>
                <span class="text-muted ms-3">Like: {{ $post->likes_count }}</span>
            </div>
            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
        </div>
    </div>
@endforeach
