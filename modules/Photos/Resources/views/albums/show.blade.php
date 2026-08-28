@extends('layouts.app', ['title' => __('Restaurant Menu Management')])
@section('admin_title')
    {{__('Menu')}}
@endsection


@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.css">
<style>
    .photo-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        grid-gap: 10px;
        padding: 10px;
    }
    .photo-item {
        position: relative;
        border-radius: 6px;
        overflow: hidden;
        cursor: move;
        transition: all 0.2s ease;
        aspect-ratio: 1;
        background: #f8f9fa;
    }
    .photo-item:hover {
        transform: scale(1.05);
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        z-index: 1;
    }
    .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .photo-controls {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.7);
        padding: 4px;
        opacity: 0;
        transition: opacity 0.2s ease;
        display: flex;
        justify-content: center;
    }
    .photo-item:hover .photo-controls {
        opacity: 1;
    }
    .photo-controls .btn-group-sm > .btn {
        padding: 0.15rem 0.5rem;
        font-size: 0.75rem;
    }
    .dropzone {
        border: 2px dashed #0087F7;
        border-radius: 8px;
        background: #F9F9F9;
        min-height: 200px;
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .dropzone:hover {
        background: #F0F0F0;
        border-color: #0056b3;
    }
    .dropzone .dz-message {
        text-align: center;
        margin: 2em 0;
    }
    .dropzone .dz-message .dz-button {
        background: none;
        color: #0087F7;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }
    .dropzone .dz-message .upload-icon {
        font-size: 3em;
        margin-bottom: 15px;
        color: #0087F7;
    }
    .dropzone .dz-preview {
        margin: 10px;
    }
    .dropzone .dz-preview .dz-image {
        border-radius: 8px;
    }
    .dropzone.dz-drag-hover {
        border-style: solid;
        background: #e3f2fd;
        border-color: #0056b3;
    }
    .dz-progress {
        display: block !important;
    }
</style>
    <div class="container py-5">
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1>{{ $album->name }}</h1>
                <div>
                    <a href="{{ route('photos.albums.edit', $album->id) }}" class="btn btn-sm btn-primary mr-2">
                        <i class="fas fa-edit"></i> Edit Album
                    </a>
                    <button type="button" class="btn btn-sm btn-danger mr-2" id="delete-album-btn">
                        <i class="fas fa-trash"></i> Delete Album
                    </button>
                    <a href="{{ route('photos.index') }}" class="btn btn-sm btn-outline-secondary">Back to Albums</a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Upload Photos</h5>
                <button type="button" class="btn btn-sm btn-outline-primary" id="import-menu-images">
                    <i class="fas fa-file-import"></i> Import images from menu
                </button>
            </div>
            <div class="card-body">
                <form action="{{ route('photos.upload', $album->id) }}" class="dropzone" id="photo-dropzone">
                    @csrf
                    <div class="dz-message">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h3>Drop files here or click to upload</h3>
                        <p class="text-muted">
                            Upload up to 20 photos at once (max 2MB each)<br>
                            Supported formats: JPG, PNG, GIF
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Photos ({{ count($photos) }})</h5>
                <span class="text-muted">Drag to reorder</span>
            </div>
            <div class="card-body">
                @if(count($photos) > 0)
                    <div class="photo-gallery" id="sortable-photos" data-album-id="{{ $album->id }}">
                        @foreach($photos as $photo)
                            <div class="photo-item" data-id="{{ $photo->id }}">
                                <img src="{{ $photo->file_path }}" alt="{{ $photo->title }}">
                                <div class="photo-controls">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-light text-danger delete-photo-btn" data-id="{{ $photo->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        No photos in this album yet. Use the upload form above to add photos.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Edit Photo Modal -->
    <div class="modal fade" id="editPhotoModal" tabindex="-1" role="dialog" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhotoModalLabel">Edit Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editPhotoForm">
                    <div class="modal-body">
                        <input type="hidden" id="photo_id" name="photo_id">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    // Initialize Dropzone
    Dropzone.autoDiscover = false;
    var photoDropzone = new Dropzone("#photo-dropzone", {
        paramName: "photos[]",
        maxFilesize: 2, // MB
        acceptedFiles: "image/*",
        maxFiles: 20,
        parallelUploads: 2,
        thumbnailWidth: 120,
        thumbnailHeight: 120,
        dictDefaultMessage: "Drop files here or click to upload",
        dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
        dictFileTooBig: "File is too big (${filesize}MB). Max filesize: ${maxFilesize}MB.",
        dictInvalidFileType: "You can't upload files of this type.",
        dictResponseError: "Server responded with ${statusCode} code.",
        dictCancelUpload: "Cancel upload",
        dictUploadCanceled: "Upload canceled.",
        dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
        dictRemoveFile: "Remove file",
        dictMaxFilesExceeded: "You can not upload any more files.",
        init: function() {
            this.on("addedfile", function(file) {
                console.log("File added:", file.name);
            });
            this.on("success", function(file, response) {
                console.log("Upload successful:", response);
            });
            this.on("error", function(file, errorMessage) {
                console.error("Upload error:", errorMessage);
            });
            this.on("complete", function(file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            });
        }
    });

    // Initialize Sortable for drag and drop functionality
    var el = document.getElementById('sortable-photos');
    if (el) {
        var sortable = new Sortable(el, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function() {
                updatePhotoOrder();
            }
        });
    }

    // Delete photo functionality
    document.querySelectorAll('.delete-photo-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this photo?')) {
                var photoId = this.getAttribute('data-id');
                var photoItem = this.closest('.photo-item');

                fetch('{{ url("photos/photos/del") }}/' + photoId, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the photo item from DOM
                        photoItem.remove();
                        
                        // Update the photo count
                        var countElement = document.querySelector('.card-header h5');
                        var currentCount = parseInt(countElement.textContent.match(/\d+/)[0]);
                        countElement.textContent = 'Photos (' + (currentCount - 1) + ')';

                        // Show success message
                        var alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-success alert-dismissible fade show';
                        alertDiv.innerHTML = `
                            ${data.message || 'Photo deleted successfully'}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        `;
                        document.querySelector('.container.py-5').insertBefore(
                            alertDiv,
                            document.querySelector('.card.mb-4')
                        );

                        // Remove alert after 3 seconds
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 3000);
                    } else {
                        throw new Error(data.message || 'Error deleting photo');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show error message
                    var alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        Error deleting photo: ${error.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    `;
                    document.querySelector('.container.py-5').insertBefore(
                        alertDiv,
                        document.querySelector('.card.mb-4')
                    );

                    // Remove alert after 3 seconds
                    setTimeout(() => {
                        alertDiv.remove();
                    }, 3000);
                });
            }
        });
    });

    // Update photo order after drag and drop
    function updatePhotoOrder() {
        var photoIds = [];
        document.querySelectorAll('.photo-item').forEach(function(item) {
            photoIds.push(item.getAttribute('data-id'));
        });

        fetch('{{ route("photos.order.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ photos: photoIds })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Edit photo
    document.querySelectorAll('.edit-photo-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var photoId = this.getAttribute('data-id');
            var title = this.getAttribute('data-title');
            var description = this.getAttribute('data-description');

            document.getElementById('photo_id').value = photoId;
            document.getElementById('title').value = title || '';
            document.getElementById('description').value = description || '';

            $('#editPhotoModal').modal('show');
        });
    });

    // Handle edit photo form submission
    document.getElementById('editPhotoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        var photoId = document.getElementById('photo_id').value;
        var title = document.getElementById('title').value;
        var description = document.getElementById('description').value;

        fetch('{{ url("photos/photos") }}/' + photoId, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ title: title, description: description })
        })
        .then(response => response.json())
        .then(data => {
            $('#editPhotoModal').modal('hide');
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Delete album functionality
    document.getElementById('delete-album-btn').addEventListener('click', function() {
        if (confirm('Are you sure you want to delete this album? This will delete all photos in the album and cannot be undone.')) {
            fetch('{{ url("photos/albums/del") }}/{{ $album->id }}', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message and redirect to albums page
                    alert(data.message || 'Album deleted successfully');
                    window.location.href = '{{ route("photos.index") }}';
                } else {
                    throw new Error(data.message || 'Error deleting album');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting album: ' + error.message);
            });
        }
    });

    // Import menu images functionality
    document.getElementById('import-menu-images').addEventListener('click', function() {
        if (confirm('Do you want to add all menu items images in this album?')) {
            // Show loading state
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Importing...';

            fetch('{{ url("photos/albums") }}/{{ $album->id }}/import-menu-images', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    var alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        ${data.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    `;
                    document.querySelector('.container.py-5').insertBefore(
                        alertDiv,
                        document.querySelector('.card.mb-4')
                    );

                    // Reload the page after 1.5 seconds
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Error importing images');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error importing images: ' + error.message);
            })
            .finally(() => {
                // Reset button state
                this.disabled = false;
                this.innerHTML = '<i class="fas fa-file-import"></i> Import images from menu';
            });
        }
    });
</script>
@endsection 