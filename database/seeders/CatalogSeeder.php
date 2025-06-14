<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{

public function run()
{
    $categories = [
        ['name' => 'ветровки', 'slug' => 'windbreakers', 'icon' => 'https://i.ibb.co/xSJN9V1C/Vector.png'],
        ['name' => 'кофты', 'slug' => 'sweaters', 'icon' => 'https://i.ibb.co/BKscrw3Q/Group.png'],
        ['name' => 'штаны', 'slug' => 'pants', 'icon' => 'https://i.ibb.co/Mx7Z3CMC/Group-1.png'],
        ['name' => 'обувь', 'slug' => 'shoes', 'icon' => 'https://i.ibb.co/VckXFkDT/Group-2.png'],
        ['name' => 'головные уборы', 'slug' => 'hats', 'icon' => 'https://i.ibb.co/FkJ6PcrG/Vector-1.png'],
    ];
    
    foreach ($categories as $category) {
        Category::create($category);
    }
    
    $products = [
        [
            'name' => 'Куртка RedFox',
            'slug' => 'kyrredfox',
            'category_id' => 1,
            'price' => 10290,
            'image' => 'https://i.ibb.co/BHX2X4gm/redfox-no-bg-preview-carve-photos-1.png'
        ],
        [
            'name' => 'Кроссовки salomon',
            'slug' => 'krsolomon',
            'category_id' => 4,
            'price' => 8700,
            'image' => 'https://i.ibb.co/xS0jbkX5/salomon-no-bg-preview-carve-photos-1.png'
        ],
        [
            'name' => 'Шорты puma',
            'slug' => 'kyrredfox',
            'category_id' => 3,
            'price' => 3200,
            'image' => 'https://i.ibb.co/BHX2X4gm/redfox-no-bg-preview-carve-photos-1.png'
        ],
    ];
    
    foreach ($products as $product) {
        Product::create($product);
    }
}
}