<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::create([
            'name' => 'MacBook Pro',
            'slug' => 'macbook-pro',
            'details' => '15 inch, 1TB HDD, 32GB RAM',
            'price' => 2499.99,
            'shipping_cost' => '29.99',
            'description' => 'Macbook Pro',
            'category_id' => 1,
            'brand_id' => 1,
            'image_path' => 'macbook-pro.png'
        ]);

        Product::create([
            'name' => 'Dell Vostro 3557',
            'slug' => 'vostro-3577',
            'details' => '15 inch, 1TB HDD, 8GB RAM',
            'price' => 1499.99,
            'shipping_cost' => '19.99',
            'description' => 'Dell Vostro 3577',
            'category_id' => 1,
            'brand_id' => 2,
            'image_path' => 'dell-v3557.png'
        ]);

        Product::create([
            'name' => 'iPhone 11 Pro',
            'slug' => 'iPhone-11-Pro',
            'details' => '6.1 inch, 64GB 4GB RAM',
            'price' => 649.99,
            'shipping_cost' => '14.99',
            'description' => 'iPhone 11 Pro',
            'category_id' => 2,
            'brand_id' => 1,
            'image_path' => 'iPhone-11-Pro.png'
        ]);

        Product::create([
            'name' => 'Remax 610D Headset',
            'slug' => 'remax-610d',
            'details' => '6.1 inch, 64GB 4GB RAM',
            'price' => 8.99,
            'shipping_cost' => 1.89,
            'description' => 'Remax 610D Headset',
            'category_id' => 3,
            'brand_id' => 3,
            'image_path' => 'remax-610d.jpg'
        ]);

        Product::create([
            'name' => 'Samsung LED TV',
            'slug' => 'samsung-led-24',
            'details' => '24 inch, LED Display, Resolution 1366x768',
            'price' => 41.99,
            'shipping_cost' => 12.59,
            'description' => 'Samsung LED TV',
            'category_id' => 4,
            'brand_id' => 4,
            'image_path' => 'samsung-led-24.png'
        ]);

        Product::create([
            'name' => 'Samsung Digital Camera',
            'slug' => 'samsung-mv800',
            'details' => '16.1MP, 5x Optical Zoom',
            'price' => 144.99,
            'shipping_cost' => 13.39,
            'description' => 'Samsung Digital Camera',
            'category_id' => 5,
            'brand_id' => 4,
            'image_path' => 'samsung-mv800.jpg'
        ]);

        Product::create([
            'name' => 'Huawei Gr5 2017',
            'slug' => 'gr5-2017',
            'details' => '5.5 inch, 32GB 4 GB RAM',
            'price' => 148.99,
            'shipping_cost' => 6.79,
            'description' => 'Huawei GR5 2017',
            'category_id' => 2,
            'brand_id' => 5,
            'image_path' => 'gr5-2017.jpg'
        ]);
    }
}
