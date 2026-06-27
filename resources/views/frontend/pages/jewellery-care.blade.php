@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Preserve Your Treasure</span>
    <h1>Jewellery Care</h1>
    <div class="rajwadi-motif">
        <svg width="30" height="30" viewBox="0 0 100 100" fill="none"><path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/></svg>
    </div>
    <p>Caring for your Lexoria Diamond jewellery ensures it continues to sparkle for generations.</p>
</section>

<div class="page-content">
    <div class="info-grid">
        <div class="info-card">
            <i class="bi bi-droplet info-card-icon"></i>
            <h3>Avoid Chemicals</h3>
            <p>Remove jewellery before applying perfume, lotion, or cleaning products. Chemicals can dull metals and damage gemstones over time.</p>
        </div>
        <div class="info-card">
            <i class="bi bi-archive info-card-icon"></i>
            <h3>Proper Storage</h3>
            <p>Store each piece in its Lexoria Diamond case or a soft-lined box. Keep items separated to prevent scratching.</p>
        </div>
        <div class="info-card">
            <i class="bi bi-stars info-card-icon"></i>
            <h3>Gentle Cleaning</h3>
            <p>Use a soft, lint-free cloth to gently wipe your jewellery after each wear. This removes oils and restores shine.</p>
        </div>
    </div>

    <h2>Diamond Care Guidelines</h2>
    <ul>
        <li>Clean diamonds with warm soapy water and a soft-bristled brush</li>
        <li>Rinse thoroughly under clean water and pat dry with a soft cloth</li>
        <li>Avoid wearing diamonds during heavy physical activity</li>
        <li>Have your diamond settings inspected annually by a professional jeweller</li>
        <li>Ultrasonic cleaners are safe for most diamonds but not for treated or fracture-filled stones</li>
    </ul>

    <h2>Gold & Platinum Care</h2>
    <ul>
        <li>Polish gold with a jewellery-specific polishing cloth</li>
        <li>Avoid exposing gold to chlorine and saltwater</li>
        <li>Platinum naturally develops a patina over time — professional polishing restores its original lustre</li>
        <li>Remove rings before washing hands frequently to preserve finish</li>
    </ul>

    <h2>Professional Servicing</h2>
    <p>We recommend having your Lexoria Diamond jewellery professionally serviced once a year. Our atelier offers complimentary cleaning and inspection for all purchases.</p>

    <div class="cta-box">
        <h3>Book a Service Appointment</h3>
        <p>Let our master craftsmen restore your jewellery to its original brilliance.</p>
        <a href="{{ route('contact-us') }}" class="btn-royal">Schedule Service</a>
    </div>
</div>

@include('frontend.footer')

