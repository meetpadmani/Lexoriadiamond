@extends('admin.layout')

@section('title', 'Write New Chapter')

@section('styles')
<style>
    /* Premium Page Header */
    .premium-page-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.02);
        margin-bottom: 2rem;
        border: 1px solid rgba(0,0,0,0.03);
    }

    /* Premium Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        color: #fff;
        padding: 14px 28px;
        border-radius: 30px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
        color: #fff;
    }

    .btn-outline-premium {
        background: transparent;
        border: 2px solid #212529;
        color: #212529;
        padding: 12px 26px;
        border-radius: 30px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .btn-outline-premium:hover {
        background: #212529;
        color: #fff;
        transform: translateY(-2px);
    }

    /* Form Panels */
    .premium-panel {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        padding: 2.5rem;
        margin-bottom: 2rem;
    }
    
    .panel-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8f9fa;
    }
    .panel-icon {
        width: 40px; height: 40px;
        border-radius: 12px;
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }
    .panel-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    .form-control-studio, .form-select-studio {
        border-radius: 12px;
        padding: 14px 20px;
        border: 2px solid #f1f3f5;
        background-color: #f8f9fa;
        font-size: 1rem;
        transition: all 0.3s ease;
        color: #495057;
    }
    .form-control-studio:focus, .form-select-studio:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        outline: none;
    }
    .form-label-studio {
        font-weight: 800;
        color: #495057;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.75rem;
        display: block;
    }

    /* Upload Zone */
    .upload-master-zone {
        border: 2px dashed #dee2e6;
        border-radius: 16px;
        padding: 2.5rem 1rem;
        text-align: center;
        background: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .upload-master-zone:hover {
        border-color: #0d6efd;
        background: #f1f8ff;
    }
    .upload-master-zone i {
        font-size: 2.5rem;
        color: #adb5bd;
        margin-bottom: 15px;
        display: block;
        transition: color 0.3s ease;
    }
    .upload-master-zone:hover i {
        color: #0d6efd;
    }

    /* Summernote customization */
    .note-editor.note-frame {
        border: 2px solid #f1f3f5;
        border-radius: 12px;
        overflow: hidden;
    }
    .note-editor.note-frame .note-toolbar {
        background: #f8f9fa;
        border-bottom: 1px solid #f1f3f5;
        padding: 10px;
    }
    .note-editor.note-frame .note-statusbar {
        background: #f8f9fa;
        border-top: 1px solid #f1f3f5;
    }

    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')

    <!-- Premium Page Header -->
    <div class="premium-page-header fade-in-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-dark text-white p-4 rounded-4 d-flex align-items-center justify-content-center shadow-lg">
                    <i class="bi bi-feather" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Write New Chapter</h2>
                    <p class="text-secondary mb-0 fs-6">Craft a compelling narrative for your brand.</p>
                </div>
            </div>
            <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-outline-premium d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Back to Chronicles
            </a>
        </div>
    </div>

    <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- Left Column: Content -->
            <div class="col-xl-8 fade-in-up" style="animation-delay: 0.1s;">
                
                <div class="premium-panel">
                    <div class="panel-header">
                        <div class="panel-icon"><i class="bi bi-pen-fill"></i></div>
                        <h3 class="panel-title">Story Composition</h3>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label-studio">Chronicle Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control-studio fs-5 fw-bold text-dark" placeholder="Enter an engaging title..." required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-studio">Narrative Teaser (Excerpt)</label>
                        <textarea name="summary" class="form-control-studio" rows="3" placeholder="A brief summary that captivates readers on the list pages..."></textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label-studio">The Full Manuscript <span class="text-danger">*</span></label>
                        <textarea name="content" id="summernote" required></textarea>
                    </div>
                </div>

                <div class="premium-panel fade-in-up" style="animation-delay: 0.2s;">
                    <div class="panel-header">
                        <div class="panel-icon bg-success bg-opacity-10 text-success"><i class="bi bi-search"></i></div>
                        <h3 class="panel-title">Search Engine Optimization</h3>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label-studio">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control-studio" placeholder="Ideal length: 50-60 characters">
                    </div>

                    <div class="mb-4">
                        <label class="form-label-studio">Meta Description</label>
                        <textarea name="meta_description" class="form-control-studio" rows="3" placeholder="Ideal length: 150-160 characters"></textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label-studio">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control-studio" placeholder="jewelry, gold, diamonds (comma separated)">
                    </div>
                </div>

            </div>

            <!-- Right Column: Settings & Publish -->
            <div class="col-xl-4 fade-in-up" style="animation-delay: 0.3s;">
                
                <div class="premium-panel bg-light border-0">
                    <div class="panel-header border-bottom-0 mb-3 pb-0">
                        <div class="panel-icon bg-dark text-white"><i class="bi bi-rocket-takeoff-fill"></i></div>
                        <h3 class="panel-title">Publication</h3>
                    </div>

                    <div class="bg-white p-3 rounded-4 border shadow-sm mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold text-dark mb-1"><i class="bi bi-globe text-primary me-2"></i> Go Live Immediately</div>
                                <div class="x-small text-muted">Publish to website instantly</div>
                            </div>
                            <div class="form-check form-switch fs-4 m-0">
                                <input class="form-check-input" type="checkbox" name="is_published" id="isPublished" checked style="cursor: pointer;">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-premium w-100 d-flex align-items-center justify-content-center gap-2" style="padding: 18px;">
                        <i class="bi bi-cloud-arrow-up-fill fs-5"></i> Publish Chronicle
                    </button>
                </div>

                <div class="premium-panel">
                    <div class="panel-header">
                        <div class="panel-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-tags-fill"></i></div>
                        <h3 class="panel-title">Categorization</h3>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-studio">Primary Category <span class="text-danger">*</span></label>
                        <select name="blog_category_id" class="form-select-studio" required>
                            <option value="">Select Category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-0">
                        <label class="form-label-studio">Tags (Hold Ctrl to Multi-select)</label>
                        <select name="tags[]" class="form-select-studio" multiple style="height: 140px;">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="premium-panel">
                    <div class="panel-header">
                        <div class="panel-icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-image-fill"></i></div>
                        <h3 class="panel-title">Featured Art</h3>
                    </div>

                    <div class="upload-master-zone" onclick="document.getElementById('imgInput').click()">
                        <div id="image-placeholder">
                            <i class="bi bi-cloud-upload"></i>
                            <p class="m-0 fw-bold text-dark">Upload Cover Image</p>
                            <p class="m-0 mt-1 small text-muted">1200 x 630px recommended</p>
                        </div>
                        <img id="imagePreview" src="" style="width: 100%; aspect-ratio: 16/10; object-fit: cover; border-radius: 8px; display: none; position: absolute; top: 0; left: 0; z-index: 5;">
                    </div>
                    <input type="file" name="featured_image" id="imgInput" class="d-none" accept="image/*">
                </div>

            </div>
        </div>
    </form>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Begin writing your narrative...',
            tabsize: 2,
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onInit: function() {
                    $('.note-editor').addClass('border-0 shadow-sm');
                }
            }
        });

        // Image Preview Logic
        $('#imgInput').change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#imagePreview').attr('src', event.target.result).show();
                    $('#image-placeholder').hide();
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
