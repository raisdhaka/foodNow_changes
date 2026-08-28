@extends('layouts.app', ['title' => __('Create Photo Album')])
@section('admin_title')
    {{__('Photo Albums')}}
@endsection
@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <h1>Create New Album</h1>
            <a href="{{ route('photos.albums.index') }}" class="btn btn-sm btn-outline-secondary">Back to Albums</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('photos.albums.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Album Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Create Album</button>
                </form>
            </div>
        </div>
    </div>
@endsection