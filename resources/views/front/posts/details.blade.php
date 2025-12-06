@extends('front.layouts.app')

@section('content')

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
                <img src="https://via.placeholder.com/400x250?text=Görsel+Yok"
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


            </div>
        </div>
                <div style="width:100%; max-width:600px; background:#fff; padding:20px; border-radius:10px; color:#000;">
                    <div class="comment-wrapper">
                        <h3>Yorumlar</h3>

                        @foreach($comments as $commentData)
                            @include('front.posts.partials.comment', ['commentData' => $commentData])
                        @endforeach


                    </div>
                </div>


                <small class="text-muted">Paylaşıldı: {{ $post->created_at->diffForHumans() }}</small>
                    </div>
        </div>

    </div>
@endsection
