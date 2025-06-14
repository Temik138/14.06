<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size; // Импортируем модель Size
use App\Models\ProductImage; // Импортируем модель ProductImage
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Product::truncate();
        Category::truncate();
        ProductImage::truncate(); // Очищаем таблицу изображений
        // Size::truncate(); // Эту строку лучше убрать, так как SizeSeeder должен заботиться об очистке и создании размеров.

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- Шаг 1: Создаем категории ---
        $categories = [
            'Ветровки',
            'Кофты и футболки',
            'Штаны и шорты',
            'Обувь',
            'Головные уборы',
        ];

        $categoryModels = [];
        foreach ($categories as $categoryName) {
            $categoryModels[$categoryName] = Category::create(['name' => $categoryName]);
        }

        // --- Шаг 2: Определяем размеры, которые будут использоваться ---
        // Эти размеры должны быть созданы в SizeSeeder.
        // Мы их получаем, чтобы привязать к продуктам по ID.
        $sizeS = Size::where('name', 'S')->first();
        $sizeM = Size::where('name', 'M')->first();
        $sizeL = Size::where('name', 'L')->first();
        $sizeXL = Size::where('name', 'XL')->first();
        $sizeXXL = Size::where('name', 'XXL')->first();
        $sizeXS = Size::where('name', 'XS')->first();
        $size40 = Size::where('name', '40')->first();
        $size41 = Size::where('name', '41')->first();
        $size42 = Size::where('name', '42')->first();
        $size43 = Size::where('name', '43')->first();
        $size44 = Size::where('name', '44')->first();
        $sizeOS = Size::where('name', 'OS')->first(); // One Size, для головных уборов


        // --- Шаг 3: Определяем данные продуктов, включая изображения и размеры ---
        $productsData = [
            [
                'name' => 'Куртка RedFox',
                'description' => 'Куртка спортивного дизайна из трехслойного материала Softshell с мембраной 10 000 мм и водоотталкивающей пропиткой.',
                'main_image' => 'https://i.ibb.co/dwtrJZ3K/redfox-no-bg-preview-carve-photos-1.png',
                'images' => [ // Дополнительные изображения
                    'https://i.ibb.co/k2n32R4/redfox-no-bg-preview-carve-photos-2.png',
                    'https://i.ibb.co/51v1z7K/redfox-no-bg-preview-carve-photos-3.png',
                ],
                'price' => 10900,
                'in_stock' => true,
                'brand' => 'RedFox',
                'category' => 'Ветровки',
                'sizes' => [$sizeS, $sizeM, $sizeL, $sizeXL], // Передаем объекты размеров
            ],
            [
                'name' => 'Кроссовки Salomon мужские',
                'description' => 'Система пластиковых «крыльев» по бокам верха обуви. Поддерживает стопу, защищает от пронации и супинации, исключает растягивание верха обуви в сырую погоду и увеличивает срок её службы. Водостойкая, ветрозащитная и паропроницаемая мембрана. Микропористая структура не пропускает капли воды снаружи, в то время как молекулы пота свободно выводятся сквозь мембрану.',
                'main_image' => 'https://i.ibb.co/zWFg80MV/salomon-2-no-bg-preview-carve-photos.png',
                'images' => [
                    'https://i.ibb.co/xS0jbkX5/salomon-no-bg-preview-carve-photos-1.png', // Дополнительные изображения
                    'https://i.ibb.co/s9fYLWRR/puma-no-bg-preview-carve-photos-1.png',
                ],
                'price' => 8700,
                'in_stock' => true,
                'brand' => 'Salomon',
                'category' => 'Обувь',
                'sizes' => [$size40, $size41, $size42, $size43, $size44],
            ],
            [
                'name' => 'Шорты Puma',
                'description' => 'Шорты puma помогут вам достичь наилучших результатов. Шорты оснащены технологией отвода влаги, чтобы вы оставались сухими, имеют светоотражающую графику для повышения безопасности и сетчатую вставку для улучшения воздухопроницаемости.',
                'main_image' => 'https://i.ibb.co/s9fYLWRR/puma-no-bg-preview-carve-photos-1.png',
                'images' => [
                    'https://i.ibb.co/jgh123h/puma-no-bg-preview-carve-photos-2.png', // Пример
                ],
                'price' => 3200,
                'in_stock' => true,
                'brand' => 'Puma',
                'category' => 'Штаны и шорты',
                'sizes' => [$sizeS, $sizeM, $sizeL, $sizeXL],
            ],
            [
                'name' => 'Футболка Manto',
                'description' => 'Тренировочная футболка Manto Logo. Разработана для тренировок любого уровня интенсивности. Мягкая, приятная на ощупь. Изготовлена из сверхлёгкого материала. Использованы экологически чистые красители.',
                'main_image' => 'https://i.ibb.co/vvjfSzGy/pr-22239-1.png',
                'images' => [
                    'https://i.ibb.co/Q7sjS51w/pr-22239-2.png',
                    'https://i.ibb.co/N6n1K42S/pr-22239-3.png',
                ],
                'price' => 3200,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Кофты и футболки',
                'sizes' => [$sizeXS, $sizeS, $sizeM, $sizeL, $sizeXL, $sizeXXL],
            ],
            [
                'name' => 'Кепка Manto',
                'description' => 'Бейсболка Manto Logo Classic Black. Размер регулируется застёжкой. Состав: 80% хлопок, 20% полиэстер.',
                'main_image' => 'https://i.ibb.co/4GcQpD3/pr-22768-1.png',
                'images' => [
                    'https://i.ibb.co/k5p8s5Z/pr-22768-2.png',
                ],
                'price' => 2100,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Головные уборы',
                'sizes' => [$sizeOS],
            ],
            [
                'name' => 'Кофта HardTrain',
                'description' => 'Худи Hardcore Training х Ground Shark The Moment of Truth. Коллаборация иллюстратора John Connell, автора проекта Ground Shark и производителя спортивной экипировки Hardcore Training. Мир - это не солнышко с радугой, говорит нам бойцовский пёс с очередной футболки от НСТ.',
                'main_image' => 'https://i.ibb.co/dsVx06Q5/pr-20895-2.png',
                'images' => [
                    'https://i.ibb.co/Y2B766R/pr-20895-1.png',
                ],
                'price' => 5800,
                'in_stock' => true,
                'brand' => 'HardTrain',
                'category' => 'Кофты и футболки',
                'sizes' => [$sizeS, $sizeM, $sizeL, $sizeXL],
            ],
            [
                'name' => 'Кофта HardCore',
                'description' => 'Худи Hardcore Training Helmet Black. Кофта с капюшоном. Выполнена кофта из плотного, но при этом мягкого материала. Широкие манжеты дают хорошее прилегание рукавов к рукам. Большой карман-кенгуру. Качественная вышивка.',
                'main_image' => 'https://i.ibb.co/8nBdz6Gz/pr-21606-2.png',
                'images' => [
                    'https://i.ibb.co/QY74678/pr-21606-1.png',
                ],
                'price' => 5800,
                'in_stock' => true,
                'brand' => 'HardCore',
                'category' => 'Кофты и футболки',
                'sizes' => [$sizeS, $sizeM, $sizeL, $sizeXL, $sizeXXL],
            ],
            [
                'name' => 'Кроссовки Tyr Torf',
                'description' => 'Кроссовки для фитнеса Tyr Turf Trainer 544. В кроссфите очень важно иметь качественную и удобную обувь, которая бы обеспечивала комфорт и безопасность во время самых сложных упражнений. Кроссовки Tyr Turf Trainer разработаны специально для функциональных тренировок и кроссфита (и в зале, и на улице). Изготовлены из высококачественных материалов.',
                'main_image' => 'https://i.ibb.co/N26qBysV/pr-22721-1.png',
                'images' => [
                    'https://i.ibb.co/G9t0h6Y/pr-22721-2.png',
                ],
                'price' => 12000,
                'in_stock' => true,
                'brand' => 'Tyrtorf',
                'category' => 'Обувь',
                'sizes' => [$size40, $size41, $size42, $size43, $size44],
            ],
            [
                'name' => 'Шапка Manto',
                'description' => 'Шапка Manto Classic Black. Зимний головной убор классической конструкции с широким подворотом. Материал характеризуется мягкостью и комфортным прилеганием. Размер - универсальный. Состав: 100% акрил.',
                'main_image' => 'https://i.ibb.co/LXhr2LgF/pr-22767-1-no-bg-preview-carve-photos.png',
                'images' => [
                    'https://i.ibb.co/k5p8s5Z/pr-22768-2.png', // Можно использовать ту же, что и для кепки
                ],
                'price' => 2300,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Головные уборы',
                'sizes' => [$sizeOS],
            ],
            [
                'name' => 'Штаны HardCore',
                'description' => 'Детские спортивные штаны Hardcore Training Doodles. Лёгкие и стильные джоггеры для тренировочного процесса и прогулок. Выполнены штаны из мягкого и дышащего материала. Зауженный крой в нижней части брюк. Несколько карманов по бокам. Удобная посадка на поясе. В нижней части присутствуют манжеты. Использованы только экологически чистые краски.',
                'main_image' => 'https://i.ibb.co/p6TWz3sz/pr-17494-1.png',
                'images' => [
                    'https://i.ibb.co/q1z6f4D/pr-17494-2.png',
                ],
                'price' => 5290,
                'in_stock' => true,
                'brand' => 'HardCore',
                'category' => 'Штаны и шорты',
                'sizes' => [$sizeS, $sizeM, $sizeL, $sizeXL],
            ],
            [
                'name' => 'Штаны Manto',
                'description' => 'Летние лёгкие спортивные штаны Manto Classic Black. Отлично подойдут и для тренировок, и в качестве прогулочного варианта в тёплое время года. На бедрах штаны удерживаются с помощью резинки и шнурка, спрятанного в пояс. Манжеты в нижней части брюк оснащены резинкой. Присутствуют карманы.',
                'main_image' => 'https://i.ibb.co/spkpTmm8/pr-29644-1.png',
                'images' => [
                    'https://i.ibb.co/Wp0z654/pr-29644-2.png',
                ],
                'price' => 4600,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Штаны и шорты',
                'sizes' => [$sizeS, $sizeM, $sizeL, $sizeXL],
            ],
            [
                'name' => 'Шорты Manto мужские',
                'description' => 'Мужские шорты S/Lab Sense 6, разработанные спортсменами и для спортсменов, — удачный выбор для активных тренировок. <br /> Внутренние шорты из материала с технологией 37.5 эффективно отводят влагу и излишки тепла. <br /> Вместительный сетчатый пояс-карман для важных мелочей. <br /> Тянущаяся в 4 направлениях ткань и прямой крой для свободы движений. Присутствуют карманы.',
                'main_image' => 'https://i.ibb.co/gLyFBj9P/pr-21558-1.png',
                'images' => [
                    'https://i.ibb.co/Wp0z654/pr-29644-2.png', // Пример доп изображения
                ],
                'price' => 3990,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Штаны и шорты',
                'sizes' => [$sizeS, $sizeM, $sizeL, $sizeXL],
            ],
            [
                'name' => 'Шорты Salomon женские',
                'description' => 'Спортивные шорты идеальный вариант для занятия спортом в жаркое лето. Представляем Вашему вниманию тренировочные шорты AGILE SHORTS! Многофункциональные шорты выполнены из специальной ткани AdvancedSkin Active Dry, которая отводит влагу и распределяет ее по поверхности, где она быстро испаряется, благодаря этому Вы сохраните сухость и комфорт кожи.',
                'main_image' => 'https://i.ibb.co/F4Z2J4pT/salomon-no-bg-preview-carve-photos-1.png',
                'images' => [
                    'https://i.ibb.co/bRryw9hW/salomon-no-bg-preview-carve-photos-1.png',
                ],
                'price' => 3790,
                'in_stock' => true,
                'brand' => 'Salomon',
                'category' => 'Штаны и шорты',
                'sizes' => [$sizeXS, $sizeS, $sizeM, $sizeL],
            ],
            [
                'name' => 'Тапки Reebok UFC',
                'description' => 'Мужские сланцы Reebok Combat Flip. Традиционные сланцы от Reebok. Замечательный аксессуар для фанатов UFC. Шлепанцы быстро сохнут! Вам не придется тратить время на просушку обуви. Верх модели выполнен из гладкого плотного полимера.',
                'main_image' => 'https://i.ibb.co/FbSSk8Ht/pr-9883-1.png',
                'images' => [
                    'https://i.ibb.co/gW1gY1C/pr-9883-2.png',
                ],
                'price' => 1290,
                'in_stock' => true,
                'brand' => 'Reebok',
                'category' => 'Обувь',
                'sizes' => [$size40, $size41, $size42, $size43, $size44],
            ],
            [
                'name' => 'Ветровка BadBoy',
                'description' => 'Ветровка Bad Boy. Легкая ветровка для повседневного использования. Ветровка тонкая, мягкая, приятная на ощупь. На фронтальной части присутствуют 3 кармана. На спине так же имеется карман. Застёгивается ветровка на молнию.',
                'main_image' => 'https://i.ibb.co/KxYQs4Py/pr-7085-1.png',
                'images' => [
                    'https://i.ibb.co/2Z53y2W/pr-7085-2.png',
                ],
                'price' => 4500,
                'in_stock' => true,
                'brand' => 'BadBoy',
                'category' => 'Ветровки',
                'sizes' => [$sizeM, $sizeL, $sizeXL],
            ],
            [
                'name' => 'Ветровка Sitka',
                'description' => 'Кофта с капюшоном Sitka Traverse Hoody. Ткань из полиэстера с подкладкой из берберского флиса с высоким ворсом. Экологичная ткань из переработанных материалов. Флисовые вставки средней плотности по бокам и в области подмышек для оптимального комфорта и свободы движений. Прочная водоотталкивающая пропитка защищает от небольших осадков и предотвращает намокание ткани.',
                'main_image' => 'https://i.ibb.co/tPJXjBfD/smallpr-21941-3.png',
                'images' => [
                    'https://i.ibb.co/X7Wq1D2/smallpr-21941-1.png',
                    'https://i.ibb.co/nC2y2B0/smallpr-21941-2.png',
                ],
                'price' => 12000,
                'in_stock' => true,
                'brand' => 'Sitka',
                'category' => 'Ветровки',
                'sizes' => [$sizeS, $sizeM, $sizeL, $sizeXL, $sizeXXL],
            ],
        ];

        foreach ($productsData as $data) {
            $product = Product::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']), // Генерируем slug
                'description' => $data['description'],
                'image' => $data['main_image'], // Основное изображение
                'price' => $data['price'],
                'in_stock' => $data['in_stock'],
                'brand' => $data['brand'],
                'category_id' => $categoryModels[$data['category']]->id,
            ]);

            // Привязываем размеры к продукту
            if (!empty($data['sizes'])) {
                $product->sizes()->sync(collect($data['sizes'])->pluck('id'));
            }

            // Добавляем дополнительные изображения
            foreach ($data['images'] as $index => $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $imageUrl,
                    'order' => $index + 1, // Порядок, начиная с 1
                ]);
            }
        }
    }
}