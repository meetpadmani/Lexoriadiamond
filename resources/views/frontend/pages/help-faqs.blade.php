@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Customer Support</span>
    <h1>Help & FAQs</h1>
    <div class="rajwadi-motif">
        <svg width="30" height="30" viewBox="0 0 100 100" fill="none"><path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/></svg>
    </div>
    <p>Find answers to your questions about orders, shipping, returns, and more.</p>
</section>

<div class="page-content">
    <div class="faq-item active">
        <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
            How do I place an order? <i class="bi bi-chevron-down"></i>
        </button>
        <div class="faq-answer">
            <p>Browse our collections, select your desired masterpiece, and click "Add to Bag." Once you're ready, proceed to checkout where you can enter your delivery details and choose your payment method. We accept Credit Cards, UPI, NetBanking, and Cash on Delivery.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
            What payment methods do you accept? <i class="bi bi-chevron-down"></i>
        </button>
        <div class="faq-answer">
            <p>We accept all major credit and debit cards (Visa, Mastercard, Amex), UPI payments, NetBanking, and Cash on Delivery for select locations within India. All transactions are secured with industry-standard encryption.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
            How long does delivery take? <i class="bi bi-chevron-down"></i>
        </button>
        <div class="faq-answer">
            <p>All our jewellery is insured and delivered within 5–7 business days across India. International orders may take 10–15 business days. You will receive a tracking number via email once your order is dispatched.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
            Do your diamonds come with certification? <i class="bi bi-chevron-down"></i>
        </button>
        <div class="faq-answer">
            <p>Yes. Every solitaire diamond from Lexoria Diamond comes with an internationally recognized certification from GIA (Gemological Institute of America) or IGI (International Gemological Institute), guaranteeing authenticity, quality, and value.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
            Can I customize my jewellery? <i class="bi bi-chevron-down"></i>
        </button>
        <div class="faq-answer">
            <p>Absolutely. Our atelier offers bespoke customization services. Contact us at <a href="mailto:hello@bhaumikdiamond.com">hello@bhaumikdiamond.com</a> with your vision, and our master craftsmen will bring it to life.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
            What is your return policy? <i class="bi bi-chevron-down"></i>
        </button>
        <div class="faq-answer">
            <p>We offer a 15-day return window from the date of delivery. Items must be in their original condition with all tags and certification intact. Please visit our <a href="{{ route('return-policy') }}">Return Policy</a> page for complete details.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
            How do I care for my jewellery? <i class="bi bi-chevron-down"></i>
        </button>
        <div class="faq-answer">
            <p>We recommend storing your jewellery in its Lexoria Diamond case when not in use, avoiding contact with perfumes and chemicals, and having it professionally cleaned once a year. Learn more on our <a href="{{ route('jewellery-care') }}">Jewellery Care</a> page.</p>
        </div>
    </div>

    <div class="cta-box">
        <h3>Still have questions?</h3>
        <p>Our concierge team is here to assist you with any inquiry.</p>
        <a href="{{ route('contact-us') }}" class="btn-royal">Contact Us</a>
    </div>
</div>

@include('frontend.footer')

