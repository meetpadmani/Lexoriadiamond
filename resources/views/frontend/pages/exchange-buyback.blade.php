@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Value Protection</span>
    <h1>Exchange & Buy Back</h1>
    <div class="rajwadi-motif">
        <svg width="30" height="30" viewBox="0 0 100 100" fill="none"><path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/></svg>
    </div>
    <p>Your investment is always protected. Upgrade, exchange, or sell back at fair value.</p>
</section>

<div class="page-content">
    <h2>Exchange Program</h2>
    <p>At Lexoria Diamond, we understand that your style evolves. Our Exchange Program allows you to upgrade your diamond jewellery at any time, ensuring your collection always reflects your current aspirations.</p>

    <div class="info-grid">
        <div class="info-card">
            <i class="bi bi-arrow-repeat info-card-icon"></i>
            <h3>Lifetime Exchange</h3>
            <p>Exchange any Lexoria Diamond solitaire for a piece of equal or higher value, anytime.</p>
        </div>
        <div class="info-card">
            <i class="bi bi-graph-up-arrow info-card-icon"></i>
            <h3>100% Value</h3>
            <p>Receive 100% of your original diamond's current market value towards your new purchase.</p>
        </div>
        <div class="info-card">
            <i class="bi bi-patch-check info-card-icon"></i>
            <h3>Simple Process</h3>
            <p>Bring your piece with its original certification. We handle the rest with complete transparency.</p>
        </div>
    </div>

    <h2>Buy Back Policy</h2>
    <p>If you wish to sell your Lexoria Diamond jewellery back to us, we offer a competitive buy-back programme:</p>
    <ul>
        <li><strong>Solitaire Diamonds:</strong> Up to 90% of the current market value</li>
        <li><strong>Gold Jewellery:</strong> Based on prevailing gold rates at the time of buy-back</li>
        <li>Original certification and purchase invoice are required</li>
        <li>Buy-back value is determined by our in-house gemologists and is valid for 7 days</li>
    </ul>

    <h2>How It Works</h2>
    <ol>
        <li>Visit any Lexoria Diamond showroom or contact us online</li>
        <li>Present your jewellery with its original GIA/IGI certificate</li>
        <li>Our gemologists will evaluate and present a fair market valuation</li>
        <li>Choose to exchange for a new piece or receive the buy-back amount</li>
        <li>Transactions are processed within 3–5 business days</li>
    </ol>

    <div class="cta-box">
        <h3>Ready to Upgrade?</h3>
        <p>Visit our showroom or contact our team to begin the exchange process.</p>
        <a href="{{ route('contact-us') }}" class="btn-royal">Get Started</a>
    </div>
</div>

@include('frontend.footer')

