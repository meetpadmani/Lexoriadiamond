@extends('admin.layout')

@section('title', 'Personal Profile')

@section('content')
<div class="container-fluid animate-fade-in">
    <div class="page-title-box mb-4">
        <div>
            <h4>Personal Profile</h4>
            <div class="breadcrumb-text">Admin / Manage your account security and identity</div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Identity Section -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-person-circle me-2 text-gold"></i>Admin Identity</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase">Full Name</label>
                            <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name', $user->name) }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase">Email Address</label>
                            <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email', $user->email) }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-0">
                            <button type="submit" class="btn btn btn-primary px-4">
                                <i class="bi bi-check2-circle me-2"></i> Update Identity
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Section -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-shield-lock me-2 text-danger"></i>Security Credentials</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required placeholder="••••••••">
                            @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase">New Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="••••••••">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••••">
                        </div>
                        <div class="mb-0">
                            <button type="submit" class="btn btn-dark px-4 rounded-pill fw-bold">
                                <i class="bi bi-key me-2"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Session Info -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-info-circle text-primary fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Session Intelligence</h6>
                            <p class="text-muted small mb-0">Your account was created on <strong>{{ $user->created_at->format('M d, Y') }}</strong>. Current session initiated from <strong>{{ request()->ip() }}</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
