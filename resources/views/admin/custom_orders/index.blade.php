@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-dark fw-bold">Custom Jewelry Orders</h4>
</div>

<!-- Custom Inquiries Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card p-4 h-100" style="background: #ffffff; border: 1px solid var(--border-color); border-radius: var(--radius-md); box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="small text-muted fw-bold mb-2 stat-title">Total Inquiries</div>
                    <h3 class="fw-bold mb-0 stat-value text-dark">{{ $customOrderStats['total'] }}</h3>
                </div>
                <div class="stat-icon-box" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: #cfe2ff; color: #0d6efd; font-size: 1.5rem; border-radius: var(--radius-sm);">
                    <i class="bi bi-clipboard-data"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card p-4 h-100" style="background: #ffffff; border: 1px solid var(--border-color); border-radius: var(--radius-md); box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="small text-muted fw-bold mb-2 stat-title">Pending</div>
                    <h3 class="fw-bold mb-0 stat-value text-dark">{{ $customOrderStats['pending'] }}</h3>
                </div>
                <div class="stat-icon-box" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: #fff3cd; color: #ffc107; font-size: 1.5rem; border-radius: var(--radius-sm);">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card p-4 h-100" style="background: #ffffff; border: 1px solid var(--border-color); border-radius: var(--radius-md); box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="small text-muted fw-bold mb-2 stat-title">Completed / Accepted</div>
                    <h3 class="fw-bold mb-0 stat-value text-dark">{{ $customOrderStats['completed'] + $customOrderStats['accepted'] }}</h3>
                </div>
                <div class="stat-icon-box" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: #d1e7dd; color: #198754; font-size: 1.5rem; border-radius: var(--radius-sm);">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card p-4 h-100" style="background: #ffffff; border: 1px solid var(--border-color); border-radius: var(--radius-md); box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="small text-muted fw-bold mb-2 stat-title">Cancelled / Rejected</div>
                    <h3 class="fw-bold mb-0 stat-value text-dark">{{ $customOrderStats['rejected'] }}</h3>
                </div>
                <div class="stat-icon-box" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: #f8d7da; color: #dc3545; font-size: 1.5rem; border-radius: var(--radius-sm);">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<style>
    /* Premium Dropdown Styles */
    .status-dropdown .dropdown-menu {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid rgba(0,0,0,0.05);
        padding: 8px;
        animation: dropFadeIn 0.2s ease-out;
    }
    .status-dropdown .dropdown-item {
        border-radius: 8px;
        padding: 10px 16px;
        transition: all 0.2s;
        margin-bottom: 4px;
        font-weight: 500;
        color: #495057;
    }
    .status-dropdown .dropdown-item:last-child {
        margin-bottom: 0;
    }
    .status-dropdown .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(4px);
        color: #212529;
    }
    .status-dropdown .dropdown-item.active {
        background-color: #f1f3f5;
        color: #212529;
    }
    @keyframes dropFadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="card border-0 shadow-sm rounded-4" style="border-radius: 1rem;">
    <div style="min-height: 350px; padding: 1rem;">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 text-secondary fw-semibold py-3 border-0 rounded-start" style="font-size: 0.85rem; letter-spacing: 0.5px;">CUSTOMER</th>
                    <th class="text-secondary fw-semibold py-3 border-0" style="font-size: 0.85rem; letter-spacing: 0.5px;">CONTACT</th>
                    <th class="text-secondary fw-semibold py-3 border-0" style="font-size: 0.85rem; letter-spacing: 0.5px;">STATUS</th>
                    <th class="text-secondary fw-semibold py-3 border-0" style="font-size: 0.85rem; letter-spacing: 0.5px;">DATE</th>
                    <th class="pe-4 text-end text-secondary fw-semibold py-3 border-0 rounded-end" style="font-size: 0.85rem; letter-spacing: 0.5px;">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse($customOrders as $order)
                <tr style="cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='transparent'" onclick="window.location='{{ route('admin.custom_orders.show', $order->id) }}';">
                    <td class="ps-4 border-bottom py-3">
                        <div class="d-flex align-items-center gap-3">
                            @php
                                $img = (is_array($order->images) && count($order->images) > 0) ? $order->images[0] : null;
                            @endphp
                            @if($img)
                                <img src="{{ asset('storage/' . $img) }}" alt="Design" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #eaeaea;">
                            @else
                                <div class="rounded bg-light d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; border: 1px solid #eaeaea;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                            <div>
                                <div class="fw-bold text-dark">{{ $order->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="border-bottom">
                        <div class="text-secondary small mb-1"><i class="bi bi-telephone-fill me-2 text-muted"></i> {{ $order->phone }}</div>
                        <div class="text-secondary small"><i class="bi bi-envelope-fill me-2 text-muted"></i> {{ $order->email }}</div>
                    </td>
                    <td class="border-bottom" onclick="event.stopPropagation();">
                        <div class="dropdown status-dropdown">
                            @php
                                $badgeClass = match($order->status) {
                                    'pending' => 'bg-warning text-dark',
                                    'reviewed' => 'bg-info text-dark',
                                    'accepted' => 'bg-success text-white',
                                    'completed' => 'bg-primary text-white',
                                    'rejected' => 'bg-danger text-white',
                                    default => 'bg-secondary text-white'
                                };
                            @endphp
                            <button class="btn btn-sm badge {{ $badgeClass }} px-4 py-2 rounded-pill dropdown-toggle border-0 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 0.8rem; font-weight: 600; letter-spacing: 0.5px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                {{ ucfirst($order->status) }}
                            </button>
                            <ul class="dropdown-menu shadow-lg border-0" style="min-width: 180px;">
                                <li>
                                    <form action="{{ route('admin.custom_orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="dropdown-item {{ $order->status == 'pending' ? 'active' : '' }}">
                                            <i class="bi bi-circle-fill text-warning me-2" style="font-size: 0.5rem; vertical-align: middle;"></i> Pending
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('admin.custom_orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="reviewed">
                                        <button type="submit" class="dropdown-item {{ $order->status == 'reviewed' ? 'active' : '' }}">
                                            <i class="bi bi-circle-fill text-info me-2" style="font-size: 0.5rem; vertical-align: middle;"></i> Reviewed
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('admin.custom_orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="dropdown-item {{ $order->status == 'accepted' ? 'active' : '' }}">
                                            <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.5rem; vertical-align: middle;"></i> Accepted
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('admin.custom_orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="dropdown-item {{ $order->status == 'completed' ? 'active' : '' }}">
                                            <i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem; vertical-align: middle;"></i> Completed
                                        </button>
                                    </form>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <form action="{{ route('admin.custom_orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="dropdown-item text-danger {{ $order->status == 'rejected' ? 'active bg-danger text-white' : '' }}">
                                            <i class="bi bi-circle-fill {{ $order->status == 'rejected' ? 'text-white' : 'text-danger' }} me-2" style="font-size: 0.5rem; vertical-align: middle;"></i> Rejected
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td class="border-bottom">
                        <div class="text-dark fw-medium">{{ $order->created_at->format('M d, Y') }}</div>
                        <div class="text-muted small">{{ $order->created_at->format('h:i A') }}</div>
                    </td>
                    <td class="pe-4 text-end border-bottom" onclick="event.stopPropagation();">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.custom_orders.show', $order->id) }}" class="btn btn-sm btn-light border rounded-circle d-inline-flex align-items-center justify-content-center text-primary" style="width: 36px; height: 36px; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#e9ecef'; this.style.transform='scale(1.1)';" onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';" title="View Details">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('admin.custom_orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this custom inquiry? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border rounded-circle d-inline-flex align-items-center justify-content-center text-danger" style="width: 36px; height: 36px; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#fee2e2'; this.style.transform='scale(1.1)';" onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';" title="Delete Inquiry">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-gem text-muted" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="fw-bold text-dark">No Custom Orders</h5>
                            <p class="small text-muted mb-0">No customized jewelry requests have been submitted yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">
    {{ $customOrders->links() }}
</div>
@endsection
