@extends('admin.layout')

@section('title', 'User Management')

@section('styles')
<style>
    /* Premium Button Glow */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        transition: all 0.3s ease;
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

    /* Premium Avatar */
    .avatar-premium {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.15) 100%);
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.05);
        border: 1px solid rgba(13, 110, 253, 0.1);
        text-transform: uppercase;
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
    .premium-input-group .form-control, .premium-input-group .input-group-text {
        border: none;
        background: transparent;
    }
    .premium-input-group .form-control:focus {
        box-shadow: none;
    }
</style>
@endsection

@section('content')

    <!-- Header Section -->
    <div class="mb-5 d-flex justify-content-between align-items-center animate-fade-in">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                <i class="bi bi-people text-primary fs-4"></i>
            </div>
            <div>
                <h3 class="mb-1 fw-bold text-dark letter-spacing-tight">User Management</h3>
                <p class="text-secondary small mb-0">Manage your entire customer base from one place.</p>
            </div>
        </div>
        <div class="d-flex gap-3">
            <div class="bg-white border px-4 py-2 rounded-4 shadow-sm d-flex align-items-center gap-3">
                <div class="bg-primary-subtle rounded-circle p-2 text-primary" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div>
                    <div class="small text-muted" style="font-size: 0.7rem;">Total Users</div>
                    <div class="fw-bold">{{ $users->total() }}</div>
                </div>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-premium d-flex align-items-center gap-2 py-2 px-4 rounded-pill shadow-sm">
                <i class="bi bi-person-plus-fill"></i>
                <span>Add New User</span>
            </a>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="card premium-card overflow-hidden border-0 mb-5 animate-fade-in" style="animation-delay: 0.2s;">
        <div class="card-header bg-white py-4 px-4 border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold" style="font-size: 1.1rem;"><i class="bi bi-list-ul text-primary me-2"></i>User Directory</h5>
            <div class="search-box">
                <div class="premium-input-group d-flex align-items-center px-2 bg-light" style="width: 300px;">
                    <i class="bi bi-search text-primary ms-2"></i>
                    <input type="text" class="form-control py-2 bg-light shadow-none" placeholder="Search by name or email..." style="font-size: 0.85rem;">
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-premium align-middle mb-0">
                <thead class="bg-white">
                    <tr>
                        <th class="ps-4" width="300">User Details</th>
                        <th>Contact Info</th>
                        <th>Engagement</th>
                        <th>Joined Date</th>
                        <th class="pe-4 text-end" width="100">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($users as $user)
                    <tr class="user-row" style="cursor: pointer;" onclick="window.location='{{ route('admin.users.show', $user->id) }}';">
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-premium">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark d-flex align-items-center gap-2">
                                        {{ $user->name }}
                                        @if($user->is_admin)
                                            <span class="badge bg-danger-subtle text-danger" style="font-size: 0.65rem; padding: 0.3em 0.6em; border-radius: 8px;">ADMIN</span>
                                        @endif
                                    </div>
                                    <div class="text-secondary mt-1" style="font-size: 0.8rem;">
                                        <i class="bi bi-envelope-at me-1"></i> {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-dark small fw-500 mb-1">
                                <i class="bi bi-telephone-fill text-muted me-2" style="font-size: 0.8rem;"></i>
                                {{ $user->phone ?? 'Not Provided' }}
                            </div>
                            <div class="text-secondary small">
                                <i class="bi bi-geo-alt-fill text-muted me-2" style="font-size: 0.8rem;"></i>
                                {{ $user->address ?? 'Location Unknown' }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div class="bg-primary-subtle text-primary rounded px-2 py-1 small fw-bold">
                                    {{ $user->orders_count ?? 0 }}
                                </div>
                                <span class="small fw-600 text-dark">Orders</span>
                            </div>
                            <div class="small text-success fw-bold d-flex align-items-center mt-1">
                                <i class="bi bi-coin me-1"></i>
                                {{ number_format(($user->orders_sum_total_amount ?? 0) * 0.10) }} Credits
                            </div>
                        </td>
                        <td>
                            <div class="fw-600 text-dark small mb-1">{{ $user->created_at->format('d M, Y') }}</div>
                            <div class="text-secondary" style="font-size: 0.75rem;">{{ $user->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="pe-4 text-end" onclick="event.stopPropagation();">
                            <div class="dropdown">
                                <button class="btn btn-light rounded-circle border p-2 text-secondary d-inline-flex align-items-center justify-content-center" data-bs-toggle="dropdown" style="width: 36px; height: 36px; transition: all 0.2s;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 p-2" style="border-radius: 12px; min-width: 180px;">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-3" href="{{ route('admin.users.show', $user->id) }}">
                                            <i class="bi bi-eye text-primary"></i> View Profile
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-3 {{ $user->status === 'active' ? 'text-danger' : 'text-success' }}">
                                                <i class="bi bi-{{ $user->status === 'active' ? 'slash-circle' : 'check-circle' }}"></i> 
                                                {{ $user->status === 'active' ? 'Block User' : 'Unblock User' }}
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.users.resetPassword', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-3 text-warning">
                                                <i class="bi bi-shield-lock"></i> Reset Password
                                            </button>
                                        </form>
                                    </li>
                                    @if(!$user->is_admin)
                                    <li><hr class="dropdown-divider opacity-50"></li>
                                    <li>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-3 text-danger">
                                                <i class="bi bi-trash"></i> Remove User
                                            </button>
                                        </form>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted d-flex flex-column align-items-center">
                                <i class="bi bi-people mb-3" style="font-size: 3rem; opacity: 0.5;"></i>
                                <h5 class="fw-bold text-dark">No Users Found</h5>
                                <p class="small mb-0">It seems you don't have any users yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="card-footer bg-white py-4 px-4 border-0 border-top">
            {{ $users->links() }}
        </div>
        @endif
    </div>

@endsection
