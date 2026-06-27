@extends('admin.layout')

@section('title', 'Product Reviews')

@section('styles')
<style>
    /* Premium Button Glow */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        transition: all 0.3s ease;
        color: #fff !important;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
    }

    /* Premium Cards */
    .premium-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .premium-card:hover {
        box-shadow: 0 15px 35px rgba(0,0,0,0.04);
        transform: translateY(-2px);
    }

    /* Stats Cards */
    .stat-card-premium {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .stat-card-premium::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 4px;
        background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .stat-card-premium:hover::before {
        opacity: 1;
    }

    /* Table Enhancements */
    .table-premium th {
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #adb5bd;
        text-transform: uppercase;
        border-bottom: 2px solid #f8f9fa;
        padding: 1.25rem 1rem;
    }
    .table-premium td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8f9fa;
    }
    .review-row {
        transition: background-color 0.2s ease;
    }
    .review-row:hover {
        background-color: #fcfdfd !important;
    }

    /* Custom Input Group */
    .premium-input-group {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9ecef;
        background: #fff;
        transition: all 0.2s ease;
    }
    .premium-input-group:focus-within {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }
    .premium-input-group .form-control, .premium-input-group .form-select, .premium-input-group .input-group-text {
        border: none;
        background: transparent;
    }
    .premium-input-group .form-control:focus, .premium-input-group .form-select:focus {
        box-shadow: none;
        outline: none;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .rating-stars {
        color: #ffc107;
        font-size: 0.9rem;
    }
    .rating-stars .bi-star {
        color: #e9ecef;
    }
</style>
@endsection

@section('content')

    <!-- Header Area -->
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                <i class="bi bi-star-fill text-warning fs-4"></i>
            </div>
            <div>
                <h3 class="mb-1 fw-bold text-dark letter-spacing-tight">Product Reviews</h3>
                <p class="text-secondary small mb-0">Manage customer feedback and ratings.</p>
            </div>
        </div>
        <div class="d-flex gap-3">
            <button type="button" class="btn btn-premium d-flex align-items-center gap-2 px-4 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                <i class="bi bi-plus-lg"></i> Add Manual Review
            </button>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="row g-4 mb-5 animate-fade-in" style="animation-delay: 0.1s;">
        <div class="col-md-3">
            <div class="stat-card-premium p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Total Reviews</div>
                        <h3 class="fw-bold mb-0 text-dark">{{ $reviews->total() }}</h3>
                    </div>
                    <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 48px; height: 48px;">
                        <i class="bi bi-chat-left-text fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card-premium p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Approved</div>
                        <h3 class="fw-bold mb-0 text-success">{{ $reviews->where('status', 'approved')->count() }}</h3>
                    </div>
                    <div class="bg-success-subtle rounded-circle d-flex align-items-center justify-content-center text-success" style="width: 48px; height: 48px;">
                        <i class="bi bi-check-circle fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card-premium p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Pending</div>
                        <h3 class="fw-bold mb-0 text-warning">{{ $reviews->where('status', 'pending')->count() }}</h3>
                    </div>
                    <div class="bg-warning-subtle rounded-circle d-flex align-items-center justify-content-center text-warning" style="width: 48px; height: 48px;">
                        <i class="bi bi-hourglass-split fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card-premium p-4 h-100" >
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Avg Rating</div>
                        <h3 class="fw-bold mb-0 text-dark">
                            {{ number_format($reviews->avg('rating'), 1) }} <i class="bi bi-star-fill text-warning" style="font-size: 1.2rem;"></i>
                        </h3>
                    </div>
                    <div class="bg-warning-subtle rounded-circle d-flex align-items-center justify-content-center text-warning" style="width: 48px; height: 48px;">
                        <i class="bi bi-graph-up fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card premium-card border-0 mb-5 animate-fade-in" style="animation-delay: 0.2s;">
        <div class="table-responsive">
            <table class="table table-premium mb-0">
                <thead class="bg-white">
                    <tr>
                        <th class="ps-4">Product</th>
                        <th>Image</th>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Review Comment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($reviews as $review)
                    <tr class="review-row">
                        <td class="ps-4">
                            <div class="fw-bold text-primary" style="font-size: 0.9rem;">
                                {{ $review->product->name ?? 'Deleted Product' }}
                            </div>
                        </td>
                        <td>
                            @if($review->image)
                                <img src="{{ asset($review->image) }}" alt="Review Image" class="rounded-3 shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-secondary" style="width: 50px; height: 50px;">
                                    <i class="bi bi-image" style="opacity: 0.5;"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 0.9rem;">
                                {{ $review->user->name ?? 'Anonymous' }}
                            </div>
                            <div class="text-secondary mt-1" style="font-size: 0.8rem;">
                                {{ $review->user->email ?? '' }}
                            </div>
                        </td>
                        <td>
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td>
                            <div class="text-secondary" style="font-size: 0.85rem; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $review->comment }}">
                                "{{ $review->comment }}"
                            </div>
                        </td>
                        <td>
                            @php
                                $statusColor = 'secondary';
                                $statusIcon = 'bi-circle';
                                switch($review->status) {
                                    case 'pending': $statusColor = 'warning'; $statusIcon = 'bi-hourglass-split'; break;
                                    case 'approved': $statusColor = 'success'; $statusIcon = 'bi-check-circle'; break;
                                    case 'rejected': $statusColor = 'danger'; $statusIcon = 'bi-x-circle'; break;
                                }
                            @endphp
                            <span class="status-badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }}">
                                <i class="bi {{ $statusIcon }}"></i>
                                {{ strtoupper($review->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark" style="font-size: 0.85rem;">{{ $review->created_at->format('d M, Y') }}</div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                @if($review->status !== 'approved')
                                <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-light border rounded-circle d-inline-flex align-items-center justify-content-center text-success" style="width: 36px; height: 36px; transition: all 0.2s;" title="Approve">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                @endif
                                
                                @if($review->status !== 'rejected')
                                <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-light border rounded-circle d-inline-flex align-items-center justify-content-center text-warning" style="width: 36px; height: 36px; transition: all 0.2s;" title="Reject">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border rounded-circle d-inline-flex align-items-center justify-content-center text-danger" style="width: 36px; height: 36px; transition: all 0.2s;" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted d-flex flex-column align-items-center">
                                <i class="bi bi-chat-square-text mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
                                <h5 class="fw-bold text-dark">No Reviews Found</h5>
                                <p class="small mb-0">It seems there are no reviews for any products yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reviews->hasPages())
        <div class="card-footer bg-white py-4 px-4 border-0 border-top">
            {{ $reviews->links() }}
        </div>
        @endif
    </div>

    <!-- Add Review Modal -->
    <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-light border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="addReviewModalLabel">Add Manual Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('admin.reviews.store') }}" method="POST" id="manualReviewForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase letter-spacing-tight">Select Product</label>
                            <div class="premium-input-group">
                                <select name="product_id" class="form-select py-2 px-3 shadow-none text-dark" required>
                                    <option value="" disabled selected>Choose a product...</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase letter-spacing-tight">Assign to User</label>
                            <div class="premium-input-group">
                                <select name="user_id" class="form-select py-2 px-3 shadow-none text-dark" required>
                                    <option value="" disabled selected>Choose a user account...</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase letter-spacing-tight">Rating</label>
                            <div class="premium-input-group">
                                <select name="rating" class="form-select py-2 px-3 shadow-none text-dark" required>
                                    <option value="5">★★★★★ (5/5)</option>
                                    <option value="4">★★★★☆ (4/5)</option>
                                    <option value="3">★★★☆☆ (3/5)</option>
                                    <option value="2">★★☆☆☆ (2/5)</option>
                                    <option value="1">★☆☆☆☆ (1/5)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase letter-spacing-tight">Review Comment</label>
                            <textarea name="comment" class="form-control rounded-3 border bg-light shadow-none p-3" rows="4" placeholder="Write the review content here..." required></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase letter-spacing-tight">Review Image (Optional)</label>
                            <input type="file" name="image" class="form-control py-2 shadow-none" accept="image/*">
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase letter-spacing-tight">Status</label>
                            <div class="premium-input-group">
                                <select name="status" class="form-select py-2 px-3 shadow-none text-dark" required>
                                    <option value="approved" selected>Approved (Visible on site)</option>
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid mt-2">
                            <button type="submit" class="btn btn-premium rounded-pill py-2 fw-bold">Save Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
