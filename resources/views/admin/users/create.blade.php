@extends('admin.layout')

@section('title', 'Add New Team Member')

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

    /* Custom Input Group */
    .premium-input-group {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9ecef;
        background: #fcfdfd;
        transition: all 0.2s ease;
        display: flex;
    }
    .premium-input-group:focus-within {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        background: #fff;
    }
    .premium-input-group .form-control, .premium-input-group .form-select {
        border: none;
        background: transparent;
        padding: 0.75rem 1rem;
    }
    .premium-input-group .form-control:focus, .premium-input-group .form-select:focus {
        box-shadow: none;
        outline: none;
    }
    .premium-input-group .input-group-text {
        border: none;
        background: transparent;
        padding-left: 1.25rem;
        color: #adb5bd;
    }
    
    .form-label-premium {
        font-size: 0.85rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
    }

    /* Custom Dropdown UI */
    .custom-select-dropdown {
        position: absolute;
        top: calc(100% + 5px);
        left: 0;
        right: 0;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s ease;
        padding: 8px;
    }
    .custom-select-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .dropdown-item-premium {
        padding: 10px 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        color: #495057;
        font-weight: 500;
    }
    .dropdown-item-premium:hover {
        background: #f8f9fa;
        color: #0d6efd;
    }
    .dropdown-item-premium.selected {
        background: #e7f1ff;
        color: #0d6efd;
    }
    .dropdown-item-premium .check-icon {
        opacity: 0;
        transition: opacity 0.2s;
    }
    .dropdown-item-premium.selected .check-icon {
        opacity: 1;
    }
    .cursor-pointer {
        cursor: pointer;
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
                <h3 class="mb-1 fw-bold text-dark letter-spacing-tight">Add New User</h3>
                <p class="text-secondary small mb-0">Create a new administrative, staff, or patron account.</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center animate-fade-in" style="animation-delay: 0.1s;">
        <div class="col-lg-8">
            <div class="card premium-card border-0 overflow-hidden">
                <div class="card-header bg-white py-4 border-bottom px-4 d-flex align-items-center gap-3">
                    <div class="bg-primary-subtle text-primary p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-person-plus-fill fs-5"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">User Details</h5>
                        <div class="small text-muted">Fill in the required credentials below.</div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label-premium">Full Name</label>
                                <div class="premium-input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Rajesh Kumar" required value="{{ old('name') }}">
                                </div>
                                @error('name') <div class="small text-danger mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label-premium">Email Address</label>
                                <div class="premium-input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="email@example.com" required value="{{ old('email') }}">
                                </div>
                                @error('email') <div class="small text-danger mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-premium">Phone Number</label>
                                <div class="premium-input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="phone" class="form-control" placeholder="+91 98765 43210" value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-premium">Designated Role</label>
                                <div class="custom-select-container position-relative">
                                    <div class="premium-input-group cursor-pointer" id="roleSelectTrigger" onclick="toggleDropdown()">
                                        <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                                        <div class="form-control d-flex align-items-center justify-content-between" style="background: transparent;">
                                            <span id="roleSelectLabel">Patron (User)</span>
                                            <i class="bi bi-chevron-expand text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="custom-select-dropdown shadow-lg" id="roleDropdown">
                                        <div class="dropdown-item-premium selected" onclick="selectRole('user', 'Patron (User)')">
                                            <i class="bi bi-person me-2"></i> Patron (User)
                                            <i class="bi bi-check2 ms-auto check-icon"></i>
                                        </div>
                                        <div class="dropdown-item-premium" onclick="selectRole('staff', 'Staff Member')">
                                            <i class="bi bi-person-badge me-2"></i> Staff Member
                                            <i class="bi bi-check2 ms-auto check-icon"></i>
                                        </div>
                                        <div class="dropdown-item-premium" onclick="selectRole('manager', 'Store Manager')">
                                            <i class="bi bi-briefcase me-2"></i> Store Manager
                                            <i class="bi bi-check2 ms-auto check-icon"></i>
                                        </div>
                                        <div class="dropdown-item-premium" onclick="selectRole('delivery_admin', 'Delivery Admin')">
                                            <i class="bi bi-truck me-2"></i> Delivery Admin
                                            <i class="bi bi-check2 ms-auto check-icon"></i>
                                        </div>
                                        <div class="dropdown-item-premium" onclick="selectRole('super_admin', 'Super Admin')">
                                            <i class="bi bi-shield-lock me-2"></i> Super Admin
                                            <i class="bi bi-check2 ms-auto check-icon"></i>
                                        </div>
                                    </div>
                                    <input type="hidden" name="role" id="roleInput" value="user" required>
                                </div>
                                @error('role') <div class="small text-danger mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-premium">Password</label>
                                <div class="premium-input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" required placeholder="Minimum 8 characters">
                                </div>
                                @error('password') <div class="small text-danger mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-premium">Confirm Password</label>
                                <div class="premium-input-group">
                                    <span class="input-group-text"><i class="bi bi-check2-circle"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Repeat password">
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4 py-2 rounded-pill fw-bold border shadow-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-premium px-5 py-2 rounded-pill fw-bold d-flex align-items-center gap-2">
                                <i class="bi bi-check-lg"></i> Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('roleDropdown');
        dropdown.classList.toggle('show');
    }

    function selectRole(value, label) {
        // Update input
        document.getElementById('roleInput').value = value;
        // Update display label
        document.getElementById('roleSelectLabel').textContent = label;
        
        // Update styling
        document.querySelectorAll('.dropdown-item-premium').forEach(el => {
            el.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        
        // Close dropdown
        toggleDropdown();
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const container = document.querySelector('.custom-select-container');
        if (container && !container.contains(event.target)) {
            document.getElementById('roleDropdown').classList.remove('show');
        }
    });
</script>
@endsection
