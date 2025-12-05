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
                @if(session('unliked'))
                <script>
                    alert("{{ session('unliked') }}");
                </script>
            @endif

                @foreach($likes as $like)
                    <div class="card mb-10">
                        <a href="{{ route('show.profile', $like->user->id) }}"  class="fw-bold fs-5 m-5" style="color: black; text-decoration: none;">{{ $like->post->user->name}}</a>

                        <div class="card-body d-flex justify-content-between align-items-center">
                            <p class="fw-bold fs-5 mb-0">{{ $like->post->content }}</p>
                            <button type="button"
                                    class="btn btn-danger d-flex align-items-center like-btn"
                                    data-id="{{ $like->post->id }}"
                                    data-url="{{ route('like.post', $like->post->id) }}">
                                <i class="menu-icon tf-icons bx bx-heart-circle"></i>
                                <span class="text-truncate ms-1">Like</span>
                            </button>


                        </div>


                        <form action="{{ route('comment.add', $like->post->id ) }}" method="POST">
                            @csrf
                            <input type="text" name="body" class="form-control mb-1" placeholder="Yorum yap…">
                            <button type="submit" class="btn btn-outline-primary">Gönder</button>
                        </form>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <a href="{{ route('show.post.details', $like->post->id) }}" class="text-decoration-none small text-secondary p-3">Detay</a>
                            <p>
                                Like:<span id="like-count-{{ $like->post->id }}">
                                {{ $like->post->likes()->count() }}
                                </span>
                            </p>


                        </div>
                        <small class="text-muted">Paylaşıldı: {{ $like->post->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Click event handler
            $(document).on('click', '.like-btn', function(e) {
                e.preventDefault();

                let $btn = $(this);
                let postId = $btn.data('id');
                let url = $btn.data('url') || $btn.attr('href');

                if (!url) {
                    console.error('Like URL not found for post', postId);
                    return;
                }

                // Görsel olarak kısa süreli disable et
                $btn.prop('disabled', true);

                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                }).done(function(response) {
                    // Like sayısını güncelle
                    if (response.likeCount !== undefined) {
                        $('#like-count-' + postId).text(response.likeCount);
                    }

                    // Buton rengini değiştir
                    if (response.liked || response.status === 'liked') {
                        $btn.removeClass('btn-outline-danger').addClass('btn-danger');
                    } else {
                        $btn.removeClass('btn-danger').addClass('btn-outline-danger');
                    }
                }).fail(function(xhr) {
                    console.error('Like error:', xhr.status, xhr.responseText);
                    if(xhr.status === 401) alert("Giriş yapmanız gerekiyor.");
                    else alert("Bir hata oluştu: " + xhr.status);
                }).always(function() {
                    // Butonu tekrar aktif et
                    $btn.prop('disabled', false).css('pointer-events', '');
                });
            });
        });
    </script>
@endsection


