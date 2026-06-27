@include('frontend.pages._layout')

<section class="page-hero">
    <span class="sub-text">Master Artisans</span>
    <h1>Craftsmanship</h1>
    <div class="rajwadi-motif">
        <svg width="30" height="30" viewBox="0 0 100 100" fill="none"><path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/></svg>
    </div>
    <p>Where ancient techniques meet modern precision to create diamonds of extraordinary brilliance.</p>
</section>

<div class="page-content">
    <h2>The Art of Diamond Cutting</h2>
    <p>At Lexoria Diamond, every stone undergoes a meticulous journey from rough crystal to polished masterpiece. Our cutters study each diamond's natural characteristics — its inclusions, its crystal structure, its light behaviour — before making a single cut.</p>

    <p>This patient, deliberate approach ensures that every facet is aligned to maximize brilliance, fire, and scintillation. It is an art form that cannot be rushed, only perfected.</p>

    <div class="info-grid">
        <div class="info-card">
            <i class="bi bi-eye info-card-icon"></i>
            <h3>Selection</h3>
            <p>Each rough diamond is carefully evaluated by our gemologists. Only stones meeting our exacting standards proceed to the cutting floor.</p>
        </div>
        <div class="info-card">
            <i class="bi bi-rulers info-card-icon"></i>
            <h3>Planning</h3>
            <p>Advanced 3D mapping technology analyses the stone's optimal cut, maximizing carat weight while ensuring perfect proportions.</p>
        </div>
        <div class="info-card">
            <i class="bi bi-gem info-card-icon"></i>
            <h3>Cutting & Polishing</h3>
            <p>Master craftsmen execute each cut with sub-millimetre precision. The polishing phase brings out the diamond's ultimate fire and lustre.</p>
        </div>
        <div class="info-card">
            <i class="bi bi-award info-card-icon"></i>
            <h3>Quality Assurance</h3>
            <p>Every finished diamond is inspected under 10x magnification and graded against international standards before certification.</p>
        </div>
    </div>

    <h2>Setting & Finishing</h2>
    <p>Our jewellery settings are crafted with the same obsessive attention to detail. Whether a classic solitaire prong setting or an intricate pavé design, every millimetre of metal is worked by hand to complement the diamond's natural beauty.</p>

    <p>We use only the finest 18K gold and 950 platinum, sourced from certified refiners. Each piece is rhodium-plated where applicable and given a final hand-polish that creates a mirror-like finish worthy of the Lexoria name.</p>

    <div class="highlight-box">
        <p>"The difference between a good diamond and an extraordinary one lies not in the stone alone, but in the hands that shape it."</p>
    </div>

    <div class="cta-box">
        <h3>See Our Masterpieces</h3>
        <p>Explore the collections born from this uncompromising craft.</p>
        <a href="{{ route('collections') }}" class="btn-royal">View Collections</a>
    </div>
</div>

@include('frontend.footer')

