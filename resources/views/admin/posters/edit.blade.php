@extends('admin.layout')

@section('title', 'Edit Poster')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Poster</h5>
                    <a href="{{ route('admin.posters.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.posters.update', $poster->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label" for="title">Title (Optional)</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title', $poster->title) }}">
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Current Desktop Poster Image</label>
                            @if($poster->image)
                                <div class="mb-3">
                                    <img src="{{ asset($poster->image) }}" alt="Poster Image" class="img-thumbnail"
                                        style="max-height: 200px; border-radius: 12px;">
                                </div>
                            @else
                                <p class="text-muted small">No image uploaded.</p>
                            @endif

                            <label class="form-label" for="image">Replace Desktop Image (Optional, Max: 10MB)</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @error('image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Current Mobile Poster Image</label>
                            @if($poster->mobile_image)
                                <div class="mb-3">
                                    <img src="{{ asset($poster->mobile_image) }}" alt="Mobile Poster Image" class="img-thumbnail"
                                        style="max-height: 200px; border-radius: 12px;">
                                </div>
                            @else
                                <p class="text-muted small">No mobile image uploaded.</p>
                            @endif

                            <label class="form-label" for="mobile_image">Replace Mobile Image (Optional, Max: 10MB)</label>
                            <input type="file" name="mobile_image" id="mobile_image" class="form-control" accept="image/*">
                            <div class="form-text">Used on small screens (mobile phones). If left blank, the desktop image is used.</div>
                            @error('mobile_image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="link">Link Target (Optional)</label>
                            <input type="text" name="link" id="link" class="form-control"
                                value="{{ old('link', $poster->link) }}">
                            @error('link')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check form-switch p-0">
                            <label class="form-label d-block mb-2" for="status">Display Status</label>
                            <div class="form-check form-switch ps-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="status" name="status"
                                    value="1" {{ old('status', $poster->status) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="status">Active</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">Update Poster</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection