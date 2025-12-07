<div class="card shadow-sm border-0">
    {{-- Başlık Kısmı --}}
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h5 class="card-title mb-0 d-flex align-items-center">
            <i class='bx bx-globe me-2 text-primary'></i>
            Teknoloji Gündemi
        </h5>
        <small class="text-muted">Canlı Akış</small>
    </div>

    <div class="card-body pt-2">
        <ul class="list-unstyled mb-0">

            {{-- Backend'den $news değişkeni gelip gelmediğini kontrol ediyoruz --}}
            @if(isset($news) && count($news) > 0)

                @foreach($news as $article)
                    <li class="mb-3 pb-3 border-bottom {{ $loop->last ? 'border-bottom-0 pb-0 mb-0' : '' }}">
                        <div class="d-flex align-items-start">

                            {{-- Varsa Küçük Resim (Thumbnail) --}}
                            @if(!empty($article['urlToImage']))
                                <img src="{{ $article['urlToImage'] }}"
                                     class="rounded me-3"
                                     alt="news-thumb"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                {{-- Resim yoksa placeholder ikon --}}
                                <div class="rounded me-3 d-flex align-items-center justify-content-center bg-light"
                                     style="width: 60px; height: 60px;">
                                    <i class='bx bx-image text-secondary fs-4'></i>
                                </div>
                            @endif

                            <div class="flex-grow-1">
                                {{-- Haber Başlığı ve Linki --}}
                                <a href="{{ $article['url'] }}" target="_blank" class="text-dark fw-semibold text-decoration-none d-block lh-sm mb-1" style="font-size: 0.9rem;">
                                    {{ $article['title'] }}
                                </a>

                                {{-- Meta Bilgiler (Kaynak ve Zaman) --}}
                                <div class="d-flex align-items-center text-muted" style="font-size: 0.75rem;">
                                    <span class="badge bg-label-primary me-2">{{ $article['source']['name'] }}</span>
                                    <span>
                                        {{ \Carbon\Carbon::parse($article['publishedAt'])->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach

            @else
                {{-- Veri Gelmezse veya API Hatası Olursa --}}
                <li class="text-center py-4 text-muted">
                    <i class='bx bx-wifi-off fs-1 mb-2'></i>
                    <p class="mb-0 small">Haber akışı şu an yüklenemiyor.</p>
                </li>
            @endif

        </ul>
    </div>

    {{-- Alt Bilgi --}}
    <div class="card-footer bg-light text-center py-2">
        <small class="text-muted" style="font-size: 0.7rem;">Powered by NewsAPI</small>
    </div>
</div>
