@extends('admin.layout')

@section('title', 'Payment Gateway Settings')

@section('styles')
<style>
    /* Premium Page Header */
    .premium-page-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.02);
        margin-bottom: 2rem;
        border: 1px solid rgba(0,0,0,0.03);
    }

    /* Premium Panels */
    .premium-panel {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        padding: 2.5rem;
        margin-bottom: 2rem;
    }
    .panel-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8f9fa;
    }
    .panel-icon {
        width: 40px; height: 40px;
        border-radius: 12px;
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }
    .panel-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    /* Form Elements */
    .form-control-studio {
        display: block;
        width: 100%;
        border-radius: 12px;
        padding: 14px 20px;
        border: 2px solid #f1f3f5;
        background-color: #f8f9fa;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        color: #495057;
    }
    .form-control-studio:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        outline: none;
    }
    .form-label-studio {
        font-weight: 800;
        color: #495057;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.75rem;
        display: block;
    }

    /* Input Group Custom */
    .input-group-password {
        position: relative;
        display: block;
        width: 100%;
    }
    .input-group-password .form-control-studio {
        padding-right: 50px;
    }
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 0;
    }

    /* Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        color: #fff;
        padding: 16px 36px;
        border-radius: 30px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        width: 100%;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
        color: #fff;
    }

    /* Partner Badge */
    .partner-badge {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        background: #f8f9fa;
        padding: 15px 25px;
        border-radius: 20px;
        border: 1px solid #f1f3f5;
        margin-bottom: 2rem;
    }
    .partner-badge img {
        height: 25px;
    }

    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }

    /* Payment Tabs Customization */
    .payment-tabs {
        border-bottom: 2px solid #f1f3f5;
        margin-bottom: 2.5rem;
        padding-bottom: 0.5rem;
        gap: 1rem;
    }
    .payment-tabs .nav-link {
        border: none;
        background: transparent;
        color: #6c757d;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 12px 24px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .payment-tabs .nav-link:hover {
        background: #f8f9fa;
        color: #212529;
    }
    .payment-tabs .nav-link.active {
        background: #212529;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .payment-tabs .nav-link.active img {
        filter: brightness(0) invert(1);
    }
</style>
@endsection

@section('content')

    <!-- Premium Page Header -->
    <div class="premium-page-header fade-in-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-dark text-white p-4 rounded-4 d-flex align-items-center justify-content-center shadow-lg">
                    <i class="bi bi-safe2-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Payment Gateway Settings</h2>
                    <p class="text-secondary mb-0 fs-6">Manage secure transaction credentials for your storefront.</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 px-4 py-2 bg-success bg-opacity-10 rounded-pill">
                <div class="bg-success rounded-circle animate-pulse" style="width: 8px; height: 8px;"></div>
                <span class="small fw-bold letter-spacing-1 text-success text-uppercase">Gateway Connected</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.payment-settings.update') }}" method="POST">
        @csrf
        
        <div class="premium-panel fade-in-up" style="animation-delay: 0.2s; padding: 3rem;">
            <!-- Simple Top Tabs -->
            <ul class="nav nav-tabs payment-tabs border-bottom-0" id="paymentTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active d-flex align-items-center gap-2" id="razorpay-tab" data-bs-toggle="tab" data-bs-target="#razorpay-content" type="button" role="tab" aria-controls="razorpay-content" aria-selected="true">
                        <img src="https://razorpay.com/assets/razorpay-glyph.svg" style="width: 16px; height: 16px; margin-top: 1px;" alt="Razorpay">
                        Razorpay Gateway
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center gap-2" id="payoneer-tab" data-bs-toggle="tab" data-bs-target="#payoneer-content" type="button" role="tab" aria-controls="payoneer-content" aria-selected="false">
                        <div style="width: 18px; height: 18px; border-radius: 50%; background: conic-gradient(from 180deg, #e6007e, #ff0000, #ff7b00, #ffd000, #00e676, #00bfff, #2962ff, #8e24aa, #e6007e); padding: 2.5px; display: flex;">
                            <div style="background: #ffffff; width: 100%; height: 100%; border-radius: 50%;"></div>
                        </div>
                        Payoneer Global
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-3 mb-5" id="payment-settings-tabContent">
                
                <!-- Razorpay Tab Content -->
                <div class="tab-pane fade show active" id="razorpay-content" role="tabpanel" aria-labelledby="razorpay-tab">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 12px;">
                            <img src="https://razorpay.com/assets/razorpay-glyph.svg" style="width: 24px; height: 24px; margin-top: 2px;" alt="Razorpay">
                        </div>
                        <div>
                            <h4 class="fw-bolder mb-0 text-dark" style="font-family: 'Playfair Display', serif;">Razorpay Configuration</h4>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 mt-1"><i class="bi bi-star-fill me-1"></i> Premium Partner</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-studio">Public Access Key (Key ID)</label>
                        <input type="text" name="razorpay_key" class="form-control-studio fw-bold text-primary" 
                               value="{{ old('razorpay_key', $settings->razorpay_key) }}" 
                               placeholder="rzp_test_..." required>
                        <div class="form-text mt-2 text-muted small">
                            <i class="bi bi-info-circle-fill me-1 text-warning"></i> Your unique identifier for the Razorpay API network.
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label-studio">Private Cipher (Key Secret)</label>
                        <div class="input-group-password">
                            <input type="password" name="razorpay_secret" id="razorpay_secret" class="form-control-studio fw-bold" 
                                   value="{{ old('razorpay_secret', $settings->razorpay_secret) }}" 
                                   placeholder="••••••••••••••••" required>
                            <button type="button" class="password-toggle fs-5" onclick="toggleSecret('razorpay_secret', 'toggleIcon')">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        <div class="form-text mt-2 text-muted small">
                            <i class="bi bi-shield-lock-fill me-1 text-danger"></i> This secret remains encrypted within your secure servers.
                        </div>
                    </div>
                </div>

                <!-- Payoneer Tab Content -->
                <div class="tab-pane fade" id="payoneer-content" role="tabpanel" aria-labelledby="payoneer-tab">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-white border d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 12px;">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: conic-gradient(from 180deg, #e6007e, #ff0000, #ff7b00, #ffd000, #00e676, #00bfff, #2962ff, #8e24aa, #e6007e); padding: 5px; display: flex;">
                                <div style="background: #ffffff; width: 100%; height: 100%; border-radius: 50%;"></div>
                            </div>
                        </div>
                        <div>
                            <h4 class="fw-bolder mb-0 text-dark" style="font-family: 'Playfair Display', serif;">Payoneer Configuration</h4>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 mt-1"><i class="bi bi-globe me-1"></i> International Payouts</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-studio">Payoneer Client ID</label>
                        <input type="text" name="payoneer_client_id" class="form-control-studio fw-bold text-primary" 
                               value="{{ old('payoneer_client_id', $settings->payoneer_client_id) }}" 
                               placeholder="Enter Payoneer Client ID">
                        <div class="form-text mt-2 text-muted small">
                            <i class="bi bi-info-circle-fill me-1 text-warning"></i> Used for international B2B payouts and cross-border transactions.
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label-studio">Payoneer Client Secret</label>
                        <div class="input-group-password">
                            <input type="password" name="payoneer_client_secret" id="payoneer_client_secret" class="form-control-studio fw-bold" 
                                   value="{{ old('payoneer_client_secret', $settings->payoneer_client_secret) }}" 
                                   placeholder="••••••••••••••••">
                            <button type="button" class="password-toggle fs-5" onclick="toggleSecret('payoneer_client_secret', 'togglePayoneerIcon')">
                                <i class="bi bi-eye" id="togglePayoneerIcon"></i>
                            </button>
                        </div>
                        <div class="form-text mt-2 text-muted small">
                            <i class="bi bi-shield-lock-fill me-1 text-danger"></i> Ensure your international transaction secrets are secure.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Global Save Action -->
            <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-fill-check fs-4 text-success"></i>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Authenticity Guaranteed</h6>
                        <div class="text-secondary small">Changes take effect immediately securely via 256-bit encryption.</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-premium px-5 py-2 w-auto">
                    <i class="bi bi-cloud-arrow-up me-2"></i> Save Configuration
                </button>
            </div>
        </div>

    </form>

@endsection

@section('scripts')
<script>
    function toggleSecret(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = "password";
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endsection
