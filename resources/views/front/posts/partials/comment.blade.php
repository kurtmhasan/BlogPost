<div style="border:1px solid #ddd; border-radius:8px; padding:10px; margin-bottom:10px;">
    <p><strong>{{ $commentData['comment']->user->name ?? 'Anonim' }}</strong></p>
    <p style="{{ $commentData['comment']->body === 'Admin tarafından silindi' ? 'font-style: italic; color: #888;' : '' }}">
        {{ $commentData['comment']->body }}
    </p>

@if(Auth::user()->role=='admin')
        <div class="d-flex gap-2">
        <form action="{{ route('admin.updateComment', $commentData['comment']->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-warning">Sil</button>
        </form>

        <form action="{{ route('admin.deleteComment', $commentData['comment']->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">kaldır</button>
        </form>
        </div>
    @endif
    @if(!empty($commentData['subComment']))
        <div style="margin-left:20px; margin-top:8px; border-left:2px solid #eee; padding-left:10px;">
            @foreach($commentData['subComment'] as $child)
                @include('front.posts.partials.comment', ['commentData' => $child])
            @endforeach
        </div>
    @endif
</div>
