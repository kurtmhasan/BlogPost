@extends('adminPanel.layouts.admin')

@section('content')
    {{--
         DÜZELTME:
         height ve overflow kaldırıldı.
         Böylece içerik uzadıkça sayfa uzayacak, iç scrollbar oluşmayacak.
    --}}
    <div id="post-wrapper" style="max-width: 600px; margin: 0 auto; padding: 20px;">

        {{-- Session Success Alert --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Postların Listeleneceği Container --}}
        <div id="post-data">
            @include('adminPanel.posts.partials.posts', ['posts' => $posts])
        </div>

        {{-- Loading Spinner --}}
        <div class="text-center my-4" id="loading" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Yükleniyor...</span>
            </div>
        </div>

        {{-- Veri Bitti Mesajı --}}
        <div class="text-center my-4 text-muted" id="no-more-data" style="display: none;">
            <small>Daha fazla gönderi yok.</small>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let page = 1;
            let loading = false;
            let hasMore = "{{ $posts->hasMorePages() ? '1' : '0' }}" === "1";

            // ARTIK PENCEREYİ DİNLİYORUZ
            $(window).scroll(function() {
                if (loading || !hasMore) return;

                // Sayfanın en altına 100px kala tetikle
                // $(document).height() tüm sayfa yüksekliği
                // $(window).height() görünen ekran yüksekliği
                if($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    loadMore();
                }
            });

            function loadMore() {
                loading = true;
                $('#loading').show();
                page++;

                $.ajax({
                    url: "{{ route('admin.index') }}",
                    type: 'GET',
                    data: { page: page },
                    success: function(response) {
                        if ($.trim(response) === '') {
                            hasMore = false;
                            $('#no-more-data').show();
                            $('#loading').hide();
                        } else {
                            $('#post-data').append(response);
                            loading = false;
                            $('#loading').hide();
                        }
                    },
                    error: function() {
                        console.error("Yükleme hatası.");
                        loading = false;
                        $('#loading').hide();
                    }
                });
            }
        });
    </script>
@endsection
