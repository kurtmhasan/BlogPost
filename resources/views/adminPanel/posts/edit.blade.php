@extends('front.layouts.app')

@section('content')

    <!-- Full screen wrapper, card’lar burada ortalanacak -->
    <div  style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            display: flex; justify-content: center;
            overflow-y: auto; padding: 20px;
            z-index: 1000; background: rgba(255,255,255,0.9);">
        <div style="width: 100%; max-width: 600px;">
            <!-- Database'den id'ye göre gelen post -->
            <div class="card mb-3">
                    <form action="{{ route('post.edit', $post->id) }}" method="POST">
                        @csrf
                        <!-- Post içeriği textarea içinde, kullanıcı düzenleyebilir -->
                        <textarea class="form-control mb-2" name="content" rows="3">{{ $post->content }}</textarea>
                        <button type="submit" class="btn btn-outline-primary">Kaydet</button>
                    </form>
                    <a href="" class="text-decoration-none small text-secondary p-3">Detay</a>
                    <small class="text-muted">Paylaşıldı: {{ $post->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    </div>
@endsection
