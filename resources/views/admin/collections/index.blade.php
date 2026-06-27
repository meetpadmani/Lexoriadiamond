@extends('admin.layout')

@section('title', 'Luxury Collections Grid')

@section('styles')
<style>
    /* Premium Page Header */
    .premium-page-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.02);
        margin-bottom: 2rem;
        border: 1px solid rgba(0,0,0,0.03);
    }

    /* Stats Cards Premium */
    .stat-card-premium {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }
    .icon-bg-glow {
        width: 56px; height: 56px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        position: relative;
    }
    
    /* Table Premium */
    .premium-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        overflow: hidden;
    }
    .table-premium th {
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #adb5bd;
        text-transform: uppercase;
        border-bottom: 2px solid #f8f9fa;
        padding: 1.25rem 1.5rem;
    }
    .table-premium td {
        padding: 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8f9fa;
    }

    /* Image Preview in Table */
    .collection-img-preview {
        width: 100px;
        height: 70px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
    }
    .collection-img-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .collection-img-preview:hover img {
        transform: scale(1.1);
    }

    /* Badges */
    .badge-layout {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        padding: 6px 12px;
        border-radius: 30px;
    }

    /* Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        color: #fff;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
        color: #fff;
    }

    /* Action Buttons */
    .btn-action {
        width: 38px; height: 38px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e9ecef;
        background: #f8f9fa;
        color: #495057;
        transition: all 0.2s ease;
    }
    .btn-action:hover {
        background: #0d6efd;
        color: white;
        border-color: #0d6efd;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }
    .btn-action.btn-delete:hover {
        background: #dc3545;
        border-color: #dc3545;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
    }

    /* Modal Form Elements */
    .modal-content {
        border-radius: 24px;
        border: none;
    }
    .modal-header {
        border-bottom: 1px solid #f8f9fa;
        padding: 1.5rem 2rem;
    }
    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #e9ecef;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    /* Animation */
    .fade-in-up {
        animation: fadeInUp 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('content')

    <!-- Header Area -->
    <div class="premium-page-header fade-in-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-primary bg-opacity-10 p-4 rounded-4 text-primary d-flex align-items-center justify-content-center">
                    <i class="bi bi-grid-1x2-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="letter-spacing: -0.5px;">Collections Architecture</h2>
                    <p class="text-secondary mb-0 fs-6">Manage the visual layout modules and categories on your storefront.</p>
                </div>
            </div>
            <button type="button" class="btn btn-premium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#collectionModal" onclick="openCreateModal()">
                <i class="bi bi-plus-lg"></i> Launch New Module
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Quick Stats -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 fade-in-up" style="animation-delay: 0.2s;">
            <div class="stat-card-premium p-4 h-100" style="border-bottom: 4px solid #0d6efd;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Total Active Modules</div>
                        <h2 class="mb-0 fw-bolder text-dark">{{ $collections->count() }}</h2>
                    </div>
                    <div class="icon-bg-glow bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-columns-gap fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 fade-in-up" style="animation-delay: 0.3s;">
            <div class="stat-card-premium p-4 h-100" style="border-bottom: 4px solid #6f42c1;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Jharokha Vertical Cards</div>
                        <h2 class="mb-0 fw-bolder text-dark">{{ $collections->where('type', 'tall')->count() }}</h2>
                    </div>
                    <div class="icon-bg-glow" style="background: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                        <i class="bi bi-layout-sidebar-inset fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collection Table Card -->
    <div class="card premium-card border-0 fade-in-up" style="animation-delay: 0.4s;">
        <div class="table-responsive">
            <table class="table table-premium mb-0">
                <thead class="bg-white">
                    <tr>
                        <th class="ps-4">Visual Asset</th>
                        <th>Collection Details</th>
                        <th>Layout Configuration</th>
                        <th>Display Order</th>
                        <th class="pe-4 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($collections as $item)
                        <tr>
                            <td class="ps-4">
                                <div class="collection-img-preview">
                                    <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset($item->image) }}" alt="{{ $item->title }}">
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $item->title }}</div>
                                @if($item->subtitle)
                                    <div class="text-secondary small mt-1 d-flex align-items-center gap-1">
                                        <i class="bi bi-stars text-warning"></i> Focus: <span class="fw-semibold">{{ $item->subtitle }}</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-2 align-items-start">
                                    <span class="badge badge-layout {{ $item->type == 'tall' ? 'bg-primary-subtle text-primary' : 'bg-info-subtle text-info' }}">
                                        <i class="bi {{ $item->type == 'tall' ? 'bi-phone' : 'bi-aspect-ratio' }} me-1"></i>
                                        {{ $item->type == 'tall' ? 'Full Vertical Stack' : 'Horizontal Half Stack' }}
                                    </span>
                                    <div class="text-secondary" style="font-size: 0.75rem;">
                                        <i class="bi bi-cursor me-1"></i> Overlay: {{ ucwords(str_replace('-', ' ', $item->overlay_position)) }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center fw-bold text-dark border shadow-sm" style="width: 40px; height: 40px;">
                                    {{ sprintf('%02d', $item->order) }}
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn-action" onclick="openEditModal(this)" title="Edit Collection"
                                        data-id="{{ $item->id }}" data-title="{{ $item->title }}"
                                        data-description="{{ $item->description }}" data-subtitle="{{ $item->subtitle }}"
                                        data-image="{{ $item->image }}" data-type="{{ $item->type }}"
                                        data-order="{{ $item->order }}" data-overlay="{{ $item->overlay_position }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.collections.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to archive this collection from the grid?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Delete Collection">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted d-flex flex-column align-items-center">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="bi bi-images text-secondary" style="font-size: 2.5rem; opacity: 0.5;"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark">No Collections Configured</h5>
                                    <p class="small mb-0">Add some visual modules to display your categories on the storefront.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('modals')
    <!-- Premium Collection Modal -->
    <div class="modal fade" id="collectionModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="collectionModalLabel">
                        <i class="bi bi-plus-circle-fill text-primary"></i> Launch New Module
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 p-lg-5">
                    <form id="collectionForm" action="{{ route('admin.collections.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="methodField"></div>

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold small text-secondary text-uppercase" style="letter-spacing: 1px;">Primary Display Title</label>
                                <input type="text" name="title" id="form-title" class="form-control form-control-lg fw-bold" required placeholder="e.g. Bridal Masterpieces">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary text-uppercase" style="letter-spacing: 1px;">Focus Word (Italicized)</label>
                                <input type="text" name="subtitle" id="form-subtitle" class="form-control" placeholder="e.g. Masterpieces">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary text-uppercase" style="letter-spacing: 1px;">Structural Grid Layout</label>
                                <select name="type" id="form-type" class="form-select" required>
                                    <option value="tall">Full Vertical Impact</option>
                                    <option value="half">Horizontal Half Stack</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small text-secondary text-uppercase" style="letter-spacing: 1px;">Metadata Description</label>
                                <textarea name="description" id="form-description" rows="3" class="form-control" placeholder="Brief description of the collection..."></textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small text-secondary text-uppercase mb-2" style="letter-spacing: 1px;">Signature Asset (Image)</label>
                                <div class="p-3 bg-light rounded-4 border">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="small fw-semibold mb-1 text-dark">Upload File</div>
                                            <input type="file" name="image_file" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="small fw-semibold mb-1 text-dark">Or Direct URL</div>
                                            <input type="text" name="image" id="form-image" class="form-control" placeholder="https://...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary text-uppercase" style="letter-spacing: 1px;">Text Overlay Position</label>
                                <select name="overlay_position" id="form-overlay" class="form-select" required>
                                    <option value="bottom-center">Bottom Center</option>
                                    <option value="bottom-right">Bottom Right</option>
                                    <option value="center">Absolute Center</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary text-uppercase" style="letter-spacing: 1px;">Display Sequence</label>
                                <input type="number" name="order" id="form-order" class="form-control" value="0">
                            </div>
                        </div>

                        <div class="mt-5 d-flex gap-3 justify-content-end">
                            <button type="button" class="btn btn-light px-4 border rounded-pill fw-bold" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-premium px-5" id="submitBtn">Save Configuration</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openCreateModal() {
            const form = document.getElementById('collectionForm');
            form.reset();
            form.action = "{{ route('admin.collections.store') }}";
            
            document.getElementById('collectionModalLabel').innerHTML = '<i class="bi bi-plus-circle-fill text-primary"></i> Launch New Module';
            document.getElementById('methodField').innerHTML = "";
            document.getElementById('submitBtn').innerText = "Save Configuration";
        }

        function openEditModal(btn) {
            const item = btn.parentElement.dataset.id ? btn.parentElement.dataset : btn.dataset;
            const form = document.getElementById('collectionForm');
            form.reset();
            
            form.action = "{{ url('admin/collections') }}/" + item.id + "/update";
            
            document.getElementById('collectionModalLabel').innerHTML = '<i class="bi bi-pencil-fill text-primary"></i> Edit Module Details';
            document.getElementById('methodField').innerHTML = "";
            document.getElementById('submitBtn').innerText = "Update Module";

            document.getElementById('form-title').value = item.title;
            document.getElementById('form-subtitle').value = (item.subtitle && item.subtitle !== 'null') ? item.subtitle : '';
            document.getElementById('form-description').value = (item.description && item.description !== 'null') ? item.description : '';
            document.getElementById('form-image').value = (item.image && item.image !== 'null') ? item.image : '';
            document.getElementById('form-type').value = item.type;
            document.getElementById('form-order').value = item.order;
            document.getElementById('form-overlay').value = item.overlay;

            new bootstrap.Modal(document.getElementById('collectionModal')).show();
        }
    </script>
@endsection