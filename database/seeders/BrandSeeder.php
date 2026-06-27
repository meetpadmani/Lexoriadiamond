<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'De Beers', 'description' => 'Global leader in diamond exploration and mining.'],
            ['name' => 'Tiffany & Co.', 'description' => 'Luxury jewelry and specialty retailer.'],
            ['name' => 'Cartier', 'description' => 'French luxury goods conglomerate.'],
            ['name' => 'Harry Winston', 'description' => 'American luxury jeweler and producer of Swiss timepieces.'],
            ['name' => 'Graff', 'description' => 'British multinational jeweler.'],
            ['name' => 'Chopard', 'description' => 'Swiss manufacturer and retailer of luxury watches, jewelry and accessories.'],
        ];

        foreach ($brands as $index => $brand) {
            Brand::updateOrCreate(
                ['name' => $brand['name']],
                [
                    'description' => $brand['description'],
                    'order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }
}
