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
        background-color: var(--royal-maroon);
        background-image:
            radial-gradient(ellipse at top right, rgba(0, 0, 0, 0.08) 0%, transparent 60%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%23b58d55' stroke-opacity='0.05' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.04' stroke-width='1'/%3E%3C/svg%3E");
        font-family: 'Outfit', sans-serif;
        color: var(--sandstone);
    }

    .info-hero {
        height: 60vh;
        background: linear-gradient(rgba(61, 10, 10, 0.7), rgba(61, 10, 10, 0.7)), 
                    url('https://images.unsplash.com/photo-1543292490-6712361fcd68?auto=format&fit=crop&q=80');
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-bottom: 4px double var(--palace-gold);
    }

    .info-hero h1 {
        font-family: 'Inter', serif;
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        letter-spacing: 5px;
        margin-bottom: 20px;
    }

    .shapes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
        padding: 80px 40px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .shape-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(197, 160, 89, 0.2);
        padding: 40px;
        text-align: center;
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .shape-card::before {
        content: '';
        position: absolute;
        inset: 10px;
        border: 1px dashed var(--palace-gold);
        opacity: 0.2;
        transition: opacity 0.5s;
    }

    .shape-card:hover {
        transform: translateY(-10px);
        background: rgba(197, 160, 89, 0.05);
        border-color: var(--palace-gold);
    }

    .shape-card:hover::before {
        opacity: 0.8;
    }

    .shape-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 30px;
        background: var(--palace-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        color: var(--royal-maroon);
        font-size: 2.5rem;
    }

    .shape-card h3 {
        font-family: 'Inter', serif;
        font-size: 1.8rem;
        margin-bottom: 15px;
        color: var(--palace-gold);
    }

    .shape-card p {
        font-size: 1rem;
        line-height: 1.8;
        opacity: 0.8;
    }
</style>

<main>
    <section class="info-hero">
        <h3 style="font-family: 'Inter', serif; letter-spacing: 5px; color: var(--palace-gold);">Architectural Divinity</h3>
        <h1>Diamond Shapes</h1>
        <p style="max-width: 700px; margin: 0 auto; font-style: italic; opacity: 0.8;">The geometry of brilliance, carved for eternity in the royal house.</p>
    </section>

    <section class="shapes-grid">
        <div class="shape-card animate-fade-in">
            <div class="shape-icon"><i class="bi bi-circle"></i></div>
            <h3>Round Brilliant</h3>
            <p>The ultimate sparkle, featuring 57 or 58 facets precisely aligned to mirror the brilliance of the Jaipur sun. The most sought-after cut for royal engagements.</p>
        </div>

        <div class="shape-card animate-fade-in" style="animation-delay: 0.2s;">
            <div class="shape-icon"><i class="bi bi-pentagon"></i></div>
            <h3>Emerald Cut</h3>
            <p>Vintage sophistication with step-cut facets that create a "hall of mirrors" effect. A favorite for collectors seeking clarity and architectural depth.</p>
        </div>

        <div class="shape-card animate-fade-in" style="animation-delay: 0.4s;">
            <div class="shape-icon"><i class="bi bi-heart"></i></div>
            <h3>Heart Shape</h3>
            <p>Pure romance expressed through masterful craftsmanship. A complex cut requiring perfect symmetry to represent the eternal bond of the Rajwadi house.</p>
        </div>
    </section>
</main>

@include('frontend.footer')


