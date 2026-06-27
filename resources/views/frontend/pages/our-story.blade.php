@include('frontend.pages._layout')

<style>
/* CSS for scrollytelling */
body { margin: 0; padding: 0; background: #000; color: #fff; }

.scrolly-container {
    position: relative;
    width: 100%;
}

.scrolly-backgrounds {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 0;
    overflow: hidden;
}

.scrolly-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transform: scale(1);
    will-change: transform, opacity;
}

/* Gradient overlay to make text readable */
.scrolly-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);
    z-index: 1;
}

.scrolly-content {
    position: relative;
    z-index: 10;
    width: 100%;
}

.scrolly-section {
    min-height: 120vh; /* Make them long to scroll through */
    width: 100%;
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 10%;
}

.scrolly-text-box {
    width: 45%;
    min-width: 300px;
    padding: 70px 60px;
    opacity: 0;
    transform: translateY(50px);
    background: rgba(10, 10, 10, 0.45);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-left: 4px solid var(--brand-gold, #c9a96e);
    border-radius: 0 20px 20px 0;
    box-shadow: 0 30px 60px rgba(0,0,0,0.8), inset 0 0 20px rgba(255,255,255,0.02);
}

.scrolly-text-box h4 {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    letter-spacing: 4px;
    color: var(--brand-gold, #c9a96e);
    text-transform: uppercase;
    margin-bottom: 20px;
}

.scrolly-text-box h2 {
    font-family: 'Playfair Display', serif;
    font-size: 3.5rem;
    margin-bottom: 30px;
    line-height: 1.2;
    text-shadow: 0 5px 15px rgba(0,0,0,0.5);
}

.scrolly-text-box p {
    font-size: 1.2rem;
    line-height: 1.8;
    color: rgba(255,255,255,0.8);
}

/* Pagination */
.scrolly-pagination {
    position: fixed;
    right: 40px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
    display: flex;
    flex-direction: column;
    gap: 30px;
    align-items: center;
}

.scrolly-pagination::before {
    content: '';
    position: absolute;
    top: 0; bottom: 0;
    width: 1px;
    background: rgba(255,255,255,0.15);
    z-index: -1;
}

.scrolly-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
}

.scrolly-dot.active {
    background: transparent;
    border-color: var(--brand-gold, #c9a96e);
    box-shadow: 0 0 15px rgba(201, 169, 110, 0.4), inset 0 0 8px rgba(201, 169, 110, 0.4);
    transform: scale(1.8);
}

/* Big Number Watermark */
.scrolly-watermark {
    position: fixed;
    bottom: -50px;
    right: 50px;
    font-family: 'Playfair Display', serif;
    font-size: 30vw;
    color: rgba(255,255,255,0.03);
    z-index: 5;
    pointer-events: none;
    line-height: 1;
}

@media (max-width: 992px) {
    .scrolly-text-box { width: 80%; padding: 30px; }
    .scrolly-section { padding-left: 5%; }
    .scrolly-overlay { background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 100%); }
    .scrolly-text-box h2 { font-size: 2.5rem; }
    .scrolly-watermark { font-size: 50vw; }
}
</style>

<div class="scrolly-container">
    <!-- Fixed Backgrounds -->
    <div class="scrolly-backgrounds">
        <div class="scrolly-bg" id="bg-1" style="background-image: url('/frontend/images/story_bg_discovery_1781775993656.png'); opacity: 1;"></div>
        <div class="scrolly-bg" id="bg-2" style="background-image: url('/frontend/images/story_bg_artistry_1781776006748.png');"></div>
        <div class="scrolly-bg" id="bg-3" style="background-image: url('/frontend/images/story_bg_vision_1781776017552.png');"></div>
        <div class="scrolly-bg" id="bg-4" style="background-image: url('/frontend/images/story_bg_legacy_1781776031139.png');"></div>
        <div class="scrolly-bg" id="bg-5" style="background-image: url('/frontend/images/story_bg_rare.png');"></div>
        <div class="scrolly-bg" id="bg-6" style="background-image: url('/frontend/images/story_bg_innovation.png');"></div>
        <div class="scrolly-bg" id="bg-7" style="background-image: url('/frontend/images/story_bg_promise.png');"></div>
        <div class="scrolly-overlay"></div>
    </div>

    <div class="scrolly-watermark" id="watermark">01</div>

    <div class="scrolly-pagination">
        <div class="scrolly-dot active" id="dot-1"></div>
        <div class="scrolly-dot" id="dot-2"></div>
        <div class="scrolly-dot" id="dot-3"></div>
        <div class="scrolly-dot" id="dot-4"></div>
        <div class="scrolly-dot" id="dot-5"></div>
        <div class="scrolly-dot" id="dot-6"></div>
        <div class="scrolly-dot" id="dot-7"></div>
    </div>

    <!-- Scrolling Content -->
    <div class="scrolly-content">
        
        <div class="scrolly-section" id="section-1">
            <div class="scrolly-text-box" id="text-1">
                <h4>01. The Discovery</h4>
                <h2>A Miracle in the Dark...</h2>
                <p>Every legendary diamond begins its journey deep within the earth. For billions of years, under immense pressure, nature forms perfection in the dark. At Lexoria, we source only the absolute finest of these ancient miracles.</p>
            </div>
        </div>

        <div class="scrolly-section" id="section-2">
            <div class="scrolly-text-box" id="text-2">
                <h4>02. The Artistry</h4>
                <h2>Decades of Mastery</h2>
                <p>A diamond is only as magnificent as the hands that cut it. Our master artisans bring decades of inherited knowledge to the workbench, meticulously studying each rough stone before the first cut is ever made. It is a sacred process of revealing light.</p>
            </div>
        </div>

        <div class="scrolly-section" id="section-3">
            <div class="scrolly-text-box" id="text-3">
                <h4>03. The Vision</h4>
                <h2>Unrivaled Brilliance</h2>
                <p>We do not compromise. The Lexoria standard demands flawless clarity, perfect symmetry, and a cut so precise it bends light into pure fire. When you behold a Lexoria solitaire, you are witnessing the pinnacle of gemological achievement.</p>
            </div>
        </div>

        <div class="scrolly-section" id="section-4">
            <div class="scrolly-text-box" id="text-4">
                <h4>04. The Legacy</h4>
                <h2>Your Story Continues</h2>
                <p>We are not just selling diamonds; we are forging heirlooms. As you step into the world of Lexoria, you become part of a grand tradition of luxury, trust, and timeless elegance that will be passed down for generations to come.</p>
            </div>
        </div>

        <div class="scrolly-section" id="section-5">
            <div class="scrolly-text-box" id="text-5">
                <h4>05. The Rare Collection</h4>
                <h2>Nature's Rarest Wonders</h2>
                <p>Beyond our flawless whites lies the pinnacle of exclusivity. Our private vault holds an incredibly curated selection of intensely colored diamonds, from majestic fancy pinks to deep ocean blues, found only once in a lifetime.</p>
            </div>
        </div>

        <div class="scrolly-section" id="section-6">
            <div class="scrolly-text-box" id="text-6">
                <h4>06. The Innovation</h4>
                <h2>Precision Meets Passion</h2>
                <p>Our commitment to absolute perfection requires tools that push the boundaries of science. We combine state-of-the-art laser faceting technology with the soul of old-world artisanal crafting, achieving light performance previously thought impossible.</p>
            </div>
        </div>

        <div class="scrolly-section" id="section-7" style="padding-bottom: 200px;">
            <div class="scrolly-text-box" id="text-7">
                <h4>07. The Promise</h4>
                <h2>Eternity Guaranteed</h2>
                <p>A Lexoria diamond is a sacred promise. Each masterpiece comes enshrined in our high-security vault displays with a lifetime warranty, 100% ethical sourcing certification, and a commitment to protecting the environment that gave us these treasures.</p>
            </div>
        </div>
        
    </div>
</div>

<style>
/* Ultra-Modern Horizontal Scroll Gallery */
.horizontal-scroll-wrapper {
    width: 100%;
    height: 100vh;
    background: #000;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
}
.horizontal-track {
    display: flex;
    height: 70vh;
    padding-left: 15vw; /* Start with an offset */
}
.horizontal-card {
    width: 70vw;
    height: 100%;
    flex-shrink: 0;
    margin-right: 15vw;
    position: relative;
    display: flex;
    align-items: center;
    background: #050505;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid rgba(201, 169, 110, 0.1);
    box-shadow: 0 30px 60px rgba(0,0,0,0.8);
}
.hc-image-wrap {
    width: 55%;
    height: 100%;
    position: relative;
    overflow: hidden;
}
.hc-image {
    width: 130%; /* Extra width for horizontal parallax */
    height: 100%;
    object-fit: cover;
    transform: translateX(0);
}
.hc-content {
    width: 45%;
    padding: 60px;
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.hc-num {
    font-size: 10rem;
    font-family: 'Playfair Display', serif;
    color: transparent;
    -webkit-text-stroke: 1px rgba(201, 169, 110, 0.15);
    position: absolute;
    top: -20px; right: 20px;
    z-index: 0;
    line-height: 1;
}
.hc-content h3 {
    font-family: 'Playfair Display', serif;
    font-size: 3.5rem;
    color: var(--brand-gold, #c9a96e);
    margin-bottom: 25px;
    position: relative;
    z-index: 2;
}
.hc-content p {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.7);
    line-height: 1.9;
    position: relative;
    z-index: 2;
}

/* Alternate Layout for Even Cards */
.horizontal-card:nth-child(even) {
    flex-direction: row-reverse;
}
.horizontal-card:nth-child(even) .hc-num {
    right: auto; left: 20px;
}
</style>

<section id="horizontalSection" style="position: relative; z-index: 10;">
    <div style="text-align: center; padding-top: 100px; background: #000;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 4rem; color: var(--brand-gold, #c9a96e);">The Diamond Journey</h2>
        <p style="color: rgba(255,255,255,0.5); font-style: italic; font-size: 1.2rem; margin-top: 10px;">Scroll down to slide through our process.</p>
    </div>

    <div class="horizontal-scroll-wrapper" id="horizontalWrapper">
        <div class="horizontal-track" id="horizontalTrack">
            
            <div class="horizontal-card hc-1">
                <div class="hc-image-wrap">
                    <img src="/frontend/images/story_bg_discovery.png" class="hc-image" alt="Sourcing">
                </div>
                <div class="hc-content">
                    <span class="hc-num">01</span>
                    <h3>The Sourcing</h3>
                    <p>Our journey begins deep within the earth. We travel to the most exclusive, ethically-run mines to hand-select only the top 1% of raw, uncut stones. Every diamond must meet our uncompromising standards before it is even considered for the Lexoria name.</p>
                </div>
            </div>
            
            <div class="horizontal-card hc-2">
                <div class="hc-image-wrap">
                    <img src="/frontend/images/story_bg_artistry.png" class="hc-image" alt="The Craft">
                </div>
                <div class="hc-content">
                    <span class="hc-num">02</span>
                    <h3>The Craft</h3>
                    <p>A diamond is only as beautiful as the hands that shape it. Our master artisans spend months studying a single stone, mapping its crystalline structure to plan the perfect cut. This meticulous process ensures the absolute maximum yield of fire and brilliance.</p>
                </div>
            </div>
            
            <div class="horizontal-card hc-3">
                <div class="hc-image-wrap">
                    <img src="/frontend/images/story_bg_vision.png" class="hc-image" alt="The Cut">
                </div>
                <div class="hc-content">
                    <span class="hc-num">03</span>
                    <h3>The Cut</h3>
                    <p>Using a blend of centuries-old techniques and cutting-edge technology, the diamond is faceted to flawless geometric perfection. Each angle is calculated to capture light and reflect it endlessly, creating the mesmerizing sparkle that Lexoria is famous for.</p>
                </div>
            </div>
            
            <div class="horizontal-card hc-4">
                <div class="hc-image-wrap">
                    <img src="/frontend/images/story_bg_legacy.png" class="hc-image" alt="The Setting">
                </div>
                <div class="hc-content">
                    <span class="hc-num">04</span>
                    <h3>The Setting</h3>
                    <p>The finished diamond is paired with an equally exquisite setting. Whether forged in pure platinum or 18k solid gold, our bespoke settings are designed to elevate the stone, providing a secure, elegant throne for the centerpiece.</p>
                </div>
            </div>
            
            <div class="horizontal-card hc-5">
                <div class="hc-image-wrap">
                    <img src="/frontend/images/catalog_ring_1781772698546.png" class="hc-image" alt="The Heirloom">
                </div>
                <div class="hc-content">
                    <span class="hc-num">05</span>
                    <h3>The Heirloom</h3>
                    <p>A final masterpiece is born. More than just jewelry, a Lexoria diamond is an eternal symbol of love and dedication, presented in our signature box and ready to be passed down through your family for generations to come.</p>
                </div>
            </div>
            
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    gsap.registerPlugin(ScrollTrigger);

    const sections = [1, 2, 3, 4, 5, 6, 7];
    const watermark = document.getElementById('watermark');
    
    // Set initial opacity for first text block immediately so it doesn't wait for scroll
    gsap.set("#text-1", { opacity: 1, y: 0 });

    // Make the first background zoom slowly right from the start
    gsap.to("#bg-1", {
        scale: 1.15,
        ease: "none",
        scrollTrigger: {
            trigger: "#section-1",
            start: "top bottom",
            end: "bottom top",
            scrub: true
        }
    });

    sections.forEach((num) => {
        if (num !== 1) {
            // When section enters, fade in background
            ScrollTrigger.create({
                trigger: `#section-${num}`,
                start: "top 50%", 
                end: "bottom 50%",
                onEnter: () => activateSection(num),
                onEnterBack: () => activateSection(num),
            });
            
            // Also add a listener to go back to previous section
            ScrollTrigger.create({
                trigger: `#section-${num}`,
                start: "top 50%",
                onLeaveBack: () => activateSection(num - 1),
            });

            // Background zoom effect for this section
            gsap.fromTo(`#bg-${num}`, 
                { scale: 1 }, 
                { 
                    scale: 1.15, 
                    ease: "none",
                    scrollTrigger: {
                        trigger: `#section-${num}`,
                        start: "top bottom",
                        end: "bottom top",
                        scrub: true
                    }
                }
            );

            // Animate text block in
            gsap.to(`#text-${num}`, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: `#section-${num}`,
                    start: "top 60%",
                }
            });
        }
    });

    function activateSection(num) {
        if(num < 1 || num > 7) return;
        
        // Crossfade backgrounds
        sections.forEach(n => {
            gsap.to(`#bg-${n}`, { opacity: n === num ? 1 : 0, duration: 1, ease: "power2.inOut" });
            document.getElementById(`dot-${n}`).classList.remove('active');
        });
        
        // Update pagination
        document.getElementById(`dot-${num}`).classList.add('active');
        
        // Update watermark
        watermark.innerText = "0" + num;
        gsap.fromTo(watermark, { opacity: 0, scale: 0.8 }, { opacity: 0.03, scale: 1, duration: 1 });
    }

    // Ultra-Modern Horizontal Scroll Parallax
    let horizontalWrapper = document.getElementById("horizontalWrapper");
    let horizontalTrack = document.getElementById("horizontalTrack");
    
    if (horizontalWrapper && horizontalTrack) {
        let panels = gsap.utils.toArray(".horizontal-card");
        
        // Calculate total scroll distance
        let getToValue = () => -(horizontalTrack.scrollWidth - window.innerWidth);

        gsap.to(panels, {
            xPercent: -100 * (panels.length - 1),
            ease: "none",
            scrollTrigger: {
                trigger: "#horizontalWrapper",
                pin: true,
                scrub: 1,
                end: () => "+=" + horizontalTrack.scrollWidth
            }
        });

        // Parallax effect for the images inside the horizontally scrolling cards
        gsap.utils.toArray(".hc-image").forEach((img, i) => {
            gsap.fromTo(img, 
                { x: "-10%" },
                {
                    x: "10%",
                    ease: "none",
                    scrollTrigger: {
                        trigger: "#horizontalWrapper",
                        scrub: 1,
                        start: "top top",
                        end: () => "+=" + horizontalTrack.scrollWidth
                    }
                }
            );
        });
    }
});
</script>

@include('frontend.footer')
