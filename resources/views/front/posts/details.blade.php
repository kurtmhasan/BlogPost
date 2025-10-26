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
                    <div class="card mb-10">
                        <a href="{{ route('show.profile') }}"  class="fw-bold fs-5 m-5" style="color: black; text-decoration: none;">{{ $post->user->name}}</a>
                        <div class="card-body">
                            <p class="fw-bold fs-5">{{ $post->content }}</p>
                        </div>

                        <h6 class="fw-bold mb-2">Yorumlar</h6>
                            @foreach($comments as $comment)
                                @if($comment->post->id == $post->id)
                                <div class="card-footer bg-white">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item" style="border-bottom: 1px solid #dee2e6;">
                                            {{ $comment->body }}
                                        </li>
                                    </ul>
                                </div>
                            @endif
                            @endforeach
                        <small class="text-muted">Paylaşıldı: {{ $post->created_at->diffForHumans() }}</small>
                    </div>
        </div>

    </div>
@endsection
