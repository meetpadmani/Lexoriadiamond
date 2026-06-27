@include('frontend.navbar')

<style>
    /* Elegant Box Theme */
    body {
        background-color: #fdfaf7; /* Soft pearl/cream background */
    }

    .auth-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .auth-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.06);
        display: flex;
        width: 100%;
        max-width: 950px;
        min-height: 550px;
        overflow: hidden;
        animation: scaleUp 0.5s ease-out;
    }

    @keyframes scaleUp {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    /* Left Side: Image Box */
    .auth-image-box {
        flex: 1;
        background-color: #f5eedc;
        background-image: url('https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?q=80&w=1000');
        background-size: cover;
        background-position: center;
        position: relative;
        display: none;
        filter: grayscale(20%) sepia(10%);
    }

    @media (min-width: 992px) {
        .auth-image-box {
            display: block;
        }
    }

    .auth-image-box::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.5));
    }

    .auth-image-text {
        position: absolute;
        bottom: 40px;
        left: 40px;
        right: 40px;
        color: #ffffff;
        z-index: 2;
    }

    .auth-image-text h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        margin-bottom: 10px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .auth-image-text p {
        font-size: 0.95rem;
        opacity: 0.9;
        letter-spacing: 1px;
    }

    /* Right Side: Form */
    .auth-form-box {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .auth-header {
        margin-bottom: 35px;
        width: 100%;
    }

    .auth-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: #111111;
        margin-bottom: 8px;
    }

    .auth-header p {
        color: #888888;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* OTP Inputs */
    .otp-container {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 30px;
        direction: ltr;
    }

    .otp-input {
        width: 50px;
        height: 60px;
        background: #fdfaf7;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        font-size: 1.5rem;
        font-weight: 700;
        text-align: center;
        color: #111111;
        transition: all 0.3s;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    }

    .otp-input:focus {
        background: #ffffff;
        border-color: #111111;
        outline: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    .otp-input::-webkit-outer-spin-button,
    .otp-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Button */
    .btn-rajwadi {
        width: 100%;
        max-width: 350px;
        background-color: #111111;
        color: #ffffff;
        border: none;
        padding: 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-rajwadi:hover {
        background-color: #333333;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .auth-footer {
        margin-top: 30px;
        text-align: center;
        font-size: 0.85rem;
        color: #888888;
    }

    .auth-footer a {
        color: #111111;
        font-weight: 600;
        text-decoration: underline;
    }

    .alert-custom {
        padding: 14px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.85rem;
        width: 100%;
        text-align: left;
    }
    .alert-success-custom {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #dcfce7;
    }
    .alert-danger-custom {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fee2e2;
    }

    .otp-input.error {
        border-color: #ef4444;
        background: #fef2f2;
        color: #ef4444;
        animation: shake 0.4s;
    }

    .otp-input.success {
        border-color: #22c55e;
        background: #f0fdf4;
        color: #22c55e;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .success-overlay {
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        animation: fadeIn 0.5s ease-out;
        text-align: center;
    }

    .success-overlay.active {
        display: flex;
    }

    .success-icon {
        width: 60px;
        height: 60px;
        background: #22c55e;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin-bottom: 20px;
        animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes scaleIn {
        0% { transform: scale(0); }
        100% { transform: scale(1); }
    }

    .success-message {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: #111111;
        margin-bottom: 10px;
    }

    .success-submessage {
        color: #888888;
        font-size: 0.95rem;
    }

    #main-form-container {
        width: 100%;
        transition: all 0.3s;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .auth-page {
            padding: 20px 15px;
            align-items: flex-start;
        }
        .auth-card {
            min-height: auto;
            border-radius: 12px;
        }
        .auth-form-box {
            padding: 35px 25px;
        }
        .auth-header h1 {
            font-size: 1.6rem;
        }
        .auth-header p {
            font-size: 0.85rem;
        }
        .otp-container {
            gap: 8px;
            margin-bottom: 25px;
        }
        .otp-input {
            width: 42px;
            height: 52px;
            font-size: 1.25rem;
        }
        .btn-rajwadi {
            padding: 14px;
            font-size: 0.9rem;
        }
        .success-message {
            font-size: 1.5rem;
        }
        .success-icon {
            width: 50px;
            height: 50px;
            font-size: 24px;
        }
    }
</style>

<section class="auth-page">
    <div class="auth-card">
        
        <!-- Left Side: Image -->
        <div class="auth-image-box" style="background-image: url('https://images.unsplash.com/photo-1611591437281-460bfbe1220a?q=80&w=1000');">
            <div class="auth-image-text">
                <h2>Secure Access</h2>
                <p>Verifying your royal identity to protect your treasury.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="auth-form-box">
            
            <div id="main-form-container">
                <div class="auth-header">
                    <h1>Enter Access Code</h1>
                    <p>We've dispatched a 6-digit access code to <strong>{{ session('otp_login_id') }}</strong>. Please enter it below.</p>
                </div>

                <div class="alert-custom alert-danger-custom" id="error-alert" style="display: none;"></div>

                <form id="otpForm" style="width: 100%; display: flex; flex-direction: column; align-items: center;">
                    <div class="otp-container" id="otp-inputs">
                        <input type="number" class="otp-input" maxlength="1" oninput="moveToNext(this, event)" onkeydown="moveToPrev(this, event)" autofocus>
                        <input type="number" class="otp-input" maxlength="1" oninput="moveToNext(this, event)" onkeydown="moveToPrev(this, event)">
                        <input type="number" class="otp-input" maxlength="1" oninput="moveToNext(this, event)" onkeydown="moveToPrev(this, event)">
                        <input type="number" class="otp-input" maxlength="1" oninput="moveToNext(this, event)" onkeydown="moveToPrev(this, event)">
                        <input type="number" class="otp-input" maxlength="1" oninput="moveToNext(this, event)" onkeydown="moveToPrev(this, event)">
                        <input type="number" class="otp-input" maxlength="1" oninput="moveToNext(this, event)" onkeydown="moveToPrev(this, event)">
                    </div>

                    <button type="button" id="submitBtn" class="btn-rajwadi">Verify & Enter Palace</button>
                </form>

                <div class="auth-footer">
                    Didn't receive the code? <a href="{{ route('login') }}">Go back and try again</a>
                </div>
            </div>

            <!-- Success Overlay -->
            <div class="success-overlay" id="success-overlay">
                <div class="success-icon">✓</div>
                <div class="success-message" id="success-title">Welcome!</div>
                <div class="success-submessage">Entering the royal treasury...</div>
            </div>

        </div>
    </div>
</section>

<script>
    const inputs = document.querySelectorAll('.otp-input');
    const submitBtn = document.getElementById('submitBtn');
    const errorAlert = document.getElementById('error-alert');
    const mainForm = document.getElementById('main-form-container');
    const successOverlay = document.getElementById('success-overlay');
    const successTitle = document.getElementById('success-title');

    function getOtpValue() {
        let otp = '';
        inputs.forEach(input => otp += input.value);
        return otp;
    }

    function moveToNext(elem, event) {
        elem.classList.remove('error'); // clear error on type
        errorAlert.style.display = 'none';

        if (elem.value.length > 1) {
            elem.value = elem.value.slice(0, 1);
        }
        
        if (elem.value.length === 1) {
            let next = elem.nextElementSibling;
            if (next) {
                next.focus();
            } else {
                // Auto submit if last digit entered
                if(getOtpValue().length === 6) {
                    processLogin();
                }
            }
        }
    }

    function moveToPrev(elem, event) {
        if (event.key === 'Backspace' && elem.value === '') {
            let prev = elem.previousElementSibling;
            if (prev) prev.focus();
        }
    }

    // Handle Paste Event
    document.getElementById('otp-inputs').addEventListener('paste', function(e) {
        e.preventDefault();
        let paste = (e.clipboardData || window.clipboardData).getData('text');
        paste = paste.replace(/\D/g, '').substring(0, 6);
        
        if (paste.length > 0) {
            for (let i = 0; i < paste.length; i++) {
                if (inputs[i]) inputs[i].value = paste[i];
            }
            if (paste.length === 6) {
                processLogin();
            } else {
                inputs[paste.length].focus();
            }
        }
    });

    submitBtn.addEventListener('click', processLogin);

    async function processLogin() {
        const otp = getOtpValue();
        if (otp.length !== 6) {
            showError('Please enter the complete 6-digit code.');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Verifying...';
        
        try {
            const response = await fetch('{{ route('otp.verify.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ otp: otp })
            });

            const data = await response.json();

            if (!response.ok) {
                let errorMsg = data.message || 'Verification failed.';
                if (data.errors && data.errors.otp) {
                    errorMsg = data.errors.otp[0];
                }
                showError(errorMsg);
            } else {
                showSuccess(data.name, data.is_new_user, data.redirect);
            }

        } catch (error) {
            showError('An unexpected error occurred. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Verify & Enter Palace';
        }
    }

    function showError(message) {
        errorAlert.innerHTML = '• ' + message;
        errorAlert.style.display = 'block';
        inputs.forEach(input => input.classList.add('error'));
        inputs[0].focus();
    }

    function showSuccess(name, isNew, redirectUrl) {
        // Make inputs green
        inputs.forEach(input => {
            input.classList.remove('error');
            input.classList.add('success');
        });

        // Hide form, show welcome message
        setTimeout(() => {
            mainForm.style.display = 'none';
            successOverlay.classList.add('active');
            
            if (isNew) {
                successTitle.innerHTML = `Welcome, <br><span style="color:#d4af37">${name}</span>!`;
            } else {
                successTitle.innerHTML = `Welcome back, <br><span style="color:#d4af37">${name}</span>!`;
            }

            // Redirect after 3 seconds
            setTimeout(() => {
                window.location.href = redirectUrl;
            }, 3000);

        }, 500); // 0.5s delay to show green boxes before swapping UI
    }
</script>

@include('frontend.footer')
