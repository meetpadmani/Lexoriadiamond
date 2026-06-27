@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Logistics & Delivery</span>
    <h1>Track Your Treasure</h1>
    <div class="rajwadi-motif">
        <svg width="40" height="40" viewBox="0 0 100 100" fill="none">
            <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/>
            <circle cx="50" cy="50" r="15" stroke="#0F1F17" stroke-width="2"/>
        </svg>
    </div>
    <p>Monitor the journey of your royal acquisition or verify delivery availability to your location.</p>
</section>

<div class="page-content">
    <div class="tracking-split-grid">
        <!-- Section 1: Order Tracking -->
        <div class="tracking-card-premium">
            <div class="tc-header">
                <i class="bi bi-truck"></i>
                <h2>Track Shipment</h2>
            </div>
            <p>Enter your Order ID to see the current status and estimated delivery time of your mandate.</p>

            <div class="contact-form">
                <div class="form-group">
                    <label>Order Reference ID</label>
                    <div class="input-with-icon">
                        <i class="bi bi-hash"></i>
                        <input type="text" id="orderNumberInput" class="form-control" placeholder="e.g. BD-27CD984B">
                    </div>
                </div>
                <div class="form-group">
                    <label>Registered Mobile</label>
                    <div class="input-with-icon">
                        <i class="bi bi-phone"></i>
                        <input type="text" id="mobileInput" class="form-control" placeholder="10-digit mobile">
                    </div>
                </div>
                <button onclick="handleTrack()" class="btn-submit" style="width: 100%;">Track My Mandate</button>
            </div>
        </div>

        <!-- Section 2: Pincode Check -->
        <div class="tracking-card-premium">
            <div class="tc-header">
                <i class="bi bi-geo-alt"></i>
                <h2>Check Delivery</h2>
            </div>
            <p>Check if our royal couriers currently serve your region for insured transport.</p>

            <div class="contact-form">
                <div class="form-group">
                    <label>Enter Delivery Pincode</label>
                    <div class="input-with-icon">
                        <i class="bi bi-pin-map"></i>
                        <input type="text" id="standalonePincode" class="form-control" placeholder="6-digit pincode" maxlength="6">
                    </div>
                </div>
                <button onclick="checkStandaloneDelivery()" class="btn-submit" style="width: 100%; background: var(--brand-dark); color: var(--brand-gold);">Verify Location</button>
                <div id="standaloneResult" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>

    <!-- Delivery Process Timeline -->
    <div class="delivery-process-container">
        <h2 style="text-align: center; margin-bottom: 50px; font-family: 'Inter', serif;">Our Insured Journey</h2>
        <div class="logistics-timeline">
            <div class="timeline-step">
                <div class="step-icon active"><i class="bi bi-card-checklist"></i></div>
                <div class="step-label">Confirmation</div>
                <div class="step-desc">Order verification & atelier assignment.</div>
            </div>
            <div class="timeline-bar"></div>
            <div class="timeline-step">
                <div class="step-icon"><i class="bi bi-gem"></i></div>
                <div class="step-label">Atelier</div>
                <div class="step-desc">Finishing & Master Quality Control.</div>
            </div>
            <div class="timeline-bar"></div>
            <div class="timeline-step">
                <div class="step-icon"><i class="bi bi-shield-check"></i></div>
                <div class="step-label">Insured</div>
                <div class="step-desc">Tamper-proof packaging & insurance.</div>
            </div>
            <div class="timeline-bar"></div>
            <div class="timeline-step">
                <div class="step-icon"><i class="bi bi-truck"></i></div>
                <div class="step-label">In Transit</div>
                <div class="step-desc">Expedited courier dispatch.</div>
            </div>
            <div class="timeline-bar"></div>
            <div class="timeline-step">
                <div class="step-icon"><i class="bi bi-house-heart"></i></div>
                <div class="step-label">Delivered</div>
                <div class="step-desc">Arrived at your royal residence.</div>
            </div>
        </div>
    </div>
</div>

<style>
    .tracking-split-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 80px;
    }

    .tracking-card-premium {
        background: #fff;
        padding: 40px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .tc-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        color: #000000;
    }

    .tc-header i { font-size: 2rem; color: #333333; }
    .tc-header h2 { margin: 0; font-family: 'Inter', serif; font-size: 1.6rem; }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #333333;
    }

    .input-with-icon input {
        padding-left: 45px !important;
    }

    /* Timeline Styles */
    .delivery-process-container {
        background: #fdfaf7;
        padding: 60px 40px;
        border-radius: 20px;
        border: 1px dashed rgba(0, 0, 0, 0.4);
    }

    .logistics-timeline {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        position: relative;
    }

    .timeline-step {
        flex: 1;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 2;
    }

    .step-icon {
        width: 60px;
        height: 60px;
        background: #fff;
        border: 2px solid #ddd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #aaa;
        margin-bottom: 15px;
        transition: all 0.4s ease;
    }

    .step-icon.active {
        border-color: #333333;
        color: #333333;
        background: #fdfaf7;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .step-label {
        font-family: 'Inter', serif;
        font-weight: 700;
        font-size: 0.8rem;
        color: #0F1F17;
        margin-bottom: 8px;
    }

    .step-desc {
        font-size: 0.75rem;
        color: #888;
        max-width: 140px;
        line-height: 1.4;
    }

    .timeline-bar {
        flex: 1;
        height: 2px;
        background: #ddd;
        margin-top: 30px;
    }

    @media (max-width: 992px) {
        .tracking-split-grid { grid-template-columns: 1fr; }
        .logistics-timeline { flex-direction: column; gap: 40px; align-items: center; }
        .timeline-bar { width: 2px; height: 40px; margin-top: 0; margin-left: 0; }
        .timeline-step { flex: none; }
        .step-desc { max-width: none; }
    }
</style>

<script>
    function handleTrack() {
        const orderNo = document.getElementById('orderNumberInput').value.trim();
        const mobile = document.getElementById('mobileInput').value.trim();
        
        if (!orderNo) {
            Swal.fire('Requirement', 'Please enter your Order Reference ID', 'warning');
            return;
        }
        
        // In a real system, we would verify the mobile number match via AJAX first
        window.location.href = "{{ url('/order-tracking') }}/" + orderNo;
    }

    function checkStandaloneDelivery() {
        const pincode = document.getElementById('standalonePincode').value;
        const resultDiv = document.getElementById('standaloneResult');
        
        if (!pincode || pincode.length !== 6) {
            resultDiv.innerHTML = '<div style="background: #ffebee; color: #c62828; padding: 15px; border-radius: 8px; border-left: 4px solid #c62828;">Please enter a valid 6-digit pincode.</div>';
            return;
        }

        resultDiv.innerHTML = '<div style="color: #333333;"><i class="bi bi-hourglass-split"></i> Verifying logistics routes...</div>';

        setTimeout(() => {
            if (pincode.startsWith('38') || pincode.startsWith('36')) {
                resultDiv.innerHTML = '<div style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 8px; border-left: 4px solid #2e7d32;"><strong>Success!</strong> Our atelier serves this region. <br><small>Estimated Delivery: 2-4 business days.</small></div>';
            } else {
                resultDiv.innerHTML = '<div style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 8px; border-left: 4px solid #2e7d32;"><strong>Available!</strong> Standard insured shipping available to this location. <br><small>Estimated Delivery: 5-7 business days.</small></div>';
            }
        }, 1500);
    }
</script>

@include('frontend.footer')


