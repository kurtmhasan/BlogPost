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
                <div class="card mb-4 shadow-sm rounded-3">
                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                    <div>
                        <a href="{{route('show.profile')}}" class="fw-bold text-decoration-none text-dark">
                            Kullanıcı Adı:{{ $post->user->name }}
                        </a>
                    </div>
                    <small class="text-muted">{{$post->created_at->diffForHumans()}}</small>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        {{ $post->content }}
                    </p>
                </div>
                </div>

                        <h6 class="fw-bold mb-2">Yorumlar</h6>
                            @foreach($comments as $comment)
                                @if($comment->post->id == $post->id)
                                <div class="card mb-4 shadow-sm rounded-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item" style="border-bottom: 1px solid #dee2e6;">
                                            {{$comment->user->name}}:
                                            {{ $comment->body }}<br>
                                            {{ $comment->created_at->diffForHumans() }}
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
