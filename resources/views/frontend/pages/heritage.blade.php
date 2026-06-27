@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Timeless Traditions</span>
    <h1>Heritage</h1>
    <div class="rajwadi-motif">
        <svg width="30" height="30" viewBox="0 0 100 100" fill="none"><path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/></svg>
    </div>
    <p>A journey through time, rooted in the rich diamond heritage of India.</p>
</section>

<div class="page-content">
    <p>The story of Lexoria Diamond is inseparable from the story of Surat itself — a city that has been the world's diamond processing capital for centuries. Our heritage draws from this deep well of expertise, passed down through generations of master artisans.</p>

    <div class="timeline">
        <div class="timeline-item">
            <h3>The Craft Begins</h3>
            <p>Our founders apprenticed under some of Surat's most renowned diamond cutters, learning the sacred geometry of light and stone. This foundational knowledge became the bedrock of Lexoria Diamond.</p>
        </div>
        <div class="timeline-item">
            <h3>The Atelier Opens</h3>
            <p>With a commitment to excellence, the first Lexoria Diamond workshop was established. Every stone was hand-selected, every cut calibrated to perfection — a standard that remains unchanged to this day.</p>
        </div>
        <div class="timeline-item">
            <h3>The Royal Standard</h3>
            <p>Inspired by the grandeur of Rajwadi architecture and the precision of ancient Indian diamond trade, we developed our signature aesthetic — where heritage meets contemporary luxury.</p>
        </div>
        <div class="timeline-item">
            <h3>A Modern Legacy</h3>
            <p>Today, Lexoria Diamond bridges tradition and modernity. Our digital atelier brings the same palace-level experience to clients worldwide, while our craftsmen continue to honour centuries-old techniques.</p>
        </div>
    </div>

    <div class="highlight-box">
        <p>"In every diamond, we see the reflection of generations — the wisdom of the past meeting the aspirations of the future."</p>
    </div>

    <div class="cta-box">
        <h3>Discover Our Craftsmanship</h3>
        <p>See how our master artisans transform raw stones into timeless masterpieces.</p>
        <a href="{{ route('craftsmanship') }}" class="btn-royal">Craftsmanship</a>
    </div>
</div>

@include('frontend.footer')

