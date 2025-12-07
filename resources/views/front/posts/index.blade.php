@extends('front.layouts.app')
@section('content')

    <div id="post-wrapper" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        overflow-y: auto; padding: 20px;
        z-index: 1000; background: rgba(255,255,255,0.9);">

        <div class="container" style="max-width: 1100px;">

            <div class="row justify-content-center">

                {{-- 1. SOL/ORTA SÜTUN: POSTLAR (Col-lg-7) --}}
                <div class="col-lg-7 col-md-10">

                    @if(session('success'))
                        <script>
                            alert("{{ session('success') }}");
                        </script>
                    @endif

                    {{-- Postların yükleneceği alan --}}
                    <div id="post-data">
                        @include('front.posts.partials.posts')
                    </div>

                    {{-- Yükleniyor göstergesi --}}
                    <div class="text-center my-4" id="loading" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Yükleniyor...</span>
                        </div>
                    </div>
                </div>

                {{-- 2. SAĞ SÜTUN: HABER WIDGET (Col-lg-4) --}}
                {{-- d-none d-lg-block: Mobilde gizler, sadece geniş ekranda gösterir --}}
                <div class="col-lg-4 d-none d-lg-block">

                    {{-- Sticky: Sayfa aşağı kaydırılsa bile haberler sabit kalır --}}
                    <div style="position: sticky; top: 20px;">

                        {{-- Az önce yazdığımız haber bileşenini buraya dahil ediyoruz --}}
                        {{-- Dosya adını kendine göre düzenle: örn: front.widgets.news --}}
                        @include('front.widgets.news-widget')

                    </div>
                </div>

            </div> </div> </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let page = 1;
        let loading = false;
        let hasMore = true;

        // Container scroll event
        let container = $('#post-wrapper');

        container.scroll(function() {
            if (loading || !hasMore) return;

            if (container.scrollTop() + container.innerHeight() >= container[0].scrollHeight - 200) {
                loadMore();
            }
        });

        function loadMore() {
            loading = true;
            $('#loading').show();

            page++;
            $.ajax({
                url: "{{ route('index') }}?page=" + page,
                type: 'get',
                success: function(response) {
                    if ($.trim(response) === '') {
                        hasMore = false;
                    } else {
                        $('#post-data').append(response);
                    }
                },
                complete: function() {
                    loading = false;
                    $('#loading').hide();
                },
                error: function() {
                    console.error("Postlar yüklenirken hata oluştu.");
                }
            });
        }
    </script>

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
