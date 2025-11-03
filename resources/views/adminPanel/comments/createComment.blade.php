{{-- createComment.blade.php --}}

@extends('front.layouts.app')
@section('content')

    <div style="position: fixed; ...">
        <div style="width: 400px;">
            <div class="card p-3">
                {{-- Başlığı daha anlamlı hale getirin --}}
                <h5 class="card-header">'{{ $comment->body }}' yorumuna yanıt ver</h5>
                <div class="card-body">

                    {{-- 1. HATA DÜZELTİLDİ: Action'a $post->id yollanıyor --}}
                    <form action="{{ route('comment.add', $post->id) }}" method="POST">
                        @csrf

                        {{-- 3. HATA DÜZELTİLDİ: Textarea adı 'body' yapıldı --}}
                        <textarea class="form-control mb-2"
                                  placeholder="Yanıtını yaz..."
                                  name="body"
                                  rows="3"></textarea>

                        {{-- 2. HATA DÜZELTİLDİ: Gerekli gizli alanlar eklendi --}}
                        <input type="hidden" name="main_comment_id" value="{{ $comment->id }}">
                        <input type="hidden" name="sub" value="true">

                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-primary">Yanıtla</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
