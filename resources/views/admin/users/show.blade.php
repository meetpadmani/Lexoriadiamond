@extends('admin.layout')

@section('title', 'Patron Profile - ' . $user->name)

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

    /* Table Enhancements */
    .table-premium th {
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #adb5bd;
        text-transform: uppercase;
        border-bottom: 2px solid #f8f9fa;
        padding: 1rem;
    }
    .table-premium td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8f9fa;
    }
    .user-row {
        transition: background-color 0.2s ease;
    }
    .user-row:hover {
        background-color: #fcfdfd !important;
    }

    /* Profile Header Gradient */
    .profile-header-premium {
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.15) 100%);
        border-bottom: 1px solid rgba(13, 110, 253, 0.1);
        border-radius: 20px 20px 0 0;
    }

    /* Premium Avatar Large */
    .avatar-premium-lg {
        width: 80px;
        height: 80px;
        border-radius: 24px;
        background: #ffffff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 2.2rem;
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.15);
        text-transform: uppercase;
        border: 2px solid #ffffff;
    }

    .address-card-premium {
        border: 1px solid #f1f1f1;
        border-radius: 16px;
        transition: all 0.2s ease;
        background: #ffffff;
    }
    .address-card-premium:hover {
        border-color: #0d6efd;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.05);
    }
</style>
@endsection

@section('content')

    {{-- Header --}}
    <div class="mb-5 d-flex justify-content-between align-items-center animate-fade-in">
        <div class="d-flex align-items-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-circle p-2 shadow-sm border" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-arrow-left fs-5 text-secondary"></i>
            </a>
            <div>
                <h3 class="mb-1 fw-bold text-dark letter-spacing-tight">Patron Profile</h3>
                <p class="text-secondary small mb-0">Detailed view of {{ $user->name }}'s engagement and history</p>
            </div>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn {{ $user->status === 'active' ? 'btn-outline-danger' : 'btn-success' }} rounded-pill px-4 py-2 fw-bold shadow-sm d-flex align-items-center gap-2">
                    <i class="bi bi-{{ $user->status === 'active' ? 'slash-circle' : 'check-circle' }}"></i>
                    <span>{{ $user->status === 'active' ? 'Block Account' : 'Unblock Account' }}</span>
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4 animate-fade-in" style="animation-delay: 0.1s;">
        {{-- Left Column: User Info & Addresses --}}
        <div class="col-lg-4">
            {{-- Profile Card --}}
            <div class="card premium-card mb-4 overflow-hidden border-0">
                <div class="card-header profile-header-premium py-5 text-center border-0" >
                    <div class="avatar-premium-lg mx-auto mb-3" >
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h4 class="text-dark fw-bold mb-1" >{{ $user->name }}</h4>
                    <span class="badge bg-primary text-white rounded-pill px-3 py-1 shadow-sm" style="letter-spacing: 1px;">PATRON</span>
                </div>
                <div class="card-body p-4 bg-white">
                    <div class="info-list">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-light p-2 rounded-circle text-primary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <div class="small text-secondary fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Email Address</div>
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $user->email }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-light p-2 rounded-circle text-primary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <div class="small text-secondary fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Phone Number</div>
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $user->phone ?? 'Not Linked' }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-light p-2 rounded-circle text-primary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-calendar2-check"></i>
                            </div>
                            <div>
                                <div class="small text-secondary fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Member Since</div>
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $user->created_at->format('d M, Y') }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-{{ $user->status === 'active' ? 'success' : 'danger' }}-subtle p-2 rounded-circle text-{{ $user->status === 'active' ? 'success' : 'danger' }}" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <div class="small text-secondary fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Account Status</div>
                                <div class="fw-bold {{ $user->status === 'active' ? 'text-success' : 'text-danger' }}" style="font-size: 0.95rem;">
                                    {{ ucfirst($user->status) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Addresses Card --}}
            <div class="card premium-card border-0">
                <div class="card-header bg-white py-4 border-0 px-4 d-flex align-items-center gap-2">
                    <div class="bg-primary-subtle text-primary p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h5 class="mb-0 fw-bold" style="font-size: 1.1rem;">Patron Addresses</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    @forelse($user->addresses as $address)
                        <div class="address-card-premium p-4 mb-3 position-relative {{ $address->is_default ? 'border-primary bg-primary-subtle' : 'bg-light' }}">
                            @if($address->is_default)
                                <span class="badge bg-primary position-absolute top-0 end-0 mt-3 me-3" style="font-size: 0.65rem; letter-spacing: 1px;">DEFAULT</span>
                            @endif
                            <div class="small text-uppercase fw-bold text-primary mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">
                                <i class="bi bi-house-door me-1"></i> {{ $address->type }} ADDRESS
                            </div>
                            <div class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">{{ $address->address_line_1 }}</div>
                            @if($address->address_line_2) <div class="text-secondary small">{{ $address->address_line_2 }}</div> @endif
                            <div class="text-secondary small mt-1">{{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}</div>
                            @if($address->phone) <div class="text-dark small mt-3 fw-bold"><i class="bi bi-telephone text-primary me-2"></i> {{ $address->phone }}</div> @endif
                        </div>
                    @empty
                        <div class="text-center py-5 bg-light rounded-4 border">
                            <div class="bg-white rounded-circle d-inline-flex p-3 shadow-sm mb-3">
                                <i class="bi bi-geo-alt text-muted fs-3"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">No Addresses</h6>
                            <p class="small text-secondary mb-0">This user hasn't added any addresses yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right Column: Orders & Reviews --}}
        <div class="col-lg-8">
            {{-- Order History --}}
            <div class="card premium-card mb-4 border-0">
                <div class="card-header bg-white py-4 px-4 border-0 d-flex justify-content-between align-items-center border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-primary-subtle text-primary p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-bag-check-fill"></i>
                        </div>
                        <h5 class="mb-0 fw-bold" style="font-size: 1.1rem;">Acquisition History</h5>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-sm">{{ $user->orders->count() }} Orders</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-premium align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Mandate ID</th>
                                    <th>Valuation</th>
                                    <th>Credits Earned</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th class="pe-4 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse($user->orders as $order)
                                <tr class="user-row" style="cursor: pointer;" onclick="window.location='{{ route('admin.orders.show', $order->id) }}';">
                                    <td class="ps-4 py-3">
                                        <div class="fw-bold text-primary">{{ $order->order_number }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">${{ number_format($order->total_amount) }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-success d-flex align-items-center gap-1">
                                            <i class="bi bi-coin"></i>
                                            {{ number_format($order->total_amount * 0.10) }} Credits
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-3 py-2 bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}-subtle text-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}" style="font-size: 0.75rem;">
                                            <i class="bi bi-circle-fill me-1" style="font-size: 0.4rem; vertical-align: middle;"></i>
                                            {{ strtoupper($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-dark small fw-bold">{{ $order->created_at->format('d M, Y') }}</div>
                                        <div class="text-secondary" style="font-size: 0.7rem;">{{ $order->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-light btn-sm rounded-circle shadow-sm" style="width: 32px; height: 32px;">
                                            <i class="bi bi-chevron-right text-primary"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted d-flex flex-column align-items-center">
                                            <i class="bi bi-bag-x mb-3" style="font-size: 2.5rem; opacity: 0.3;"></i>
                                            <h6 class="fw-bold text-dark">No Orders Yet</h6>
                                            <p class="small mb-0">This user hasn't made any purchases.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Product Feedback (Reviews) --}}
            <div class="card premium-card border-0">
                <div class="card-header bg-white py-4 px-4 border-0 d-flex align-items-center gap-2 border-bottom">
                    <div class="bg-warning-subtle text-warning p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <h5 class="mb-0 fw-bold" style="font-size: 1.1rem;">Product Feedback</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-premium align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Product</th>
                                    <th>Rating</th>
                                    <th>Feedback</th>
                                    <th>Status</th>
                                    <th class="pe-4 text-end">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse($user->reviews as $review)
                                <tr class="user-row">
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($review->product->image)
                                                <img src="{{ asset($review->product->image) }}" alt="" style="width: 45px; height: 45px; object-fit: cover; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                                            @endif
                                            <div class="small fw-bold text-dark">{{ $review->product->name }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-warning bg-warning-subtle d-inline-block px-2 py-1 rounded-pill" style="font-size: 0.8rem;">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-secondary fw-500" style="max-width: 250px; line-height: 1.4;">{{ $review->comment }}</div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-3 py-1 bg-{{ $review->status === 'approved' ? 'success' : ($review->status === 'rejected' ? 'danger' : 'light text-dark') }}" style="font-size: 0.7rem;">
                                            {{ strtoupper($review->status) }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end small text-muted fw-bold">{{ $review->created_at->format('d M, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted d-flex flex-column align-items-center">
                                            <i class="bi bi-chat-left-text mb-3" style="font-size: 2.5rem; opacity: 0.3;"></i>
                                            <h6 class="fw-bold text-dark">No Reviews Yet</h6>
                                            <p class="small mb-0">This user hasn't left any product feedback.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
