@extends('front.layouts.app')

@section('content')

    <!-- Full screen wrapper, card’lar burada ortalanacak -->
    <div  style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            display: flex; justify-content: center;
            overflow-y: auto; padding: 20px;
            z-index: 1000; background: rgba(255,255,255,0.9);">
        <div style="width: 100%; max-width: 600px;">
            @if(session('delete'))
                <script>
                    alert("{{ session('delete') }}");
                </script>
            @endif
            <div class="card-body">
                @if(session('edit'))
                    <script>
                        alert("{{ session('edit') }}");
                    </script>
                @endif
                <!-- Database'den gelen postlar -->
                @if(!empty($comments))
                    @foreach($comments as $comment)
                            <div class="card mb-4 shadow-sm rounded-3">
                                <!-- Üst bölüm: kullanıcı adı + profil linki -->
                                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                    <div>
                                        <a href="#" class="fw-bold text-decoration-none text-dark">
                                            Kullanıcı Adı:{{ $comment->post->user->name }}
                                        </a>
                                    </div>
                                    <small class="text-muted">{{$comment->created_at->diffForHumans()}}</small>
                                </div>

                                <!-- Post içeriği -->
                                <div class="card-body">
                                    <p class="text-muted">
                                        {{ $comment->post->content }}

                                    </p>
                                </div>

                                <!-- Yorumlar -->
                                <div class="card-footer bg-white">
                                    <h6 class="fw-bold mb-2">Yorumlar</h6>
                                    <ul class="list-group list-group-flush">
                                            <li class="list-group-item">{{ $comment->body }}</li>

                                    </ul>
                                </div>
                            </div>
                    @endforeach


                    @else
                    <p class="fw-bold fs-5">Dostum önce yorum yapman lazım</p>
                    <form action="{{ route('post.create') }}">
                        <div class="text-end">
                            <button type="submit" class="btn rounded-pill btn-primary">Paylaşım yappp</button>
                        </div>
                    </form>
                @endif
            </div>

        </div>
@endsection
