@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Responsible Luxury</span>
    <h1>Ethical Diamonds</h1>
    <div class="rajwadi-motif">
        <svg width="30" height="30" viewBox="0 0 100 100" fill="none"><path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/></svg>
    </div>
    <p>Beauty without compromise. Every Lexoria Diamond is sourced with integrity and conscience.</p>
</section>

<div class="page-content">
    <h2>Our Ethical Promise</h2>
    <p>At Lexoria Diamond, we believe that true luxury must be built on a foundation of ethics and responsibility. Every diamond in our collection is sourced in strict compliance with the Kimberley Process Certification Scheme, ensuring they are conflict-free and ethically mined.</p>

    <div class="info-grid">
        <div class="info-card">
            <i class="bi bi-globe2 info-card-icon"></i>
            <h3>Conflict-Free</h3>
            <p>100% of our diamonds are certified conflict-free, sourced from mines that uphold human rights and fair labour practices.</p>
        </div>
        <div class="info-card">
            <i class="bi bi-tree info-card-icon"></i>
            <h3>Environmental Care</h3>
            <p>We partner with suppliers committed to sustainable mining practices that minimize environmental impact and restore local ecosystems.</p>
        </div>
        <div class="info-card">
            <i class="bi bi-people info-card-icon"></i>
            <h3>Community Support</h3>
            <p>Our supply chain supports mining communities through fair wages, education programs, and healthcare initiatives.</p>
        </div>
    </div>

    <h2>Certification & Transparency</h2>
    <p>Every solitaire diamond we sell is accompanied by an independent grading report from GIA or IGI. This ensures complete transparency regarding the stone's 4Cs (Cut, Color, Clarity, Carat), origin, and treatment history.</p>

    <p>We maintain a fully traceable supply chain, from mine to market. Our customers can trust that every diamond carries a provenance of integrity.</p>

    <h2>Lab-Grown Options</h2>
    <p>For clients who prefer a lab-created alternative, we also offer a curated selection of lab-grown diamonds. These stones are chemically, physically, and optically identical to natural diamonds, offering an eco-conscious choice without compromising on beauty or quality.</p>

    <div class="cta-box">
        <h3>Browse Ethical Collections</h3>
        <p>Discover diamonds that reflect your values as much as your style.</p>
        <a href="{{ route('collections') }}" class="btn-royal">Explore Now</a>
    </div>
</div>

@include('frontend.footer')

