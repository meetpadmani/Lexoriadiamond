@extends('admin.layout')

@section('title', 'Edit Coupon')

@section('styles')
<style>
    .premium-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }
    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #e9ecef;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        color: #fff;
        padding: 12px 30px;
        border-radius: 30px;
        transition: all 0.3s ease;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-light rounded-circle shadow-sm border" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div>
            <h3 class="mb-1 fw-bold text-dark">Edit Coupon</h3>
            <p class="text-secondary small mb-0">Modify details for <span class="fw-bold">{{ $coupon->code }}</span>.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card premium-card border-0 p-4 p-md-5">
            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark small text-uppercase">Coupon Code</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
                        @error('code')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark small text-uppercase">Discount Type</label>
                        <select name="type" class="form-select" required>
                            <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                            <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                        </select>
                        @error('type')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark small text-uppercase">Discount Value</label>
                        <input type="number" step="0.01" name="value" class="form-control" value="{{ old('value', $coupon->value) }}" required>
                        @error('value')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark small text-uppercase">Minimum Purchase Amount ($)</label>
                        <input type="number" step="0.01" name="min_purchase_amount" class="form-control" value="{{ old('min_purchase_amount', $coupon->min_purchase_amount) }}" required>
                        @error('min_purchase_amount')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark small text-uppercase">Usage Limit</label>
                        <input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit', $coupon->usage_limit) }}" max="2147483647" placeholder="Leave blank for unlimited">
                        @error('usage_limit')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark small text-uppercase">Expiry Date</label>
                        <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date', $coupon->expiry_date ? $coupon->expiry_date->format('Y-m-d') : '') }}">
                        @error('expiry_date')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="p-4 bg-primary-subtle rounded-4 border border-primary-subtle">
                            <div class="form-check form-switch mb-3 d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="is_one_time" value="1" id="is_one_time" style="width: 40px; height: 20px;" {{ old('is_one_time', $coupon->is_one_time) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold text-dark" for="is_one_time">One-Time Use Per User</label>
                            </div>
                            <p class="small text-secondary mb-0 ms-5">If checked, a registered user can only use this coupon code exactly once across all their orders.</p>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 text-end">
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-light fw-bold px-4 py-2 rounded-pill me-2">Cancel</a>
                        <button type="submit" class="btn btn-premium fw-bold px-5">Update Coupon</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
