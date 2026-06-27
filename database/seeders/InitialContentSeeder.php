<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hero
        \App\Models\Hero::truncate();
        \App\Models\Hero::create([
            'title' => 'Timeless Brilliance',
            'subtitle' => 'Discover the exquisite collection of handcrafted diamonds and fine jewelry that defines elegance and sophistication.',
            'video_url' => 'videos/24571-344258644_medium.mp4',
            'button_1_text' => 'Explore Collection',
            'button_1_link' => '#',
            'button_2_text' => 'Our Story',
            'button_2_link' => '#',
            'is_active' => true
        ]);

        // Collections
        \App\Models\Collection::truncate();
        $collections = [
            [
                'title' => 'Floral Bloom',
                'subtitle' => null,
                'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?q=80&w=1974&auto=format&fit=crop',
                'type' => 'tall',
                'overlay_position' => 'bottom-center',
                'order' => 1
            ],
            [
                'title' => 'Stunning every Ear',
                'subtitle' => 'Ear',
                'image' => 'https://images.unsplash.com/photo-1549439602-43ebca2327af?q=80&w=2070&auto=format&fit=crop',
                'type' => 'half',
                'overlay_position' => 'bottom-right',
                'order' => 2
            ],
            [
                'title' => 'Wedding Gifts',
                'subtitle' => null,
                'image' => 'https://images.unsplash.com/photo-1601121141461-9d6647bca1ed?q=80&w=2070&auto=format&fit=crop',
                'type' => 'half',
                'overlay_position' => 'bottom-right',
                'order' => 3
            ],
            [
                'title' => 'Gold Standard',
                'subtitle' => null,
                'image' => 'https://www.tanishq.co.in/dw/image/v2/BKCK_PRD/on/demandware.static/-/Library-Sites-TanishqSharedLibrary/default/dw04fafb24/homepage/trendingNow/auspicious-trending.jpg',
                'type' => 'tall',
                'overlay_position' => 'bottom-center',
                'order' => 4
            ],
            [
                'title' => 'Ethereal Chains',
                'subtitle' => null,
                'image' => 'https://images.unsplash.com/photo-1512163143273-bde0e3cc7407?q=80&w=2070&auto=format&fit=crop',
                'type' => 'half',
                'overlay_position' => 'bottom-right',
                'order' => 5
            ],
            [
                'title' => 'Solitaire Selection',
                'subtitle' => null,
                'image' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?q=80&w=2070&auto=format&fit=crop',
                'type' => 'half',
                'overlay_position' => 'bottom-right',
                'order' => 6
            ]
        ];

        foreach ($collections as $col) {
            \App\Models\Collection::create($col);
        }

        // Brand Story
        \App\Models\BrandStory::truncate();
        \App\Models\BrandStory::create([
            'subtitle' => 'Our Legacy',
            'title' => 'Handcrafted Excellence Since 1995',
            'content' => 'Every Bhaumik Diamond piece is a testament to our unwavering commitment to perfection. Our master artisans blend decades of tradition with contemporary vision to reveal the inner soul of every gemstone.',
            'image' => 'https://images.unsplash.com/photo-1620608209102-4b63ff4ee791?q=80&w=2070&auto=format&fit=crop',
            'stat_1_num' => '25+',
            'stat_1_label' => 'Years of Mastery',
            'stat_2_num' => '10k+',
            'stat_2_label' => 'Clients Worldwide',
            'button_text' => 'Our Philosophy',
            'button_link' => '#'
        ]);
    }
}
