@extends('admin.layout')

@section('title', 'Order Management')

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
    .order-row {
        transition: background-color 0.2s ease;
    }
    .order-row:hover {
        background-color: #fcfdfd !important;
    }

    /* Image Thumbnail */
    .img-thumbnail-premium {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        border: 1px solid #f1f1f1;
        background: #fff;
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
</style>
@endsection

@section('content')

    <!-- Header Area -->
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                <i class="bi bi-cart-check text-primary fs-4"></i>
            </div>
            <div>
                <h3 class="mb-1 fw-bold text-dark letter-spacing-tight">Order Management</h3>
                <p class="text-secondary small mb-0">Manage and track all customer transactions and fulfillments.</p>
            </div>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('admin.engagement.abandoned-carts') }}" class="btn btn-light bg-white border shadow-sm rounded-3 d-flex align-items-center gap-2 px-3 fw-bold text-secondary position-relative" style="font-size: 0.85rem; transition: all 0.2s;">
                <i class="bi bi-cart-x text-danger fs-5"></i>
                <span class="d-none d-md-inline">Abandoned Carts</span>
                @if($abandonedCartsCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; transform: translate(-30%, -30%) !important;">
                        {{ $abandonedCartsCount }}
                    </span>
                @endif
            </a>
            <div class="premium-input-group d-flex align-items-center px-2 bg-white shadow-sm" style="width: 250px;">
                <i class="bi bi-search text-muted ms-2"></i>
                <input type="text" class="form-control py-2 shadow-none" placeholder="Search Order ID..." style="font-size: 0.85rem;">
            </div>
            <div class="premium-input-group d-flex align-items-center px-2 bg-white shadow-sm" style="width: 160px;">
                <i class="bi bi-funnel text-muted ms-2"></i>
                <select class="form-select py-2 shadow-none text-secondary" style="font-size: 0.85rem; cursor: pointer;">
                    <option>All Status</option>
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Shipped</option>
                    <option>Delivered</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="row g-4 mb-5 animate-fade-in" style="animation-delay: 0.1s;">
        <div class="col-md-3">
            <div class="stat-card-premium p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Total Orders</div>
                        <h3 class="fw-bold mb-0 text-dark">{{ $orders->total() }}</h3>
                    </div>
                    <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 48px; height: 48px;">
                        <i class="bi bi-journals fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card-premium p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Pending</div>
                        <h3 class="fw-bold mb-0 text-warning">{{ $orders->where('status', 'pending')->count() }}</h3>
                    </div>
                    <div class="bg-warning-subtle rounded-circle d-flex align-items-center justify-content-center text-warning" style="width: 48px; height: 48px;">
                        <i class="bi bi-clock-history fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card-premium p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Shipped</div>
                        <h3 class="fw-bold mb-0 text-info">{{ $orders->where('status', 'shipped')->count() }}</h3>
                    </div>
                    <div class="bg-info-subtle rounded-circle d-flex align-items-center justify-content-center text-info" style="width: 48px; height: 48px;">
                        <i class="bi bi-truck fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card-premium p-4 h-100" >
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Total Earnings</div>
                        <h3 class="fw-bold mb-0 text-success">${{ number_format($orders->sum('total_amount')) }}</h3>
                    </div>
                    <div class="bg-success-subtle rounded-circle d-flex align-items-center justify-content-center text-success" style="width: 48px; height: 48px;">
                        <i class="bi bi-currency-dollar fs-4"></i>
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
                        <th class="ps-4">Order ID</th>
                        <th class="d-none d-md-table-cell">Items</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th class="d-none d-lg-table-cell">Payment</th>
                        <th>Status</th>
                        <th class="d-none d-xl-table-cell">Order Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($orders as $order)
                    <tr class="order-row" style="cursor: pointer;" onclick="window.location='{{ route('admin.orders.show', $order->id) }}';">
                        <td class="ps-4">
                            <div class="fw-bold text-primary">{{ $order->order_number }}</div>
                            <div class="d-md-none text-muted" style="font-size: 0.7rem;">{{ $order->created_at->format('d M') }}</div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            @php $firstItem = $order->items->first(); @endphp
                            <div class="position-relative d-inline-block">
                                @if($firstItem && $firstItem->product)
                                    <img src="{{ str_starts_with($firstItem->product->image, 'http') ? $firstItem->product->image : asset($firstItem->product->image) }}" alt="" class="img-thumbnail-premium">
                                    @if($order->items->count() > 1)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark border border-white" style="font-size: 0.6rem;">
                                            +{{ $order->items->count() - 1 }}
                                        </span>
                                    @endif
                                @else
                                    <div class="img-thumbnail-premium bg-light d-flex align-items-center justify-content-center text-muted fs-4">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark d-flex align-items-center gap-2">
                                {{ $order->first_name }} {{ $order->last_name }}
                            </div>
                            <div class="text-secondary mt-1 d-none d-md-block" style="font-size: 0.8rem;">
                                <i class="bi bi-envelope-at me-1 text-muted"></i>{{ $order->email }}
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">${{ number_format($order->total_amount) }}</div>
                            @if($order->discount_amount > 0)
                                <div class="text-success fw-bold mt-1 d-flex align-items-center gap-1" style="font-size: 0.7rem;" title="Coupon: {{ $order->coupon_code }}">
                                    <i class="bi bi-tag-fill"></i>-${{ number_format($order->discount_amount) }}
                                </div>
                            @endif
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-light p-2 rounded-circle text-secondary" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi {{ $order->payment_method == 'cod' ? 'bi-cash-coin' : 'bi-credit-card' }}"></i>
                                </div>
                                <span class="fw-bold text-secondary" style="font-size: 0.75rem; letter-spacing: 0.5px;">{{ strtoupper($order->payment_method) }}</span>
                            </div>
                        </td>
                        <td>
                            @php
                                $statusColor = 'secondary';
                                $statusIcon = 'bi-circle';
                                switch($order->status) {
                                    case 'pending': $statusColor = 'warning'; $statusIcon = 'bi-clock'; break;
                                    case 'processing': $statusColor = 'info'; $statusIcon = 'bi-arrow-repeat'; break;
                                    case 'shipped': $statusColor = 'primary'; $statusIcon = 'bi-truck'; break;
                                    case 'delivered': $statusColor = 'success'; $statusIcon = 'bi-check-circle'; break;
                                    case 'cancelled': $statusColor = 'danger'; $statusIcon = 'bi-x-circle'; break;
                                }
                            @endphp
                            <span class="status-badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }}">
                                <i class="bi {{ $statusIcon }}"></i>
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <div class="fw-bold text-dark" style="font-size: 0.85rem;">{{ $order->created_at->format('d M, Y') }}</div>
                            <div class="text-secondary" style="font-size: 0.75rem;">{{ $order->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="text-end pe-4" onclick="event.stopPropagation();">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.orders.sticker', $order->id) }}" target="_blank" class="btn btn-sm btn-light border rounded-circle d-inline-flex align-items-center justify-content-center text-secondary" style="width: 36px; height: 36px; transition: all 0.2s;" title="Print Label" onmouseover="this.classList.replace('text-secondary', 'text-dark')" onmouseout="this.classList.replace('text-dark', 'text-secondary')">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border rounded-circle d-inline-flex align-items-center justify-content-center text-primary" style="width: 36px; height: 36px; transition: all 0.2s;" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order record? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border rounded-circle d-inline-flex align-items-center justify-content-center text-danger" style="width: 36px; height: 36px; transition: all 0.2s;" title="Delete Order">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="text-muted d-flex flex-column align-items-center">
                                <i class="bi bi-bag-x mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
                                <h5 class="fw-bold text-dark">No Orders Found</h5>
                                <p class="small mb-0">It seems there are no orders matching your criteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
        <div class="card-footer bg-white py-4 px-4 border-0 border-top">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
@endsection
