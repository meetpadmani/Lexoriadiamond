@include('frontend.navbar')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@400;700&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    :root {
        --royal-maroon: #0F1F17;
        --palace-gold: #333333;
        --sandstone: #f4ece2;
    }

    body {
        background-color: var(--sandstone);
        background-image:
            radial-gradient(ellipse at top right, rgba(0, 0, 0, 0.12) 0%, transparent 60%),
            radial-gradient(ellipse at bottom left, rgba(90, 25, 25, 0.08) 0%, transparent 50%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.03' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.04' stroke-width='1'/%3E%3C/svg%3E");
        font-family: 'Outfit', sans-serif;
        color: var(--royal-maroon);
    }

    .edu-hero {
        padding: 100px 20px;
        background: var(--royal-maroon);
        color: #fff;
        text-align: center;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0L100 50L50 100L0 50Z' fill='none' stroke='%23c5a059' stroke-opacity='0.1' stroke-width='1'/%3E%3C/svg%3E");
    }

    .edu-hero h1 {
        font-family: 'Inter', serif;
        font-size: 3.5rem;
        margin-bottom: 20px;
        letter-spacing: 3px;
    }

    .edu-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 40px;
    }

    .edu-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        margin-bottom: 100px;
    }

    .edu-text h2 {
        font-family: 'Inter', serif;
        font-size: 2.5rem;
        margin-bottom: 25px;
        color: var(--royal-maroon);
    }

    .edu-text p {
        font-size: 1.1rem;
        line-height: 2;
        color: rgba(61, 10, 10, 0.8);
    }

    .edu-image {
        position: relative;
        padding: 20px;
    }

    .edu-image::before {
        content: '';
        position: absolute;
        inset: 0;
        border: 2px solid var(--palace-gold);
        z-index: 0;
    }

    .edu-image img {
        width: 100%;
        height: auto;
        display: block;
        position: relative;
        z-index: 1;
        box-shadow: 20px 20px 40px rgba(61, 10, 10, 0.1);
    }

    .certification-box {
        background: #fff;
        border: 1px solid var(--palace-gold);
        padding: 50px;
        text-align: center;
        border-radius: 0;
        margin-top: 60px;
    }

    .cert-icons {
        display: flex;
        justify-content: center;
        gap: 50px;
        margin-top: 40px;
    }

    .cert-icon {
        font-family: 'Inter', serif;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--palace-gold);
        border: 2px solid var(--palace-gold);
        padding: 20px 40px;
    }
</style>

<main>
    <section class="edu-hero">
        <h1 class="animate-fade-in">The Diamond Guide</h1>
        <p class="letter-spacing-2 text-uppercase">Navigating the Luminous Path of the 4Cs</p>
    </section>

    <div class="edu-content">
        <div class="edu-section">
            <div class="edu-text">
                <h2>Mastering the 4Cs</h2>
                <p>To choose a masterpiece is to understand its essence. At Lexoria Diamond, we educate our patrons on the critical pillars of valuation: <strong>Color, Clarity, Cut, and Carat weight.</strong></p>
                <p>Every stone is hand-curated to ensure it carries the pedigree of the Rajwadi house, meeting standards that exceed ordinary commercial metrics.</p>
            </div>
            <div class="edu-image">
                <img src="https://images.unsplash.com/photo-1573408301185-9146fe634ad0?auto=format&fit=crop&q=80" alt="Diamond Education">
            </div>
        </div>

        <div class="certification-box">
            <h2 style="font-family: 'Inter', serif; font-size: 2.2rem; margin-bottom: 20px;">Imperial Certification</h2>
            <p>Transparency is our creed. Every solitaire masterpiece is accompanied by internationally recognized certification, ensuring its lineage and value for generations.</p>
            <div class="cert-icons">
                <div class="cert-icon">GIA</div>
                <div class="cert-icon">IGI</div>
            </div>
        </div>
    </div>
</main>

@include('frontend.footer')


