@extends('admin.layout')

@section('title', 'Customer Wishlists')

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

    /* Premium Card */
    .premium-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    /* Premium Table */
    .table-premium th {
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #adb5bd;
        text-transform: uppercase;
        border-bottom: 2px solid #f8f9fa;
        padding: 1.25rem 1rem;
    }
    .table-premium td {
        padding: 1.5rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8f9fa;
    }

    /* Wishlist Product Tags */
    .wishlist-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.8rem;
        color: #495057;
        margin: 0 4px 8px 0;
        transition: all 0.2s ease;
    }
    .wishlist-tag:hover {
        background: #fff;
        border-color: #0d6efd;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.1);
        transform: translateY(-2px);
    }

    /* Value Badge */
    .value-badge {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
    }

    /* Action Buttons */
    .btn-send-email {
        background: #f8f9fa;
        color: #0d6efd;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    .btn-send-email:hover {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        border-color: transparent;
        box-shadow: 0 6px 15px rgba(13, 110, 253, 0.3);
        transform: translateY(-2px);
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
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-danger bg-opacity-10 p-4 rounded-4 text-danger d-flex align-items-center justify-content-center">
                    <i class="bi bi-heart-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="letter-spacing: -0.5px;">Customer Wishlists</h2>
                    <p class="text-secondary mb-0 fs-6">Track products your customers love and send targeted engagement emails.</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card premium-card fade-in-up" style="animation-delay: 0.2s;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium mb-0">
                    <thead class="bg-white">
                        <tr>
                            <th class="ps-4">Customer Details</th>
                            <th style="width: 45%;">Wishlisted Items</th>
                            <th>Total Interest Value</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse($users as $user)
                            @php
                                $totalValue = 0;
                                foreach($user->wishlistItems as $item) {
                                    $totalValue += $item->product->price;
                                }
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center fw-bold" style="width: 45px; height: 45px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 1.05rem;">{{ $user->name }}</div>
                                            <div class="text-secondary small d-flex align-items-center gap-1 mt-1">
                                                <i class="bi bi-envelope"></i> {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap">
                                        @foreach($user->wishlistItems as $item)
                                            <div class="wishlist-tag shadow-sm">
                                                <i class="bi bi-gem text-danger" style="font-size: 0.75rem;"></i>
                                                <span class="fw-semibold text-truncate" style="max-width: 150px;">{{ $item->product->name }}</span>
                                                <span class="badge bg-light text-dark border ms-1">${{ number_format($item->product->price) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="value-badge d-inline-block">
                                        ${{ number_format($totalValue) }}
                                    </div>
                                    <div class="small text-secondary mt-2 fw-semibold">
                                        {{ $user->wishlistItems->count() }} items
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <form action="{{ route('admin.engagement.wishlists.remind', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-send-email d-inline-flex align-items-center gap-2">
                                            <i class="bi bi-send-fill"></i> Send Offer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted d-flex flex-column align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                            <i class="bi bi-heart text-secondary" style="font-size: 2.5rem; opacity: 0.5;"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark">No Active Wishlists</h5>
                                        <p class="small mb-0">Customers haven't saved any items to their wishlists yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
