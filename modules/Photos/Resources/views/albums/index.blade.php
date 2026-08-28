@extends('layouts.app', ['title' => __('Photo Albums')])

@section('admin_title')
    {{__('Photo Albums')}}
@endsection

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1>{{__('Photo Albums')}}</h1>
                <a href="{{ route('photos.albums.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{__('Create New Album')}}
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse($albums as $album)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($album->photos->isNotEmpty())
                            <img src="{{ $album->photos->first()->file_path }}" class="card-img-top" alt="{{ $album->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-images fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $album->name }}</h5>
                            @if($album->description)
                                <p class="card-text">{{ Str::limit($album->description, 100) }}</p>
                            @endif
                            <p class="card-text">
                                <small class="text-muted">
                                    {{ $album->photos->count() }} {{ Str::plural('photo', $album->photos->count()) }}
                                </small>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100">
                                <a href="{{ route('photos.albums.show', $album->slug) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i> {{__('View')}}
                                </a>
                                <a href="{{ route('photos.albums.edit', $album->id) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-edit"></i> {{__('Edit')}}
                                </a>
                                <a href="{{ route('photos.albums.delete', $album->id) }}" class="btn btn-outline-danger" 
                                   onclick="return confirm('{{__('Are you sure you want to delete this album?')}}')">
                                    <i class="fas fa-trash"></i> {{__('Delete')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        {{__('No albums found.')}} 
                        <a href="{{ route('photos.albums.create') }}">{{__('Create your first album')}}</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection 