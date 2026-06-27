@extends('admin.layout')

@section('title', 'Blog Categories')

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

    /* Premium Table */
    .premium-table-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        overflow: hidden;
    }
    .table-premium {
        margin-bottom: 0;
    }
    .table-premium thead th {
        background: #f8f9fa;
        color: #6c757d;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.75rem;
        padding: 1.25rem 1.5rem;
        border-bottom: 2px solid #e9ecef;
    }
    .table-premium tbody td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
        color: #495057;
    }
    .table-premium tbody tr {
        transition: all 0.2s ease;
    }
    .table-premium tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Form Elements */
    .form-control-studio {
        border-radius: 12px;
        padding: 14px 20px;
        border: 2px solid #f1f3f5;
        background-color: #f8f9fa;
        font-size: 1rem;
        transition: all 0.3s ease;
        color: #495057;
    }
    .form-control-studio:focus {
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

    .status-pill {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }
    .status-active { background: #d1e7dd; color: #0f5132; }
    .status-inactive { background: #e2e3e5; color: #41464b; }

    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('content')

    <!-- Premium Page Header -->
    <div class="premium-page-header fade-in-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-dark text-white p-4 rounded-4 d-flex align-items-center justify-content-center shadow-lg">
                    <i class="bi bi-folder2-open" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Blog Categories</h2>
                    <p class="text-secondary mb-0 fs-6">Organize your chronicles into beautifully curated topics.</p>
                </div>
            </div>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-outline-premium d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Back to Chronicles
                </a>
                <button type="button" class="btn btn-premium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                    <i class="bi bi-plus-lg"></i> Create Category
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4 rounded-4 fade-in-up" style="animation-delay: 0.1s;">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="premium-table-card fade-in-up" style="animation-delay: 0.2s;">
        <div class="table-responsive">
            <table class="table table-premium table-hover">
                <thead>
                    <tr>
                        <th width="30%">Category Name</th>
                        <th width="20%">Posts Count</th>
                        <th width="20%">Status</th>
                        <th width="30%" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <div class="fw-bolder text-dark fs-6">{{ $category->name }}</div>
                                <div class="text-muted small">Slug: {{ $category->slug }}</div>
                            </td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fs-6">
                                    {{ $category->posts_count }} Chronicles
                                </span>
                            </td>
                            <td>
                                <span class="status-pill {{ $category->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $category->is_active ? 'Active' : 'Hidden' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-light rounded-circle shadow-sm border me-2" title="Edit" 
                                    data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}"
                                    style="width: 40px; height: 40px; padding: 0;">
                                    <i class="bi bi-pencil-fill text-primary"></i>
                                </button>
                                
                                <form action="{{ route('admin.blog-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-light rounded-circle shadow-sm border" title="Delete" style="width: 40px; height: 40px; padding: 0;">
                                        <i class="bi bi-trash3-fill text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 shadow-lg">
                                    <div class="modal-header bg-light border-0 py-4 px-5">
                                        <div>
                                            <h4 class="m-0 fw-bolder text-dark"><i class="bi bi-folder2-open text-primary me-2"></i> Edit Category</h4>
                                            <p class="m-0 small text-secondary mt-1 fw-bold text-uppercase" style="letter-spacing: 1px;">Update Topic Attributes</p>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-5">
                                        <form action="{{ route('admin.blog-categories.update', $category->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            
                                            <div class="mb-4">
                                                <label class="form-label-studio">Category Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control-studio fw-bold" value="{{ $category->name }}" required>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label-studio">Description</label>
                                                <textarea name="description" class="form-control-studio" rows="3">{{ $category->description }}</textarea>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-4 border mb-4">
                                                <div>
                                                    <div class="fw-bold text-dark mb-1"><i class="bi bi-globe text-success me-2"></i> Category Status</div>
                                                    <div class="x-small text-muted">Toggle visibility across the platform</div>
                                                </div>
                                                <div class="form-check form-switch fs-4 m-0">
                                                    <input class="form-check-input" type="checkbox" name="is_active" {{ $category->is_active ? 'checked' : '' }} style="cursor: pointer;">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end gap-3 pt-2">
                                                <button type="button" class="btn btn-light px-4 border rounded-pill fw-bold" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-premium px-5">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="mb-4">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                        <i class="bi bi-folder-x text-secondary" style="font-size: 2.5rem; opacity: 0.5;"></i>
                                    </div>
                                </div>
                                <h5 class="fw-bold text-dark">No Categories Found</h5>
                                <p class="text-secondary mb-0">Create your first category to start organizing your blog.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('modals')
    <!-- Create Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header bg-light border-0 py-4 px-5">
                    <div>
                        <h4 class="m-0 fw-bolder text-dark"><i class="bi bi-folder-plus text-primary me-2"></i> Create Category</h4>
                        <p class="m-0 small text-secondary mt-1 fw-bold text-uppercase" style="letter-spacing: 1px;">New Content Topic</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-5">
                    <form action="{{ route('admin.blog-categories.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label-studio">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control-studio fw-bold" placeholder="e.g. Diamond Education" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-studio">Description</label>
                            <textarea name="description" class="form-control-studio" rows="3" placeholder="Brief overview of what this category covers..."></textarea>
                        </div>

                        <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-4 border mb-4">
                            <div>
                                <div class="fw-bold text-dark mb-1"><i class="bi bi-globe text-success me-2"></i> Category Status</div>
                                <div class="x-small text-muted">Toggle visibility across the platform</div>
                            </div>
                            <div class="form-check form-switch fs-4 m-0">
                                <input class="form-check-input" type="checkbox" name="is_active" checked style="cursor: pointer;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 pt-2">
                            <button type="button" class="btn btn-light px-4 border rounded-pill fw-bold" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-premium px-5">Create Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
