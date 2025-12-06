@extends('front.layouts.app')
@section('content')

    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; z-index: 1000; background: rgba(255,255,255,0.9);">
        <div style="width: 400px;">
            <div class="card p-3">
                <h5 class="card-header">Paylaşım Yap</h5>
                <div class="card-body">
                    <form action="{{ route('post.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <textarea name="content"
                                  class="form-control @error('content') is-invalid @enderror"
                                  rows="3">{{ old('content') }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="text-end">
                            <div class="mb-3">
                                <input type="file" name="images[]" multiple
                                       class="form-control @error('images') is-invalid @enderror">

                                @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Tekil resim hataları için (örn: biri jpg değilse) --}}
                                @error('images.*')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-outline-primary">Paylaş</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

