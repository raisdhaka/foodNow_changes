@extends('layouts.app', ['title' => __('Restaurant Menu Management')])
@section('admin_title')
    {{__('Menu')}}
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.css">
    <style>
        .card {
            transition: all 0.2s ease;
            border-radius: 8px;
            background: #fff;
            cursor: move;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }
        .item-image-wrapper {
            padding: 0;
            position: relative;
            min-height: 140px;
        }
        .item-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .badge {
            font-size: 0.75rem;
            padding: 0.25em 0.75em;
            border-radius: 4px;
            font-weight: 500;
        }
        .badge-secondary {
            background-color: #F3F4F6;
            color: #4B5563;
        }
        .sortable-ghost {
            opacity: 0.5;
            background: #F3F4F6;
        }
    </style>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>Photo Albums</h1>
                <p class="text-muted mb-0">Drag albums to reorder them</p>
            </div>
            <a href="{{ route('photos.albums.create') }}" class="btn btn-primary">Create New Album</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row" id="sortable-albums">
            @forelse($albums as $album)
                <div class="col-md-4 mb-4" data-id="{{ $album->id }}">
                    <div class="card h-100 shadow-sm border-0">
                        @if($album->photos->count() > 0)
                        <a href="{{ route('photos.albums.show', $album->slug) }}">
                            <img src="{{ $album->photos->first()->file_path }}" class="item-image" alt="{{ $album->name }}">
                        </a>
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center item-image">
                                <span class="text-muted">No photos</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $album->name }}</h5>
                            <p class="text-muted small">
                                {{ $album->photos->count() }} photos
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('photos.albums.show', $album->slug) }}" class="btn btn-sm btn-outline-primary">View Album</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No albums found. <a href="{{ route('photos.albums.create') }}">Create your first album</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        // Initialize Sortable for drag and drop functionality
        var el = document.getElementById('sortable-albums');
        if (el) {
            var sortable = new Sortable(el, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function() {
                    updateAlbumOrder();
                }
            });
        }

        // Update album order after drag and drop
        function updateAlbumOrder() {
            var albumIds = [];
            document.querySelectorAll('#sortable-albums > div').forEach(function(item) {
                albumIds.push(item.getAttribute('data-id'));
            });

            fetch('{{ route("photos.albums.order.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ albums: albumIds })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
@endsection
