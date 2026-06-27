@if($brands->count() > 0)
<section class="royal-partners-section py-5" style="background-color: #000000; background-image: radial-gradient(circle at top, rgba(0, 0, 0, 0.1) 0%, transparent 70%), url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M30 0L60 30L30 60L0 30Z&quot; fill=&quot;none&quot; stroke=&quot;%23b58d55&quot; stroke-opacity=&quot;0.05&quot; stroke-width=&quot;1&quot;/%3E%3C/svg%3E'); border-top: 2px solid #333333; position: relative; overflow: hidden;">
    
    <div class="container">
        <center>
        <div class="text-center mb-5">
            <span class="text-uppercase mb-2 d-block" style="letter-spacing: 5px; font-size: 0.9rem; color: #333333; font-weight: 700;">Global Legacy</span>
            <h2 class="display-4" style="font-family: 'Inter', serif; color: #fff; font-weight: 700; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">Distinguished Collaborations</h2>
            <br>
            <div class="royal-divider mx-auto mt-4"></div>
        </div>

        <div class="brands-royal-marquee">
            <div class="brands-royal-track">
                {{-- Loop for seamless movement --}}
                @php
                    $displayBrands = $brands->concat($brands)->concat($brands)->concat($brands);
                @endphp
                @foreach($displayBrands as $brand)
                <div class="royal-brand-item">
                    <div class="medallion-frame">
                        <div class="medallion-inner">
                            @if($brand->logo)
                                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="medallion-logo">
                            @else
                                <span class="medallion-text">{{ $brand->name }}</span>
                            @endif
                        </div>
                        {{-- Ornamental Glow Ring --}}
                        <div class="medallion-ring"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
    .royal-divider {
        width: 120px;
        height: 1px;
        background: linear-gradient(90deg, transparent, #333333, transparent);
        position: relative;
    }
    
    .royal-divider::after {
        content: 'âœ¦';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #333333;
        font-size: 1rem;
        background: #000000;
        padding: 0 15px;
    }

    .brands-royal-marquee {
        position: relative;
        padding: 60px 0;
        mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
    }

    .brands-royal-track {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        animation: royal-scroll 50s linear infinite;
        width: max-content;
    }

    @keyframes royal-scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-50%)); }
    }

    .royal-brand-item {
        padding: 0 50px;
        perspective: 1000px;
    }

    .medallion-frame {
        width: 170px;
        height: 170px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .medallion-inner {
        width: 140px;
        height: 140px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        z-index: 2;
        transition: all 0.4s ease;
        border: 2px solid #333333;
    }

    .medallion-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 165px;
        height: 165px;
        border: 1px dashed rgba(0, 0, 0, 0.4);
        border-radius: 50%;
        transition: all 0.8s ease;
    }

    .medallion-logo {
        max-width: 100%;
        max-height: 55px;
        filter: grayscale(100%) contrast(1.1);
        opacity: 0.8;
        transition: all 0.4s ease;
    }

    .medallion-text {
        font-family: 'Inter', serif;
        font-weight: 700;
        color: #000000;
        font-size: 1.25rem;
        text-align: center;
        line-height: 1.1;
    }

    .royal-brand-item:hover .medallion-inner {
        transform: scale(1.15) rotate(2deg);
        box-shadow: 0 20px 50px rgba(0,0,0,0.6);
        background: #ffffff;
    }

    .royal-brand-item:hover .medallion-ring {
        transform: translate(-50%, -50%) rotate(180deg) scale(1.2);
        border-color: #333333;
        border-style: solid;
    }

    .royal-brand-item:hover .medallion-logo {
        filter: grayscale(0%);
        opacity: 1;
        transform: scale(1.05);
    }

    /* Pause on interaction */
    .brands-royal-marquee:hover .brands-royal-track {
        animation-play-state: paused;
    }

    /* Decorative Flourishes */
    .royal-partners-section::before, .royal-partners-section::after {
        content: 'â¦';
        position: absolute;
        color: #333333;
        opacity: 0.1;
        font-size: 5rem;
    }
    .royal-partners-section::before { top: 10%; left: 5%; transform: rotate(-45deg); }
    .royal-partners-section::after { bottom: 10%; right: 5%; transform: rotate(135deg); }
</style>
@endif


