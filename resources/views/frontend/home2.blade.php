@if($brandStory)
    <!-- Brand Story Section -->
    <section class="story-section">
        <div class="story-container">
            <div class="story-image">
                <img src="{{ str_starts_with($brandStory->image, 'http') ? $brandStory->image : asset($brandStory->image) }}"
                    alt="{{ $brandStory->title }}">
            </div>
            <div class="story-content">
                <span class="section-subtitle">{{ $brandStory->subtitle }}</span>
                <h2 class="section-title">{{ $brandStory->title }}</h2>
                <p>{{ $brandStory->content }}</p>
                <div class="story-stats">
                    @if($brandStory->stat_1_num)
                        <div class="stat-item">
                            <span class="stat-num">{{ $brandStory->stat_1_num }}</span>
                            <span class="stat-label">{{ $brandStory->stat_1_label }}</span>
                        </div>
                    @endif
                    @if($brandStory->stat_2_num)
                        <div class="stat-item">
                            <span class="stat-num">{{ $brandStory->stat_2_num }}</span>
                            <span class="stat-label">{{ $brandStory->stat_2_label }}</span>
                        </div>
                    @endif
                </div>
                <div class="story-actions">
                    <a href="{{ $brandStory->button_link }}" class="btn-read">{{ $brandStory->button_text }}</a>
                    <a href="{{ route('collections') }}" class="btn-link">See Collection &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Collection Teaser -->
    <section class="story-collection-teaser">
        <div class="teaser-container">
            <h3 class="teaser-title">The Heritage Gallery</h3>
            <div class="teaser-grid">
                @foreach($collections->take(4) as $collection)
                    <a href="{{ route('collections.show', $collection->slug) }}" class="teaser-item">
                        <div class="teaser-img">
                            <img src="{{ str_starts_with($collection->image, 'http') ? $collection->image : asset($collection->image) }}"
                                alt="{{ $collection->title }}">
                        </div>
                        <div class="teaser-info">
                            <h4>{{ $collection->title }}</h4>
                            <span>View Selection</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

<style>
    .story-actions {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-top: 30px;
    }

    .btn-read {
        padding: 12px 30px;
        background: transparent;
        color: #ffffff;
        border: 1px solid #333333;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.5s ease;
        position: relative;
    }

    .btn-read::before, .btn-read::after {
        content: 'â—‡';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.6rem;
        color: #333333;
    }
    .btn-read::before { left: 10px; }
    .btn-read::after { right: 10px; }

    .btn-read:hover {
        background: #333333;
        color: #000000;
    }

    .btn-link {
        color: #333333;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.8rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: var(--transition);
        border-bottom: 1px solid transparent;
    }

    .btn-link:hover {
        letter-spacing: 3px;
        border-bottom-color: #333333;
    }

    /* Royal Velvet Palace Interior */
    .story-section {
        padding: 100px 20px;
        background-color: #000000; /* Deep Royal Velvet */
        background-image: 
            radial-gradient(ellipse at bottom right, rgba(0, 0, 0, 0.15) 0%, transparent 60%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%23b58d55' stroke-opacity='0.08' stroke-width='1'/%3E%3C/svg%3E");
        position: relative;
        border-top: 4px solid #333333;
        border-bottom: 4px solid #333333;
    }

    .story-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 80px;
    }

    .story-image {
        flex: 1;
        position: relative;
        padding: 20px 20px 40px 20px; /* Thick sill area at the bottom */
        background: #ffffff; /* Sandstone fort frame structure */
        border-radius: 250px 250px 0 0; /* Massive Jharokha arch */
        border: 3px solid #333333; /* Gold edge */
        box-shadow: 
            0 25px 60px rgba(0, 0, 0, 0.6), 
            inset 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    /* Inner Delicate Gold Tracing */
    .story-image::before {
        content: '';
        position: absolute;
        inset: 8px; /* Perfect inner spacing */
        border: 1px dotted rgba(0, 0, 0, 0.8);
        border-radius: 242px 242px 0 0;
        z-index: 3;
        pointer-events: none;
    }

    /* The Balcony Sill at the Base */
    .story-image::after {
        content: '';
        position: absolute;
        bottom: -5px; /* Jutting out slightly at the bottom */
        left: -15px; /* Protruding sides */
        right: -15px;
        height: 35px; /* Thick marble sill */
        background: #ffffff;
        border: 3px solid #333333;
        z-index: 4;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .story-image img {
        width: 100%;
        height: auto;
        aspect-ratio: 4/5;
        object-fit: cover;
        display: block; /* Removes weird image spacing */
        border-radius: 230px 230px 0 0; /* Inner arch */
        border: 2px solid #333333; /* Inner window rich rim */
        position: relative;
        z-index: 1;
        background: #000000;
        transition: transform 0.8s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .story-image:hover img {
        transform: scale(1.02);
    }

    .story-content {
        flex: 1;
    }

    .section-subtitle {
        font-family: var(--body-font, 'Inter');
        font-size: 0.85rem;
        color: #333333;
        margin-bottom: 10px;
        display: block;
        text-transform: uppercase;
        letter-spacing: 5px;
    }

    .section-title {
        font-family: 'Inter', serif;
        font-size: 3rem;
        color: #ffffff; /* Ivory text */
        font-weight: 500;
        letter-spacing: 1px;
        margin-bottom: 25px;
        line-height: 1.2;
    }

    .story-content p {
        font-family: var(--body-font, 'Inter');
        font-size: 1rem;
        color: #e0d5c1;
        line-height: 1.8;
        margin: 0 0 35px 0;
    }

    .story-stats {
        display: flex;
        gap: 60px;
        margin-bottom: 40px;
        padding-top: 20px;
        border-top: 1px solid rgba(0, 0, 0, 0.3);
    }

    .stat-num {
        display: block;
        font-family: 'Inter', serif;
        font-size: 2.5rem;
        color: #333333;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #e0d5c1;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    /* Teaser Grid (The Heritage Gallery) */
    .story-collection-teaser {
        padding: 80px 0;
        background: #ffffff; /* Ivory sandstone */
        border-bottom: 1px solid rgba(0, 0, 0, 0.3);
    }

    .teaser-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .teaser-title {
        font-family: 'Inter', serif;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 60px;
        position: relative;
        color: #000000;
    }

    .teaser-title::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #333333, transparent);
    }

    .teaser-title::before {
        content: 'â–';
        position: absolute;
        bottom: -26px;
        left: 50%;
        transform: translateX(-50%);
        color: #333333;
        font-size: 0.8rem;
    }

    .teaser-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .teaser-item {
        text-decoration: none;
        color: inherit;
        text-align: center;
        display: block;
        padding-bottom: 10px;
    }

    .teaser-img {
        width: 100%;
        aspect-ratio: 1/1.3;
        overflow: hidden;
        margin-bottom: 20px;
        border: 2px solid #333333;
        border-radius: 100px 100px 0 0; /* Mini Rajwadi windows */
        background: #000000;
        padding: 5px;
        transition: transform 0.5s ease;
    }

    .teaser-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 95px 95px 0 0;
        transition: transform 1.2s ease;
    }

    .teaser-item:hover .teaser-img {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(90, 25, 25, 0.15);
    }

    .teaser-item:hover .teaser-img img {
        transform: scale(1.1);
    }

    .teaser-info h4 {
        font-family: 'Inter', serif;
        font-size: 1.3rem;
        margin-bottom: 8px;
        color: #000000;
    }

    .teaser-info span {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #333333;
        font-weight: 500;
        border-bottom: 1px dotted transparent;
        transition: var(--transition);
        display: inline-block;
        padding-bottom: 2px;
    }

    .teaser-item:hover .teaser-info span {
        border-color: #333333;
    }

    @media (max-width: 991px) {
        .story-section {
            padding: 60px 20px;
        }

        .story-container {
            flex-direction: column;
            gap: 50px;
        }

        .teaser-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
    }

    @media (max-width: 480px) {
        .section-title {
            font-size: 2rem;
        }

        .teaser-info h4 {
            font-size: 1.1rem;
        }

        .story-stats {
            gap: 30px;
        }

        .stat-num {
            font-size: 1.8rem;
        }
    }
</style>


