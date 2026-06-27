@extends('admin.layout')

@section('title', 'WhatsApp Engagement')

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

    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }

    .whatsapp-icon-bg {
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
    }

    .btn-whatsapp {
        background: #25D366;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-whatsapp:hover {
        background: #128C7E;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(37, 211, 102, 0.3);
    }
</style>
@endsection

@section('content')

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in-up">
        <div>
            <h4 class="dashboard-header-title mb-1">WhatsApp Engagement</h4>
            <p class="text-muted small mb-0">Connect with your customers directly via WhatsApp for support and marketing.</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <span class="badge bg-success bg-opacity-10 text-success fs-6 px-3 py-2 rounded-2 fw-bold border border-success border-opacity-25">
                <i class="bi bi-chat-dots me-1"></i> Active Integration
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-3 fade-in-up" style="animation-delay: 0.2s;">
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-send me-2 text-success"></i> Send Broadcast Message</h5>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.engagement.whatsapp.broadcast') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Select Audience</label>
                        <select class="form-select" name="audience">
                            <option value="all">All Customers</option>
                            <option value="abandoned_cart">Abandoned Cart Users</option>
                            <option value="newsletter">Newsletter Subscribers</option>
                            <option value="recent_buyers">Recent Buyers</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Message Template</label>
                        <select class="form-select" name="template">
                            <option value="custom">Custom Message</option>
                            <option value="discount">Special Discount Offer</option>
                            <option value="new_arrival">New Arrival Alert</option>
                            <option value="abandoned">Cart Recovery Reminder</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Message Content</label>
                        <textarea class="form-control" name="message" rows="5" placeholder="Type your WhatsApp message here..."></textarea>
                        <div class="form-text mt-2">You can use variables like {name}, {order_id}, etc.</div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2 mt-2">
                        <i class="bi bi-send-fill me-2"></i> Send Broadcast
                    </button>
                </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card mb-3 text-center">
                <div class="card-header">
                    <h5 id="qr-panel-title" class="mb-0"><i class="bi bi-qr-code-scan me-2 text-secondary" id="qr-panel-icon"></i> <span id="qr-panel-text">Link WhatsApp</span></h5>
                </div>
                <div class="card-body">
                <div id="qr-container" class="mb-3 d-flex justify-content-center align-items-center" style="min-height: 200px; background: #f8f9fa; border-radius: 12px;">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <p id="qr-status" class="text-secondary small fw-semibold">Checking connection...</p>
                <button onclick="fetchQr()" class="btn btn-outline-dark btn-sm rounded-3 mt-2"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-bar-chart me-2 text-primary"></i> Engagement Stats</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 p-2 bg-light rounded border">
                        <span class="text-secondary fw-semibold">Messages Sent</span>
                        <span class="fw-bold fs-5 text-success" id="stats-sent">0</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3 p-2 bg-light rounded border">
                        <span class="text-secondary fw-semibold">Messages Failed</span>
                        <span class="fw-bold fs-5 text-danger" id="stats-failed">0</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded border">
                        <span class="text-secondary fw-semibold">Service Uptime</span>
                        <span class="fw-bold fs-6 text-primary" id="stats-uptime">100%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    let pollInterval = null;

    function checkStatusSilently() {
        fetch('{{ route('admin.engagement.whatsapp.status') }}')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'READY' || data.status === 'AUTHENTICATED') {
                    const qrContainer = document.getElementById('qr-container');
                    const qrStatus = document.getElementById('qr-status');
                    qrContainer.innerHTML = '<i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>';
                    qrStatus.innerHTML = '<span class="text-success fw-bold">WhatsApp is Connected!</span>';
                    document.getElementById('qr-panel-text').innerText = 'WhatsApp Status';
                    document.getElementById('qr-panel-icon').className = 'bi bi-whatsapp me-2 text-success';
                    if (pollInterval) {
                        clearInterval(pollInterval);
                        pollInterval = null;
                    }
                    if (data.stats) {
                        document.getElementById('stats-sent').innerText = data.stats.sent || 0;
                        document.getElementById('stats-failed').innerText = data.stats.failed || 0;
                    }
                } else if (data.status === 'QR_READY') {
                    // Update QR code to prevent expiration
                    fetch('{{ route('admin.engagement.whatsapp.qr') }}')
                        .then(res => res.json())
                        .then(qrData => {
                            if (qrData.success && qrData.qr) {
                                document.getElementById('qr-container').innerHTML = `<img src="${qrData.qr}" alt="WhatsApp QR Code" style="width: 200px; height: 200px; border-radius: 8px;">`;
                            }
                        });
                }
            })
            .catch(err => console.error('Silent status check failed', err));
    }

    function fetchQr() {
        const qrContainer = document.getElementById('qr-container');
        const qrStatus = document.getElementById('qr-status');
        
        qrContainer.innerHTML = '<div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div>';
        qrStatus.innerText = 'Loading...';

        fetch('{{ route('admin.engagement.whatsapp.status') }}')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'READY' || data.status === 'AUTHENTICATED') {
                    qrContainer.innerHTML = '<i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>';
                    qrStatus.innerHTML = '<span class="text-success fw-bold">WhatsApp is Connected!</span>';
                    document.getElementById('qr-panel-text').innerText = 'WhatsApp Status';
                    document.getElementById('qr-panel-icon').className = 'bi bi-whatsapp me-2 text-success';
                    if (pollInterval) {
                        clearInterval(pollInterval);
                        pollInterval = null;
                    }
                    if (data.stats) {
                        document.getElementById('stats-sent').innerText = data.stats.sent || 0;
                        document.getElementById('stats-failed').innerText = data.stats.failed || 0;
                    }
                } else if (data.status === 'OFFLINE') {
                    qrContainer.innerHTML = '<div class="spinner-border text-warning" role="status"></div>';
                    qrStatus.innerHTML = '<span class="text-warning fw-bold">Starting Node.js Service...</span>';
                    
                    // Keep polling to wait for the auto-started service
                    if (!pollInterval) {
                        pollInterval = setInterval(checkStatusSilently, 3000);
                    }
                } else {
                    fetch('{{ route('admin.engagement.whatsapp.qr') }}')
                        .then(res => res.json())
                        .then(qrData => {
                            if (qrData.success && qrData.qr) {
                                qrContainer.innerHTML = `<img src="${qrData.qr}" alt="WhatsApp QR Code" style="width: 200px; height: 200px; border-radius: 8px;">`;
                                qrStatus.innerText = 'Scan this QR code with your WhatsApp app to link.';
                                
                                // Start polling to detect when it gets scanned
                                if (!pollInterval) {
                                    pollInterval = setInterval(checkStatusSilently, 3000);
                                }
                            } else {
                                qrContainer.innerHTML = '<i class="bi bi-arrow-clockwise text-muted" style="font-size: 3rem;"></i>';
                                qrStatus.innerText = 'QR not ready yet, please wait...';
                                
                                // Keep polling while QR is initializing
                                if (!pollInterval) {
                                    pollInterval = setInterval(checkStatusSilently, 3000);
                                }
                            }
                        })
                        .catch(err => {
                            qrContainer.innerHTML = '<i class="bi bi-exclamation-triangle text-warning" style="font-size: 3rem;"></i>';
                            qrStatus.innerText = 'Error fetching QR Code.';
                        });
                }
            })
            .catch(err => {
                qrContainer.innerHTML = '<div class="spinner-border text-warning" role="status"></div>';
                qrStatus.innerHTML = '<span class="text-warning fw-bold">Starting Node.js Service...</span>';
                if (!pollInterval) {
                    pollInterval = setInterval(checkStatusSilently, 3000);
                }
            });
    }

    document.addEventListener('DOMContentLoaded', fetchQr);
</script>
@endsection
