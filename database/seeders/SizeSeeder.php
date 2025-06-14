<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Size::truncate(); // Очищаем таблицу размеров
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $sizes = [
            ['name' => 'XS', 'type' => 'одежда'],
            ['name' => 'S', 'type' => 'одежда'],
            ['name' => 'M', 'type' => 'одежда'],
            ['name' => 'L', 'type' => 'одежда'],
            ['name' => 'XL', 'type' => 'одежда'],
            ['name' => 'XXL', 'type' => 'одежда'],
            ['name' => '40', 'type' => 'обувь'],
            ['name' => '41', 'type' => 'обувь'],
            ['name' => '42', 'type' => 'обувь'],
            ['name' => '43', 'type' => 'обувь'],
            ['name' => '44', 'type' => 'обувь'],
            ['name' => 'OS', 'type' => 'универсальный'], // One Size
        ];

        foreach ($sizes as $sizeData) {
            Size::create($sizeData);
        }
    }
}