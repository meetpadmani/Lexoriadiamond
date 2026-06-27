@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Visit Us</span>
    <h1>Store Locator</h1>
    <div class="rajwadi-motif">
        <svg width="30" height="30" viewBox="0 0 100 100" fill="none"><path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/></svg>
    </div>
    <p>Experience the legacy of Lexoria Diamond in person at our exclusive showrooms.</p>
</section>

<div class="page-content">
    <h2>Our Showrooms</h2>
    <p>Each Lexoria Diamond showroom is designed as a palatial experience — crafted to reflect the heritage and artistry behind every piece we create.</p>

    <div class="store-grid">
        <div class="store-card">
            <span class="store-label">Flagship Showroom</span>
            <h3>Surat — Diamond Hub</h3>
            <p>B-201, Lexoria Diamond House<br>Mini Bazaar, Varachha Road<br>Surat, Gujarat 395006</p>
            <p style="margin-top: 15px;"><strong>Hours:</strong> Mon–Sat, 10:00 AM – 8:00 PM</p>
            <p><strong>Phone:</strong> +91 98765 43210</p>
        </div>

        <div class="store-card">
            <span class="store-label">Exclusive Boutique</span>
            <h3>Mumbai — Luxury Lane</h3>
            <p>305, The Grand Galleria<br>Linking Road, Bandra West<br>Mumbai, Maharashtra 400050</p>
            <p style="margin-top: 15px;"><strong>Hours:</strong> Mon–Sat, 11:00 AM – 9:00 PM</p>
            <p><strong>Phone:</strong> +91 98765 43211</p>
        </div>

        <div class="store-card">
            <span class="store-label">Coming Soon</span>
            <h3>Ahmedabad — Heritage Quarter</h3>
            <p>CG Road, Near Municipal Market<br>Navrangpura<br>Ahmedabad, Gujarat 380009</p>
            <p style="margin-top: 15px;"><strong>Opening:</strong> Summer 2026</p>
        </div>
    </div>

    <div class="cta-box">
        <h3>Book a Private Viewing</h3>
        <p>Experience our collections in an intimate, private setting with our jewellery consultants.</p>
        <a href="{{ route('contact-us') }}" class="btn-royal">Request Appointment</a>
    </div>
</div>

@include('frontend.footer')

