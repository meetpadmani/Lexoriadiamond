<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url> 
        <loc>{{ route('collections') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('customized') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach($collections as $collection)
    @if(!empty($collection->slug))
    <url>
        <loc>{{ route('collections.show', $collection->slug) }}</loc>
        <lastmod>{{ $collection->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endif
    @endforeach

    @foreach($products as $product)
    @if($product->collection && !empty($product->collection->slug) && !empty($product->slug))
    <url>
        <loc>{{ route('collections.product', [$product->collection->slug, $product->slug]) }}</loc>
        <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endif
    @endforeach

    @foreach($posts as $post)
    @if(!empty($post->slug))
    <url>
        <loc>{{ route('blog.show', $post->slug) }}</loc>
        <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endif
    @endforeach
</urlset>
