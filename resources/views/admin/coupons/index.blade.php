@extends('admin.layout')

@section('title', 'Discount & Coupons')

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
    
    .coupon-tag {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 1px dashed #ced4da;
        padding: 6px 12px;
        border-radius: 8px;
        font-family: monospace;
        font-weight: bold;
        letter-spacing: 1px;
        color: #495057;
        display: inline-block;
    }
</style>
@endsection

@section('content')

    <!-- Header Area -->
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                <i class="bi bi-ticket-perforated-fill text-primary fs-4"></i>
            </div>
            <div>
                <h3 class="mb-1 fw-bold text-dark letter-spacing-tight">Discount Coupons</h3>
                <p class="text-secondary small mb-0">Create and manage promotional campaigns and offers.</p>
            </div>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-premium d-flex align-items-center gap-2 px-4 rounded-pill fw-bold">
                <i class="bi bi-plus-lg"></i> Create New Coupon
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Stats Summary -->
    <div class="row g-4 mb-5 animate-fade-in" style="animation-delay: 0.1s;">
        <div class="col-md-4">
            <div class="stat-card-premium p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Total Coupons</div>
                        <h3 class="fw-bold mb-0 text-dark">{{ $coupons->total() }}</h3>
                    </div>
                    <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 48px; height: 48px;">
                        <i class="bi bi-ticket-detailed fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card-premium p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Active Coupons</div>
                        <h3 class="fw-bold mb-0 text-success">{{ $coupons->where('is_active', true)->count() }}</h3>
                    </div>
                    <div class="bg-success-subtle rounded-circle d-flex align-items-center justify-content-center text-success" style="width: 48px; height: 48px;">
                        <i class="bi bi-check-circle fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card-premium p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Total Usage</div>
                        <h3 class="fw-bold mb-0 text-info">{{ collect($coupons->items())->sum('used_count') }}</h3>
                    </div>
                    <div class="bg-info-subtle rounded-circle d-flex align-items-center justify-content-center text-info" style="width: 48px; height: 48px;">
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
                        <th class="ps-4">Coupon Code</th>
                        <th>Type & Value</th>
                        <th>Usage limit</th>
                        <th>One-Time Use?</th>
                        <th>Validity</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($coupons as $coupon)
                    <tr>
                        <td class="ps-4">
                            <div class="coupon-tag shadow-sm">
                                <i class="bi bi-tag-fill text-muted me-1 small"></i>{{ $coupon->code }}
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark" style="font-size: 1.1rem;">
                                {{ $coupon->type === 'percentage' ? $coupon->value . '%' : '$' . number_format($coupon->value) }}
                                <span class="text-secondary fw-normal" style="font-size: 0.8rem;">OFF</span>
                            </div>
                            <div class="text-secondary mt-1" style="font-size: 0.8rem;">Min. Cart: ${{ number_format($coupon->min_purchase_amount) }}</div>
                        </td>
                        <td>
                            @php
                                $percent = $coupon->usage_limit ? min(100, ($coupon->used_count / $coupon->usage_limit) * 100) : 0;
                                $progressColor = $percent > 90 ? 'bg-danger' : ($percent > 75 ? 'bg-warning' : 'bg-primary');
                            @endphp
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div class="progress flex-grow-1 bg-light rounded-pill" style="height: 6px;">
                                    <div class="progress-bar {{ $progressColor }} rounded-pill" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                            <div class="text-secondary fw-bold" style="font-size: 0.75rem;">
                                {{ $coupon->used_count }} / {{ $coupon->usage_limit ?? 'Unlimited' }} Used
                            </div>
                        </td>
                        <td>
                            @if($coupon->is_one_time)
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2"><i class="bi bi-person-check me-1"></i> Yes (1 per user)</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">No Limit</span>
                            @endif
                        </td>
                        <td>
                            @if($coupon->expiry_date)
                                <div class="fw-bold {{ $coupon->expiry_date->isPast() ? 'text-danger' : 'text-dark' }}" style="font-size: 0.85rem;">
                                    <i class="bi bi-calendar-event me-1"></i> {{ $coupon->expiry_date->format('d M, Y') }}
                                </div>
                                <div class="text-secondary mt-1" style="font-size: 0.75rem;">
                                    {{ $coupon->expiry_date->isPast() ? 'Expired' : 'Expires ' . $coupon->expiry_date->diffForHumans() }}
                                </div>
                            @else
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-2">Indefinite</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.coupons.toggleStatus', $coupon->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="badge rounded-pill px-3 py-2 border-0 shadow-sm {{ $coupon->is_active ? 'bg-success text-white' : 'bg-danger text-white' }}" style="cursor: pointer; transition: all 0.2s;">
                                    <i class="bi {{ $coupon->is_active ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                                    {{ $coupon->is_active ? 'ACTIVE' : 'DISABLED' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-light border rounded-circle d-inline-flex align-items-center justify-content-center text-primary" style="width: 36px; height: 36px; transition: all 0.2s;" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon?');">
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
                                <i class="bi bi-ticket-perforated mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
                                <h5 class="fw-bold text-dark">No Coupons Found</h5>
                                <p class="small mb-0">Create a coupon to offer discounts to your customers.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($coupons->hasPages())
        <div class="card-footer bg-white py-4 px-4 border-0 border-top">
            {{ $coupons->links() }}
        </div>
        @endif
    </div>

@endsection
