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
            @if(!empty($posts))
                @foreach($posts as $post)
                    <div class="card mb-10">
                        <a href=""  class="fw-bold fs-5 m-5" style="color: black; text-decoration: none;">{{ $post->user->name}}</a>

                        <div class="card position-relative p-3 mb-3">
                            <!-- Sil butonu sağ üstte -->
                            <form action="{{ route('admin.post.delete', $post->id) }}" method="POST" class="position-absolute" style="top: 10px; right: 10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                            </form>

                            <div class="card-body">
                                <p class="fw-bold fs-5 mb-0">{{ $post->content }}</p>
                            </div>

                            <div class="card-body d-flex justify-content-between align-items-center">
                                <a href="{{ route('show.post.details', $post->id) }}" class="text-decoration-none small text-secondary">Detay</a>
                                <p>Like: {{ $post->likes()->count() }}</p>
                            </div>

                            <small class="text-muted">Paylaşıldı: {{ $post->created_at->diffForHumans() }}</small>
                        </div>
                @endforeach
            @else
                <p class="fw-bold fs-5">Dostum Önce bir şeyler paylaş</p>
                <form action="{{ route('post.create') }}">
                    <div class="text-end">
                        <button type="submit" class="btn rounded-pill btn-primary">Paylaşım yappp</button>
                    </div>
                </form>
            @endif
        </div>

    </div>
@endsection
