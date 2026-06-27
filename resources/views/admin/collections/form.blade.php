@extends('admin.layout')

@section('title', isset($collection) ? 'Edit Masterpiece' : 'New Collection Module')

@section('content')
    <div class="row justify-content-center animate-fade-in ms-2">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg position-relative overflow-visible">
                <!-- Floating Indicator -->
                <div class="position-absolute top-0 start-50 translate-middle" style="z-index: 10;">
                    <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg"
                        style="width: 70px; height: 70px; border: 4px solid #fff;">
                        <i class="bi {{ isset($collection) ? 'bi-pencil-fill' : 'bi-plus-lg' }} fs-3"></i>
                    </div>
                </div>

                <div class="card-body p-5 px-md-5 pt-5 mt-3">
                    <form
                        action="{{ isset($collection) ? route('admin.collections.update', $collection->id) : route('admin.collections.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <h6 class="text-muted small text-uppercase mb-4 fw-bold letter-spacing-1 border-bottom pb-2">Primary
                            Information</h6>

                        <div class="mb-4">
                            <label class="form-label">Main Display Title</label>
                            <input type="text" name="title" class="form-control form-control-lg"
                                value="{{ $collection->title ?? '' }}" required
                                 placeholder="E.g. Floral Bloom Series">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Italicized Focus Word (Optional)</label>
                            <input type="text" name="subtitle" class="form-control"
                                value="{{ $collection->subtitle ?? '' }}"
                                placeholder="Enter the exact word from title to stylize...">
                            <div class="form-text small opacity-75">Matches a word in the title to apply elegant script
                                styling (e.g. 'Ear' in 'Stunning Ear').</div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Asset Management (Image)</label>
                            @if(isset($collection) && $collection->image)
                                <div class="mb-3">
                                    <img src="{{ str_starts_with($collection->image, 'http') ? $collection->image : asset($collection->image) }}"
                                        class="rounded-3 shadow-sm" style="height: 100px; width: 150px; object-fit: cover;">
                                    <div class="small text-muted mt-1">Current Image</div>
                                </div>
                            @endif

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">Option A: Upload from Computer</label>
                                    <input type="file" name="image_file" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">Option B: Remote URL</label>
                                    <input type="text" name="image" class="form-control"
                                        value="{{ $collection->image ?? '' }}"
                                        placeholder="https://images.unsplash.com/...">
                                </div>
                            </div>
                            <div class="form-text small opacity-75 mt-2">Uploading a file will take precedence over a URL.
                            </div>
                        </div>

                        <h6 class="text-muted small text-uppercase mb-4 fw-bold letter-spacing-1 border-bottom pb-2 mt-5">
                            Module Configuration</h6>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Structural Grid Type</label>
                                <div
                                    class="p-3 border rounded-4 d-flex align-items-center gap-3 bg-light bg-opacity-25 shadow-sm">
                                    <i class="bi bi-grid-fill text-dark fs-4"></i>
                                    <select name="type" class="form-select border-0 bg-transparent p-0 fw-bold" required>
                                        <option value="half" {{ (isset($collection) && $collection->type == 'half') ? 'selected' : '' }}>Half Height Stack</option>
                                        <option value="tall" {{ (isset($collection) && $collection->type == 'tall') ? 'selected' : '' }}>Full Vertical (Tall)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Visual Sequence (Order)</label>
                                <div
                                    class="p-3 border rounded-4 d-flex align-items-center gap-3 bg-light bg-opacity-25 shadow-sm">
                                    <i class="bi bi-sort-numeric-down text-dark fs-4"></i>
                                    <input type="number" name="order"
                                        class="form-control border-0 bg-transparent p-0 fw-bold"
                                        value="{{ $collection->order ?? 0 }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Text Architecture (Overlay Position)</label>
                            <div
                                class="p-3 border rounded-4 d-flex align-items-center gap-3 bg-light bg-opacity-25 shadow-sm">
                                <i class="bi bi-bounding-box-circles text-dark fs-4"></i>
                                <select name="overlay_position" class="form-select border-0 bg-transparent p-0 fw-bold"
                                    required>
                                    <option value="bottom-center" {{ (isset($collection) && $collection->overlay_position == 'bottom-center') ? 'selected' : '' }}>Bottom Aligned
                                        (Center)</option>
                                    <option value="bottom-right" {{ (isset($collection) && $collection->overlay_position == 'bottom-right') ? 'selected' : '' }}>Bottom Aligned
                                        (Right)</option>
                                    <option value="center" {{ (isset($collection) && $collection->overlay_position == 'center') ? 'selected' : '' }}>Equator Aligned
                                        (Absolute Center)</option>
                                </select>
                            </div>
                        </div>

                        <h6 class="text-muted small text-uppercase mb-4 fw-bold letter-spacing-1 border-bottom pb-2 mt-5">
                            Royal SEO Optimization</h6>
                        
                        <div class="mb-4">
                            <label class="form-label">SEO Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ $collection->meta_title ?? '' }}" placeholder="Search engine title...">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">SEO URL Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ $collection->slug ?? '' }}" placeholder="url-friendly-slug">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">SEO Meta Description</label>
                            <textarea name="meta_description" rows="3" class="form-control" placeholder="Brief summary for search results...">{{ $collection->meta_description ?? '' }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Schema Markup (Structured Data)</label>
                            <textarea name="schema_markup" rows="5" class="form-control text-monospace x-small" style="font-family: monospace;">{{ $collection->schema_markup ?? '' }}</textarea>
                        </div>

                        <div class="mt-5 pt-4 d-flex gap-3">
                            <button type="submit" class="btn btn-primary flex-grow-1 py-3 fs-6">
                                {{ isset($collection) ? 'Update Masterpiece' : 'Launch Module' }}
                            </button>
                            <a href="{{ route('admin.collections.index') }}"
                                class="btn btn-outline-secondary py-3 px-4 text-decoration-none d-flex align-items-center">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection