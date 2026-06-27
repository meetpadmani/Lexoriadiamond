@include('frontend.navbar')

<style>
    /* Clean Global Layout */
    body {
        background: #fff;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    #main-content {
        width: 100%;
        position: relative;
    }

    section {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    /* Keep internal element animations independent */
</style>

<main id="main-content">
    <div id="hero-showcase">
        @include('frontend.home')
    </div>

    <div id="collections-grid">
        @include('frontend.home1')
    </div>

    <div id="custom-design-section">
        @include('frontend.custom-design-banner')
    </div>

    <div id="new-collection">
        @include('frontend.home5')
    </div>

    <div id="featured-products">
        @include('frontend.home7')
    </div>

    <div id="wedding-marquee">
        @include('frontend.home3')
    </div>

    <div id="watch-shop-cinematic">
        @include('frontend.home4')
    </div>

    <div id="brand-partners">
        @include('frontend.brands')
    </div>

    <div id="image-gallery-cinematic">
        @include('frontend.home6')
    </div>
</main>

@include('frontend.footer')