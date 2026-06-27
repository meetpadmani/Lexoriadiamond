@extends('admin.layout')

@section('title', 'Order Details - ' . $order->order_number)

@section('styles')
<style>
    .order-details-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    @media (max-width: 991.98px) {
        .order-details-container {
            grid-template-columns: 1fr;
        }
    }
    .order-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .card-header-royal {
        padding: 1.25rem 1.5rem;
        background: #fdfdfd;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-header-royal h5 {
        margin: 0;
        font-weight: 700;
        color: #212529;
    }
    .card-body-royal {
        padding: 1.5rem;
    }
    .item-row {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px dashed rgba(0,0,0,0.1);
    }
    .item-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }
    .item-image {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .item-info h6 {
        margin: 0 0 0.25rem 0;
        font-weight: 700;
        font-size: 1.05rem;
    }
    .total-summary {
        margin-top: 1.5rem;
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .total-summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        font-weight: 500;
        color: #495057;
    }
    .grand-total {
        font-size: 1.25rem;
        font-weight: 800;
        color: #000;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 2px dashed rgba(0,0,0,0.1);
        margin-bottom: 0;
    }
    .meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    .meta-item {
        margin-bottom: 0;
    }
    .meta-label {
        font-size: 0.75rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    .meta-value {
        font-weight: 600;
        color: #212529;
        font-size: 1rem;
    }
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        border-radius: 50rem;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cce5ff; color: #004085; }
    .status-shipped { background: #d4edda; color: #155724; }
    .status-delivered { background: #d1e7dd; color: #0f5132; }
    .status-cancelled { background: #f8d7da; color: #721c24; }
</style>
@endsection
@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
        <i class="bi bi-arrow-left me-2"></i> Back to Orders
    </a>
    <a href="{{ route('admin.orders.sticker', $order->id) }}" target="_blank" class="btn btn-sm btn btn-primary rounded-pill px-4">
        <i class="bi bi-printer me-2"></i> Print Royal Sticker
    </a>
</div>

<div class="order-details-container animate-fade-in">
    <!-- Left Column: Order Items & Info -->
    <div>
        <div class="order-card">
            <div class="card-header-royal">
                <h5><i class="bi bi-gem me-2"></i> Ordered Masterpieces</h5>
                <span class="text-secondary small">Ref: {{ $order->order_number }}</span>
            </div>
            <div class="card-body-royal">
                @foreach($order->items as $item)
                <div class="item-row">
                    @php
                        $image = $item->product ? $item->product->image : 'assets/images/placeholder.jpg';
                    @endphp
                    <img src="{{ asset($image) }}" alt="{{ $item->product_name }}" class="item-image">
                    <div class="item-info flex-grow-1">
                        <h6>{{ $item->product_name }}</h6>
                        <span class="text-secondary small">Valuation: ${{ number_format($item->price) }} x {{ $item->quantity }}</span>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold">${{ number_format($item->subtotal) }}</span>
                    </div>
                </div>
                @endforeach

                <div class="total-summary">
                    <div class="total-summary-row">
                        <span>Treasury Subtotal</span>
                        <span>${{ number_format($order->total_amount + $order->discount_amount) }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                    <div class="total-summary-row text-success">
                        <span>Royal Discount ({{ $order->coupon_code }})</span>
                        <span>- ${{ number_format($order->discount_amount) }}</span>
                    </div>
                    @endif
                    <div class="total-summary-row">
                        <span>Sacred Delivery</span>
                        <span class="text-success">Complimentary</span>
                    </div>
                    <div class="total-summary-row grand-total">
                        <span>Grand Total</span>
                        <span>${{ number_format($order->total_amount) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="order-card">
            <div class="card-header-royal">
                <h5><i class="bi bi-geo-alt me-2"></i> Delivery Mandate</h5>
            </div>
            <div class="card-body-royal">
                <div class="meta-grid">
                    <div class="meta-item">
                        <div class="meta-label">Recipient Name</div>
                        <div class="meta-value">{{ $order->first_name }} {{ $order->last_name }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Contact Number</div>
                        <div class="meta-value">{{ $order->mobile }}</div>
                    </div>
                    <div class="meta-item" style="grid-column: span 2;">
                        <div class="meta-label">Palace Address</div>
                        <div class="meta-value">{{ $order->address }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">City</div>
                        <div class="meta-value">{{ $order->city }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Postal Code</div>
                        <div class="meta-value">{{ $order->pincode }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Status & Actions -->
    <div>
        <div class="order-card">
            <div class="card-header-royal">
                <h5>Order Status</h5>
            </div>
            <div class="card-body-royal">
                <div class="text-center mb-4">
                    <span class="status-badge status-{{ $order->status }}">
                        {{ $order->status }}
                    </span>
                    <div class="mt-2 small text-secondary">Ordered on {{ $order->created_at->format('d M Y, h:i A') }}</div>
                </div>

                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Update Status</label>
                        <select name="status" class="form-select border-2">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending Approval</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>In Preparation</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dispatched</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-2 rounded-3 fw-bold">Update Mandate</button>
                </form>
            </div>
        </div>

        <div class="order-card">
            <div class="card-header-royal">
                <h5>Shipping & Tracking</h5>
            </div>
            <div class="card-body-royal">
                <form action="{{ route('admin.orders.updateTracking', $order->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Courier Name</label>
                        <select name="courier_name" class="form-select border-2">
                            <option value="">Select Courier</option>
                            <option value="Blue Dart" {{ $order->courier_name == 'Blue Dart' ? 'selected' : '' }}>Blue Dart</option>
                            <option value="Delhivery" {{ $order->courier_name == 'Delhivery' ? 'selected' : '' }}>Delhivery</option>
                            <option value="Shiprocket" {{ $order->courier_name == 'Shiprocket' ? 'selected' : '' }}>Shiprocket</option>
                            <option value="Royal Guard" {{ $order->courier_name == 'Royal Guard' ? 'selected' : '' }}>Royal Guard (Internal)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tracking Number</label>
                        <input type="text" name="tracking_number" class="form-control border-2" value="{{ $order->tracking_number }}" placeholder="Enter Tracking ID">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tracking URL</label>
                        <input type="url" name="tracking_url" class="form-control border-2" value="{{ $order->tracking_url }}" placeholder="https://tracking.link">
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-2 rounded-3 fw-bold">
                        {{ $order->tracking_number ? 'Update Tracking' : 'Assign Tracking' }}
                    </button>
                </form>

                @if($order->tracking_number)
                <div class="mt-3 p-3 bg-light rounded-3 text-center">
                    <div class="small fw-bold text-muted mb-1">{{ $order->courier_name }} Tracking</div>
                    <div class="fw-bold">{{ $order->tracking_number }}</div>
                    @if($order->tracking_url)
                    <a href="{{ $order->tracking_url }}" target="_blank" class="btn btn-sm btn-outline-dark mt-2 w-100 rounded-pill">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Track Live
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <div class="order-card">
            <div class="card-header-royal">
                <h5>Payment Info</h5>
            </div>
            <div class="card-body-royal">
                <div class="meta-item">
                    <div class="meta-label">Method</div>
                    <div class="meta-value text-uppercase">{{ $order->payment_method }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">Currency</div>
                    <div class="meta-value">USD ($)</div>
                </div>
            </div>
        </div>

        <div class="order-card">
            <div class="card-header-royal">
                <h5>Sticker Preview</h5>
            </div>
            <div class="card-body-royal p-0">
                <div style="background: #f0f0f0; padding: 20px; display: flex; justify-content: center;">
                    <iframe src="{{ route('admin.orders.sticker', $order->id) }}" 
                            style="width: 100%; height: 500px; border: none; transform: scale(0.85); transform-origin: top center;"
                            scrolling="no"></iframe>
                </div>
                <div class="p-3 text-center">
                    <a href="{{ route('admin.orders.sticker', $order->id) }}" target="_blank" class="btn btn-sm btn-dark rounded-pill">
                        <i class="bi bi-arrows-fullscreen me-2"></i> Open Full View
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
