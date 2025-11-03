@extends('front.layouts.app')

@section('content')

    <!-- Full screen wrapper, card’lar burada ortalanacak -->
    <div  style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            display: flex; justify-content: center;
            overflow-y: auto; padding: 20px;
            z-index: 1000; background: rgba(255,255,255,0.9);">
        <div style="width: 100%; max-width: 600px;">
            @if(session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif

                @foreach($likes as $like)
                    <div class="card mb-10">
                        <a href="{{ route('show.profile', $like->user->id) }}"  class="fw-bold fs-5 m-5" style="color: black; text-decoration: none;">{{ $like->post->user->name}}</a>

                        <div class="card-body d-flex justify-content-between align-items-center">
                            <p class="fw-bold fs-5 mb-0">{{ $like->post->content }}</p>
                            <a href="{{route('like.post', $like->post->id)}} " class="btn btn-outline-danger d-flex align-items-center">
                                <i class="menu-icon tf-icons bx bx-heart-circle"></i>
                                <span class="text-truncate ms-1" data-i18n="like">Like</span>
                            </a>
                        </div>


                        <form action="{{ route('comment.add', $like->post->id ) }}" method="POST">
                            @csrf
                            <input type="text" name="body" class="form-control mb-1" placeholder="Yorum yap…">
                            <button type="submit" class="btn btn-outline-primary">Gönder</button>
                        </form>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <a href="{{ route('show.post.details', $like->post->id) }}" class="text-decoration-none small text-secondary p-3">Detay</a>
                            <p>  Like: {{ $like->post->likes()->count()}}</p>
                        </div>
                        <small class="text-muted">Paylaşıldı: {{ $like->post->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
        </div>

    </div>
@endsection

