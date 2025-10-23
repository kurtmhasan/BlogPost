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
                        @if(!empty($posts))
                            @foreach($posts as $post)
                                <div class="card mb-10">
                                    <p class="fw-bold fs-5 m-5">Paylaşan: {{ $post->user->name}}</p>
                                    <div class="card-body">
                                        <p class="fw-bold fs-5">{{ $post->content }}</p>
                                    </div>
                                    <form action="{{ route('post.delete', $post->id) }}" method="POST">
                                        @csrf
                                        @METHOD('DELETE')
                                        <button type="submit" class="btn rounded-pill btn-danger">Sil</button>
                                    </form>
                                    <form action="{{route('show.edit.page', $post->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn rounded-pill btn-warning mt-3">Düzenle</button>
                                    </form>
                                    <a href="" class="text-decoration-none small text-secondary p-3">Detay</a>
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
