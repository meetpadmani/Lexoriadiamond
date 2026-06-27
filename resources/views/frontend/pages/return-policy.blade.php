@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Our Commitment</span>
    <h1>Return Policy</h1>
    <div class="rajwadi-motif">
        <svg width="30" height="30" viewBox="0 0 100 100" fill="none"><path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/></svg>
    </div>
    <p>Your satisfaction is our highest honour. We stand behind every piece we craft.</p>
</section>

<div class="page-content">
    <h2>Return Window</h2>
    <p>We offer a <strong>15-day return window</strong> from the date of delivery. If you are not completely satisfied with your purchase, you may return it for a full refund or exchange.</p>

    <h2>Eligibility Conditions</h2>
    <ul>
        <li>The item must be in its original, unworn condition</li>
        <li>All original tags, packaging, and certification must be intact</li>
        <li>Customized or engraved items are non-returnable</li>
        <li>Items purchased during special promotional events may have modified return terms</li>
        <li>The return must be initiated within 15 calendar days of delivery</li>
    </ul>

    <h2>How to Initiate a Return</h2>
    <ol>
        <li>Contact our concierge team at <a href="mailto:returns@bhaumikdiamond.com">returns@bhaumikdiamond.com</a></li>
        <li>Provide your Order ID and reason for return</li>
        <li>You will receive a pre-paid, insured return shipping label</li>
        <li>Package the item securely in its original box</li>
        <li>Drop off the parcel at the nearest courier partner location</li>
    </ol>

    <h2>Refund Processing</h2>
    <p>Once we receive and inspect the returned item, your refund will be processed within <strong>5–7 business days</strong> to the original payment method. You will receive a confirmation email once the refund is initiated.</p>

    <div class="highlight-box">
        <p>"At Lexoria Diamond, we believe every interaction should reflect the same care and precision we put into crafting our jewellery."</p>
    </div>

    <div class="cta-box">
        <h3>Need Assistance?</h3>
        <p>Our team is available to guide you through the return process.</p>
        <a href="{{ route('contact-us') }}" class="btn-royal">Get in Touch</a>
    </div>
</div>

@include('frontend.footer')

