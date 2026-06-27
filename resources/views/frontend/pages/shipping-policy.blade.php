@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Delivery Information</span>
    <h1>Shipping Policy</h1>
    <div class="rajwadi-motif">
        <svg width="30" height="30" viewBox="0 0 100 100" fill="none"><path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/></svg>
    </div>
    <p>Every masterpiece deserves a royal journey — insured, secure, and delivered with care.</p>
</section>

<div class="page-content">
    <h2>Domestic Shipping (India)</h2>
    <ul>
        <li><strong>Standard Delivery:</strong> 5–7 business days — Complimentary on all orders</li>
        <li><strong>Express Delivery:</strong> 2–3 business days — Available for select locations</li>
        <li>All domestic shipments are fully insured at no additional cost</li>
        <li>Signature confirmation is required upon delivery</li>
    </ul>

    <h2>International Shipping</h2>
    <ul>
        <li><strong>Estimated Delivery:</strong> 10–15 business days</li>
        <li>International shipping charges and duties vary by destination</li>
        <li>Import duties and taxes are the responsibility of the recipient</li>
        <li>All international orders are shipped via premium insured carriers</li>
    </ul>

    <h2>Order Tracking</h2>
    <p>Once your order is dispatched, you will receive a confirmation email with your tracking number and carrier details. You can track your order status at any time through our <a href="{{ route('track-order') }}">Track Order</a> page.</p>

    <h2>Packaging</h2>
    <p>Every Lexoria Diamond piece is presented in our signature packaging — a velvet-lined box housed within a branded outer case. The packaging is designed to protect your purchase during transit and serve as an elegant storage solution.</p>

    <div class="highlight-box">
        <p>All shipments are sealed with a tamper-evident Lexoria Diamond security seal for your peace of mind.</p>
    </div>

    <h2>Delivery Issues</h2>
    <p>If your package arrives damaged or if you experience any delivery issues, please contact us within 48 hours of delivery at <a href="mailto:support@bhaumikdiamond.com">support@bhaumikdiamond.com</a>. We will arrange an immediate resolution.</p>
</div>

@include('frontend.footer')

