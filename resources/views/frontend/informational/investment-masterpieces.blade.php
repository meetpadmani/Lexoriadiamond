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
        color: #fff;
    }

    .invest-hero {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: linear-gradient(rgba(61, 10, 10, 0.8), rgba(61, 10, 10, 0.8)), 
                    url('https://images.unsplash.com/photo-1601121141461-9d6647bca1ed?auto=format&fit=crop&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .invest-hero h1 {
        font-family: 'Inter', serif;
        font-size: 5rem;
        letter-spacing: 10px;
        margin-bottom: 30px;
        text-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .invest-content {
        max-width: 1000px;
        margin: -100px auto 100px;
        background: #fff;
        color: var(--royal-maroon);
        padding: 80px;
        position: relative;
        z-index: 2;
        box-shadow: 0 50px 100px rgba(0,0,0,0.3);
        border: 1px solid var(--palace-gold);
    }

    .invest-content::before {
        content: '';
        position: absolute;
        inset: 15px;
        border: 1px solid var(--palace-gold);
        opacity: 0.3;
        pointer-events: none;
    }

    .invest-content h2 {
        font-family: 'Inter', serif;
        font-size: 3rem;
        margin-bottom: 30px;
        text-align: center;
    }

    .invest-content p {
        font-size: 1.2rem;
        line-height: 2;
        margin-bottom: 40px;
        text-align: justify;
    }

    .call-to-vault {
        text-align: center;
        margin-top: 60px;
    }

    .btn-vault {
        background: var(--royal-maroon);
        color: var(--palace-gold);
        padding: 20px 50px;
        font-family: 'Inter', serif;
        font-weight: 700;
        text-decoration: none;
        letter-spacing: 3px;
        display: inline-block;
        border: 2px solid var(--palace-gold);
        transition: all 0.4s;
    }

    .btn-vault:hover {
        background: var(--palace-gold);
        color: var(--royal-maroon);
        transform: translateY(-5px);
    }
</style>

<main>
    <section class="invest-hero">
        <div class="animate-fade-in">
            <h3 style="font-family: 'Inter', serif; letter-spacing: 5px; color: var(--palace-gold);">Rare Solitaire</h3>
            <h1>Investment</h1>
            <p style="font-size: 1.2rem; text-transform: uppercase; letter-spacing: 5px;">Masterpieces for the Ages</p>
        </div>
    </section>

    <div class="invest-content">
        <h2>Treasury of Values</h2>
        <p>A Lexoria Diamond solitaire is more than an ornament; it is a portable treasury. In an era of fluctuating markets, the rarity of a high-grade solitaire remains a timeless store of value, preserved within the architectural integrity of our hand-carved settings.</p>
        <p>We source only the most exceptional stones, those with the lineage and clarity required to stand as icons of wealth and heritage for generations to come.</p>
        
        <div class="call-to-vault">
            <a href="{{ route('collections') }}" class="btn-vault">Enter the Collection Vault</a>
        </div>
    </div>
</main>

@include('frontend.footer')


