@extends('general.index', $setup)
@section('cardbody')
<form action="{{ $setup['action'] }}" method="POST" enctype="multipart/form-data" id="blogForm">
    @csrf
    @isset($setup['isupdate'])
        @method('PUT')
    @endisset

    <!-- Get content value from fields -->
    @php
        $contentValue = "";
        foreach($fields as $field) {
            if($field['id'] == 'content') {
                $contentValue = $field['value'] ?? '';
                break;
            }
        }
    @endphp

    <!-- Add hidden field for content -->
    <input type="hidden" name="content_hidden" id="content_hidden" value="{{ $contentValue }}">

    <div class="row">
        <!-- Main Content Column -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Title and Content Fields -->
                    @foreach($fields as $field)
                        @if(in_array($field['id'], ['title','slug']))
                            @include('partials.fields', ['fields' => [$field]])
                        @endif
                    @endforeach
                    
                    <!-- Quill Editor -->
                    <div class="form-group">
                        <label for="editor-container">Content</label>
                        <div id="editor-container" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Settings -->
        <div class="col-md-4">
            <!-- Publish Panel -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">Publish</h4>
                </div>
                <div class="card-body">
                    @foreach($fields as $field)
                        @if(in_array($field['id'], ['status']))
                            @include('partials.fields', ['fields' => [$field]])
                        @endif
                    @endforeach
                    
                    <div class="text-end mt-3">
                        @if (isset($setup['isupdate']))
                           
                            <button type="submit" class="btn btn-primary" onclick="syncContent(event)">{{ __('Update')}}</button>  
                        @else
                            <button type="submit" class="btn btn-primary" onclick="syncContent(event)">{{ __('Publish')}}</button>  
                        @endif
                    </div>
                </div>
            </div>

            <!-- Featured Image Panel -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">Featured Image</h4>
                </div>
                <div class="card-body">
                    @foreach($fields as $field)
                        @if($field['id'] == 'featured_image')
                            @include('partials.fields', ['fields' => [$field]])
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Excerpt Panel -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">Excerpt</h4>
                </div>
                <div class="card-body">
                    @foreach($fields as $field)
                        @if(isset($field['id']) && $field['id'] == 'excerpt')
                            @include('partials.fields', ['fields' => [$field]])
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- SEO Settings Panel -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">SEO Settings</h4>
                </div>
                <div class="card-body">
                    @foreach($fields as $field)
                   
                        @if(isset($field['id']) && in_array($field['id'], ['meta_title', 'meta_description', 'meta_keywords']))
                            @include('partials.fields', ['fields' => [$field]])
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</form>

<style>
.card {
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    margin-bottom: 1rem;
}
.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0,0,0,.125);
}
.card-title {
    font-size: 1.1rem;
    font-weight: 500;
}
/* Add these new styles */
.card-body .form-control,
.card-body .form-select {
    width: 100%;
    margin-bottom: 1rem;
}
.card-body .form-check {
    padding: 1rem 0;
}
.card-body label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #495057;
}
/* Quill editor styles */
.ql-editor {
    min-height: 450px;
    font-size: 16px;
}
</style>

@section('head')
    <!-- Disable Select2 CSS for this page only -->
    <style>
        /* Override any Select2 styles that might affect the page */
        .select2-container {
            display: none !important;
        }
    </style>
    
    <!-- Include Quill.js CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    
    <!-- Include Quill.js itself -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    
    <script>
        // Disable select2.min.css for this page only
        document.addEventListener('DOMContentLoaded', function() {
            // Find and disable the select2 stylesheet
            const stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
            stylesheets.forEach(function(stylesheet) {
                if (stylesheet.href.includes('select2.min.css')) {
                    stylesheet.disabled = true;
                    // Or remove it entirely:
                    // stylesheet.parentNode.removeChild(stylesheet);
                }
            });
        });
    
        // Enhanced slug generation function
        function generateSlug(text) {
            return text
                // Convert to lowercase
                .toLowerCase()
                // Replace special characters with spaces
                .replace(/[áàãâä]/g, 'a')
                .replace(/[éèêë]/g, 'e')
                .replace(/[íìîï]/g, 'i')
                .replace(/[óòõôö]/g, 'o')
                .replace(/[úùûü]/g, 'u')
                .replace(/[ýÿ]/g, 'y')
                .replace(/[ñ]/g, 'n')
                .replace(/[ç]/g, 'c')
                // Replace common symbols with their word equivalent
                .replace(/&/g, 'and')
                .replace(/\+/g, 'plus')
                .replace(/\$/g, 'dollar')
                .replace(/€/g, 'euro')
                .replace(/£/g, 'pound')
                // Remove all other special characters and replace with spaces
                .replace(/[^a-z0-9\s-]/g, ' ')
                // Replace multiple spaces with single space
                .replace(/\s+/g, ' ')
                .trim()
                // Replace spaces with hyphens
                .replace(/\s/g, '-')
                // Replace multiple hyphens with single hyphen
                .replace(/-+/g, '-')
                // Limit length to 60 characters
                .substring(0, 60)
                // Remove trailing hyphen if exists
                .replace(/-$/, '');
        }

        // Initialize Quill and add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.querySelector('input[name="title"]');
            const slugInput = document.querySelector('input[name="slug"]');
            const isEditMode = {{ isset($setup['isupdate']) ? 'true' : 'false' }};
            
            if (titleInput && slugInput && !isEditMode) {
                titleInput.addEventListener('input', function() {
                    // Only update slug if it's empty or hasn't been manually modified
                    if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
                        const slugValue = generateSlug(this.value);
                        slugInput.value = slugValue;
                        slugInput.dataset.autoGenerated = 'true';
                    }
                });

                // Add listener to slug input to mark when it's manually changed
                slugInput.addEventListener('input', function() {
                    this.dataset.autoGenerated = 'false';
                });
            }
            
            // Initialize Quill editor
            const quill = new Quill('#editor-container', {
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                },
                theme: 'snow'
            });
            
            // Load content from hidden field on init (for edit mode)
            const hiddenField = document.getElementById('content_hidden');
            if (hiddenField.value) {
                quill.clipboard.dangerouslyPasteHTML(hiddenField.value);
            }
            
            // Update hidden field when editor content changes
            quill.on('text-change', function() {
                hiddenField.value = quill.root.innerHTML;
            });
        });

        // Function to ensure content is synced before form submission
        function syncContent(e) {
            e.preventDefault();
            // Content should already be synced through text-change event
            document.getElementById('blogForm').submit();
        }
    </script>
@endsection
@endsection