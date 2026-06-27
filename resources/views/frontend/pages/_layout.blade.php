@include('frontend.navbar')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@400;600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --raj-maroon: #0F1F17;
        --raj-maroon-deep: #000000;
        --raj-gold: #333333;
        --raj-gold-dark: #333333;
        --raj-sand: #ffffff;
        --raj-grey: #8a735a;
        --raj-border: rgba(0, 0, 0, 0.3);
        --font-heading: 'Inter', serif;
        --font-accent: 'Inter', serif;
        --font-body: 'Outfit', sans-serif;
    }

    body {
        background-color: var(--raj-sand);
        background-image:
            radial-gradient(ellipse at top right, rgba(0, 0, 0, 0.12) 0%, transparent 60%),
            radial-gradient(ellipse at bottom left, rgba(90, 25, 25, 0.08) 0%, transparent 50%);
        font-family: var(--font-body);
        color: var(--raj-maroon);
    }

    .page-bg-pattern {
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.03' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.04' stroke-width='1'/%3E%3C/svg%3E");
        z-index: -1;
        pointer-events: none;
    }

    /* ===== HERO BANNER ===== */
    .page-hero {
        background: var(--raj-maroon-deep);
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%23b58d55' stroke-opacity='0.06' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.04' stroke-width='1'/%3E%3C/svg%3E");
        padding: 80px 40px;
        text-align: center;
        border-bottom: 4px double var(--raj-gold);
        position: relative;
    }

    .page-hero::before {
        content: '';
        position: absolute;
        inset: 8px;
        border: 1px dashed rgba(0, 0, 0, 0.2);
        pointer-events: none;
    }

    .page-hero .sub-text {
        font-family: var(--font-body);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: var(--raj-gold);
        margin-bottom: 15px;
        display: block;
        font-weight: 500;
    }

    .page-hero h1 {
        font-family: var(--font-heading);
        font-size: clamp(2.5rem, 5vw, 4rem);
        color: #fff;
        margin: 0 0 20px;
        font-weight: 600;
    }

    .page-hero p {
        color: rgba(247, 239, 230, 0.7);
        max-width: 600px;
        margin: 0 auto;
        font-size: 1.05rem;
        line-height: 1.8;
    }

    .rajwadi-motif {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin: 20px 0;
    }

    .rajwadi-motif::before, .rajwadi-motif::after {
        content: '';
        height: 2px;
        width: 80px;
        background: linear-gradient(90deg, transparent, var(--raj-gold), transparent);
    }

    /* ===== CONTENT SECTION ===== */
    .page-content {
        max-width: 1000px;
        margin: 0 auto;
        padding: 80px 40px 100px;
    }

    .page-content h2 {
        font-family: var(--font-heading);
        font-size: 2rem;
        color: var(--raj-maroon);
        margin: 50px 0 20px;
        position: relative;
        padding-bottom: 15px;
    }

    .page-content h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--raj-gold);
    }

    .page-content h3 {
        font-family: var(--font-heading);
        font-size: 1.4rem;
        color: var(--raj-maroon);
        margin: 35px 0 15px;
    }

    .page-content p {
        font-size: 1.05rem;
        line-height: 2;
        color: rgba(61, 10, 10, 0.8);
        margin-bottom: 20px;
    }

    .page-content ul, .page-content ol {
        margin: 20px 0 30px 20px;
        color: rgba(61, 10, 10, 0.8);
    }

    .page-content li {
        margin-bottom: 12px;
        line-height: 1.8;
        font-size: 1.02rem;
        position: relative;
        padding-left: 15px;
    }

    .page-content ul li::before {
        content: '❖';
        position: absolute;
        left: -15px;
        color: var(--raj-gold);
        font-size: 0.7rem;
        top: 3px;
    }

    .page-content ul {
        list-style: none;
    }

    .page-content strong {
        color: var(--raj-maroon);
    }

    .page-content a {
        color: var(--raj-gold);
        text-decoration: none;
        border-bottom: 1px dashed var(--raj-gold);
        transition: all 0.3s ease;
    }

    .page-content a:hover {
        color: var(--raj-maroon);
        border-color: var(--raj-maroon);
    }

    /* Info Cards Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin: 40px 0;
    }

    .info-card {
        background: #fff;
        border: 1px solid var(--raj-border);
        padding: 35px 30px;
        text-align: center;
        transition: all 0.5s ease;
        position: relative;
    }

    .info-card::before {
        content: '';
        position: absolute;
        inset: 6px;
        border: 1px dashed rgba(0, 0, 0, 0.15);
        pointer-events: none;
        transition: all 0.5s ease;
    }

    .info-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(90, 25, 25, 0.1);
        border-color: var(--raj-gold);
    }

    .info-card:hover::before {
        border-color: rgba(0, 0, 0, 0.4);
        inset: 10px;
    }

    .info-card-icon {
        font-size: 2.5rem;
        color: var(--raj-gold);
        margin-bottom: 20px;
        display: block;
    }

    .info-card h3 {
        font-family: var(--font-heading);
        font-size: 1.3rem;
        margin: 0 0 12px;
        color: var(--raj-maroon);
    }

    .info-card p {
        font-size: 0.9rem;
        line-height: 1.7;
        color: var(--raj-grey);
        margin: 0;
    }

    /* CTA Box */
    .cta-box {
        background: var(--raj-maroon-deep);
        padding: 50px;
        text-align: center;
        margin: 60px 0;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.3);
    }

    .cta-box::before {
        content: '';
        position: absolute;
        inset: 8px;
        border: 1px dashed rgba(0, 0, 0, 0.2);
        pointer-events: none;
    }

    .cta-box h3 {
        font-family: var(--font-heading);
        font-size: 1.8rem;
        color: #fff;
        margin: 0 0 15px;
    }

    .cta-box p {
        color: rgba(247, 239, 230, 0.7);
        margin-bottom: 30px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-royal {
        display: inline-block;
        padding: 16px 45px;
        background: var(--raj-gold);
        color: var(--raj-maroon);
        text-decoration: none;
        font-family: var(--font-accent);
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        border: none;
        transition: all 0.4s ease;
    }

    .btn-royal:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(197, 160, 89, 0.4);
    }

    /* Highlight Box */
    .highlight-box {
        background: rgba(0, 0, 0, 0.06);
        border-left: 4px solid var(--raj-gold);
        padding: 25px 30px;
        margin: 30px 0;
    }

    .highlight-box p {
        margin: 0;
        font-style: italic;
    }

    /* Contact Form */
    .contact-form {
        margin: 40px 0;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--raj-grey);
        margin-bottom: 8px;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        background: #fff;
        border: 1px solid var(--raj-border);
        font-family: var(--font-body);
        font-size: 1rem;
        color: var(--raj-maroon);
        outline: none;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--raj-gold);
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .btn-submit {
        display: inline-block;
        padding: 18px 50px;
        background: var(--raj-maroon);
        color: var(--raj-gold);
        font-family: var(--font-accent);
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        border: 2px solid var(--raj-gold);
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .btn-submit:hover {
        background: var(--raj-gold);
        color: var(--raj-maroon);
        transform: translateY(-2px);
    }

    /* FAQ Accordion */
    .faq-item {
        border-bottom: 1px solid var(--raj-border);
        margin-bottom: 0;
    }

    .faq-question {
        width: 100%;
        padding: 25px 0;
        background: none;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-family: var(--font-heading);
        font-size: 1.15rem;
        color: var(--raj-maroon);
        font-weight: 600;
        text-align: left;
        transition: color 0.3s ease;
    }

    .faq-question:hover {
        color: var(--raj-gold);
    }

    .faq-question i {
        transition: transform 0.4s ease;
        color: var(--raj-gold);
    }

    .faq-item.active .faq-question i {
        transform: rotate(180deg);
    }

    .faq-answer {
        display: none;
        padding: 0 0 25px;
        color: rgba(61, 10, 10, 0.75);
        line-height: 1.9;
    }

    .faq-item.active .faq-answer {
        display: block;
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding-left: 40px;
        margin: 40px 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, var(--raj-gold), transparent);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 40px;
    }

    .timeline-item::before {
        content: '❖';
        position: absolute;
        left: -47px;
        top: 5px;
        color: var(--raj-gold);
        font-size: 0.8rem;
    }

    .timeline-item h3 {
        margin-top: 0;
    }

    /* Store Cards */
    .store-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin: 40px 0;
    }

    .store-card {
        background: #fff;
        border: 1px solid var(--raj-border);
        padding: 35px;
        position: relative;
    }

    .store-card::before {
        content: '';
        position: absolute;
        inset: 6px;
        border: 1px dashed rgba(0, 0, 0, 0.15);
        pointer-events: none;
    }

    .store-card h3 {
        font-family: var(--font-heading);
        margin: 0 0 15px;
        color: var(--raj-maroon);
    }

    .store-card p {
        font-size: 0.95rem;
        line-height: 1.8;
        margin: 0 0 5px;
    }

    .store-card .store-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--raj-gold);
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
    }

    @media (max-width: 768px) {
        .page-hero {
            padding: 60px 20px;
        }

        .page-hero h1 {
            font-size: 2.2rem;
        }

        .page-content {
            padding: 50px 20px 80px;
        }

        .page-content h2 {
            font-size: 1.6rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .cta-box {
            padding: 35px 20px;
        }

        .cta-box h3 {
            font-size: 1.4rem;
        }

        .store-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-bg-pattern"></div>


