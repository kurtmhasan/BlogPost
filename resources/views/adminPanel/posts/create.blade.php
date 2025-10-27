@extends('front.layouts.app')
@section('content')

    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; z-index: 1000; background: rgba(255,255,255,0.9);">
        <div style="width: 400px;">
            <div class="card p-3">
                <h5 class="card-header">Paylaşım Yap</h5>
                <div class="card-body">
                    <form action="{{ route('post.add') }}" method="POST">
                        @csrf
                        <textarea class="form-control mb-2" placeholder="Ne düşünüyorsun" name="content" rows="3"></textarea>
                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-primary">Paylaş</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

