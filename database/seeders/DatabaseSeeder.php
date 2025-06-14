<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Вызываем сидеры в правильном порядке
        $this->call([
            SizeSeeder::class, // Сначала создаем размеры
            CategorySeeder::class, // Затем категории
            ProductsTableSeeder::class, // Потом продукты, которые используют размеры и категории
            // UserSeeder::class, // И другие сидеры
        ]);
    }
}