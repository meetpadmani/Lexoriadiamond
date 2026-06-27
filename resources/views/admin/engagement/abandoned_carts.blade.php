@extends('admin.layout')

@section('title', 'Abandoned Carts')

@section('styles')
<style>
    .premium-page-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.02);
        margin-bottom: 2rem;
        border: 1px solid rgba(0,0,0,0.03);
    }
    
    .premium-panel {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    /* Studio Table Styling */
    .table-studio {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .table-studio th {
        border: none;
        padding: 1rem 1.5rem;
        color: #6c757d;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: transparent;
    }
    .table-studio td {
        border: none;
        padding: 1.25rem 1.5rem;
        background: #ffffff;
        vertical-align: middle;
        border-top: 1px solid rgba(0,0,0,0.02);
        border-bottom: 1px solid rgba(0,0,0,0.02);
        color: #495057;
    }
    .table-studio tr {
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.01);
    }
    .table-studio tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.04);
    }
    .table-studio td:first-child {
        border-left: 1px solid rgba(0,0,0,0.02);
        border-top-left-radius: 16px;
        border-bottom-left-radius: 16px;
    }
    .table-studio td:last-child {
        border-right: 1px solid rgba(0,0,0,0.02);
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    /* Customer Avatar */
    .customer-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        text-transform: uppercase;
    }

    /* Product Tag */
    .product-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f8f9fa;
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 5px;
        border: 1px solid rgba(0,0,0,0.04);
    }
    .product-tag span.qty {
        background: #e9ecef;
        padding: 2px 6px;
        border-radius: 6px;
        font-size: 0.75rem;
    }

    .btn-action {
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
    }

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
                    <i class="bi bi-cart-x-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Abandoned Carts</h2>
                    <p class="text-secondary mb-0 fs-6">Recover lost sales by sending targeted email reminders to potential customers.</p>
                </div>
            </div>
            <div>
                <span class="badge bg-danger bg-opacity-10 text-danger fs-6 px-4 py-3 rounded-pill fw-bold border border-danger border-opacity-25">
                    <i class="bi bi-graph-down-arrow me-2"></i> {{ count($users) }} Potential Conversions
                </span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="premium-panel fade-in-up" style="animation-delay: 0.2s;">
        
        <form id="bulk-remind-form" action="{{ route('admin.engagement.abandoned-carts.bulk-remind') }}" method="POST">
            @csrf

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark">Cart Details</h5>
                <button type="submit" class="btn btn-premium px-4 py-2" id="bulk-send-btn" disabled>
                    <i class="bi bi-envelope-check me-2"></i> Send Selected Reminders
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-studio">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <input class="form-check-input" type="checkbox" id="select-all" style="width: 1.2rem; height: 1.2rem; cursor: pointer;">
                            </th>
                            <th>Customer</th>
                            <th style="min-width: 250px;">Items in Cart</th>
                            <th>Total Value</th>
                            <th>Last Activity</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            @php
                                $totalValue = 0;
                                foreach($user->cartItems as $item) {
                                    $totalValue += $item->product->price * $item->quantity;
                                }
                            @endphp
                            <tr>
                                <td>
                                    <input class="form-check-input user-checkbox" type="checkbox" name="selected_users[]" value="{{ $user->id }}" style="width: 1.2rem; height: 1.2rem; cursor: pointer;">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="customer-avatar">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark fs-6">{{ $user->name }}</div>
                                            <div class="text-secondary small"><i class="bi bi-envelope me-1"></i>{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($user->cartItems as $item)
                                            <div class="product-tag">
                                                <span class="qty">{{ $item->quantity }}x</span>
                                                <span class="text-truncate" style="max-width: 150px;" title="{{ $item->product->name }}">{{ $item->product->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bolder fs-5 text-dark">${{ number_format($totalValue) }}</span>
                                </td>
                                <td>
                                    <div class="text-secondary fw-bold">
                                        <i class="bi bi-clock me-1 text-warning"></i> 
                                        {{ $user->cartItems->first()->updated_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-primary btn-action" onclick="event.preventDefault(); document.getElementById('remind-form-{{ $user->id }}').submit();">
                                        <i class="bi bi-send-fill me-2"></i> Send Reminder
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-cart-check text-muted mb-3" style="font-size: 4rem; opacity: 0.5;"></i>
                                        <h4 class="text-muted fw-bold">No abandoned carts found.</h4>
                                        <p class="text-secondary">Great job! All your customers are completing their purchases.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        {{-- Hidden individual forms --}}
        @foreach($users as $user)
            <form id="remind-form-{{ $user->id }}" action="{{ route('admin.engagement.abandoned-carts.remind', $user->id) }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endforeach

    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.user-checkbox');
        const bulkBtn = document.getElementById('bulk-send-btn');

        function updateBtnState() {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            bulkBtn.disabled = !anyChecked;
        }

        if(selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateBtnState();
            });
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const allChecked = Array.from(checkboxes).every(c => c.checked);
                if(selectAll) selectAll.checked = allChecked;
                updateBtnState();
            });
        });
    });
</script>
@endsection
