<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFI - Sports Equipment Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .product-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            border-color: white;
            background-color: rgba(255,255,255,0.1);
        }
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 6px;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .checkbox-container:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .custom-checkbox {
            width: 18px;
            height: 18px;
            border: 1px solid #737373;
            border-radius: 4px;
            appearance: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .custom-checkbox:checked {
            background-color: white;
            border-color: white;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23212121' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
        }
        .nav-link {
            margin-left: 40px; 
        }
        .first-link {
            margin-left: 40px; 
        }
        .my-auto{
            margin-left: 10px;
        }
        .filter-section {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .filter-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            cursor: pointer;
        }
        .filter-arrow {
            transition: transform 0.3s ease;
        }
        .filter-arrow.open {
            transform: rotate(180deg);
        }
        .hidden {
            display: none;
        }
        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            font-size: 1.2rem;
        }
        .price-range-input {
            width: 100%;
            -webkit-appearance: none;
            height: 4px;
            background: #737373;
            border-radius: 2px;
            outline: none;
        }
        .price-range-input::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            background: white;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-neutral-700">
    <div class="flex flex-col items-center pt-5">
        <p class="text-sm text-white underline max-md:max-w-full">
            Многие люди терпят неудачу только потому, что сдаются в двух шагах от успеха.
        </p>

        <hr class="w-full mt-6 border border-neutral-600 max-md:max-w-full" />

        <nav class="flex flex-wrap gap-5 justify-between mt-8 max-w-full text-xl text-white">
        <div class="flex gap-10 items-center max-md:max-w-full">
            <a href="/" class="self-stretch text-5xl font-bold basis-auto max-md:text-4xl">
                PROFI
            </a>
            <a href="/map" class="first-link">Контакты</a>
            <a href="/catalog" class="nav-link">Каталог</a>
            <a href="{{ route('cart') }}" class="nav-link relative">
                Корзина
                <span id="cart-counter" class="absolute -top-2 -right-4 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"
                      style="display: {{ auth()->check() && \App\Http\Controllers\CartController::getCartItemCount() > 0 ? 'flex' : 'none' }}">
                    {{ auth()->check() ? \App\Http\Controllers\CartController::getCartItemCount() : 0 }}
                </span>
            </a>
        </div>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link mt-2.5 hover:text-gray-300">Выйти</button>
                </form>
                <a href="{{ route('profile.edit') }}" class="mt-2.5 hover:text-gray-300">Профиль</a>
            @else
                <a href="{{ route('login') }}" class="nav-link mt-2.5 hover:text-gray-300">Войти</a>
                <a href="{{ route('register') }}" class="mt-2.5 hover:text-gray-300">Зарегистрироваться</a>
            @endauth
        </nav>

        <hr class="w-full mt-7 border border-neutral-600 max-md:max-w-full" />

        <h2 class="mt-20 text-xl font-semibold text-white max-md:mt-10">Каталог</h2>

        <main class="mt-12 w-full max-w-[1502px] max-md:max-w-full text-white">
            <div class="flex gap-5 max-md:flex-col">
                <aside class="w-[25%] max-md:w-full">
                    <form id="filter-form" action="{{ route('catalog') }}" method="GET">
                        <div class="flex flex-col border border-stone-500 rounded-md p-4">
                            <div class="filter-section mb-4">
                                <div class="filter-header" onclick="toggleFilter('categories')">
                                    <h3 class="font-semibold">Категории</h3>
                                    <svg class="filter-arrow w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div id="categories-filters" class="mt-2">
                                    {{-- Динамический вывод категорий из базы данных --}}
                                    @foreach($allCategories as $category)
                                        <label class="checkbox-container">
                                            <input type="checkbox"
                                                   class="custom-checkbox category-filter"
                                                   name="categories[]" {{-- Важно: name[] для отправки массива --}}
                                                   value="{{ $category->id }}" {{-- Используем ID категории --}}
                                                   {{ in_array($category->id, $categoryIds) ? 'checked' : '' }}>
                                            {{-- Пока оставим картинки как есть, но в идеале они тоже должны быть в БД --}}
                                            @if($category->name === 'Ветровки')
                                                <img src="https://i.ibb.co/xSJN9V1C/Vector.png" class="w-6 h-6 object-contain" alt="Ветровки">
                                            @elseif($category->name === 'Кофты и футболки')
                                                <img src="https://i.ibb.co/BKscrw3Q/Group.png" class="w-6 h-10 object-contain" alt="Кофты">
                                            @elseif($category->name === 'Штаны и шорты')
                                                <img src="https://i.ibb.co/Mx7Z3CMC/Group-1.png" class="w-6 h-10 object-contain" alt="Штаны и шорты">
                                            @elseif($category->name === 'Обувь')
                                                <img src="https://i.ibb.co/VckXFkDT/Group-2.png" class="w-8 h-10 object-contain" alt="Обувь">
                                            @elseif($category->name === 'Головные уборы')
                                                <img src="https://i.ibb.co/FkJ6PcrG/Vector-1.png" class="w-6 h-6 object-contain" alt="Головные уборы">
                                            @endif
                                            <span>{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="filter-section mb-4">
                                <div class="filter-header" onclick="toggleFilter('brands')">
                                    <h3 class="font-semibold">Бренды</h3>
                                    <svg class="filter-arrow w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div id="brands-filters" class="mt-2">
                                    @php
                                    
                                        $availableBrands = [
                                            'RedFox', 'Salomon', 'Puma', 'Manto', 'HardTrain',
                                            'HardCore', 'Reebok', 'BadBoy', 'Sitka', 'Tyrtorf'
                                        ];
                                    @endphp
                                    @foreach($availableBrands as $brandName)
                                        <label class="checkbox-container">
                                            <input type="checkbox"
                                                   class="custom-checkbox brand-filter"
                                                   name="brands[]" 
                                                   value="{{ $brandName }}" 
                                                   {{ in_array($brandName, $brands) ? 'checked' : '' }}>
                                            <span>{{ $brandName }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="filter-section mb-4">
                                <div class="filter-header" onclick="toggleFilter('price')">
                                    <h3 class="font-semibold">Цена</h3>
                                    <svg class="filter-arrow w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div id="price-filters" class="mt-2">
                                    <div class="flex justify-between mb-2">
                                        <span id="min-price">{{ $minPrice }}р</span>
                                        <span id="max-price">{{ $maxPrice }}р</span>
                                    </div>
                                    <input type="range" id="price-range" class="price-range-input"
                                            min="1290" max="12000" value="{{ $maxPrice }}" name="max_price">
                                    <div class="flex justify-between mt-4">
                                        <input type="number" id="price-min-input"
                                                class="bg-neutral-600 text-white w-24 p-1 rounded" placeholder="Мин"
                                                min="1290" max="12000" value="{{ $minPrice }}" name="min_price">
                                        <input type="number" id="price-max-input"
                                                class="bg-neutral-600 text-white w-24 p-1 rounded" placeholder="Макс"
                                                min="1290" max="12000" value="{{ $maxPrice }}" name="max_price">
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="reset-filters" class="w-full mt-4 py-2 bg-neutral-600 hover:bg-neutral-500 rounded-md transition">
                                Сбросить фильтры
                            </button>
                            <button type="submit" class="w-full mt-2 py-2 bg-blue-600 hover:bg-blue-500 rounded-md transition">
                                Применить фильтры
                            </button>
                        </div>
                    </form>
                </aside>

                <section class="w-[65%] max-md:w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5" id="products-grid">
                        @forelse($products as $product)
                            <a href="{{ route('product.show', $product->slug) }}" class="product-item">
                                <article class="product-card flex flex-col p-3 text-xl text-white rounded-md border border-stone-500 h-full">
                                    <img src="{{ $product->image }}"
                                            class="mx-auto aspect-square w-[140px]" alt="{{ $product->name }}">
                                    <h3 class="mt-3 text-center">{{ $product->name }}</h3>
                                    <p class="self-center mt-2">{{ number_format($product->price, 0, '.', ' ') }}р</p>
                                </article>
                            </a>
                        @empty
                            <div class="no-results" id="no-results">
                                По вашему запросу ничего не найдено. Попробуйте изменить параметры фильтрации.
                            </div>
                        @endforelse
                    </div>

                </section>
            </div>
        </main>

        <hr class="w-full mt-20 border border-neutral-600 max-md:mt-10 max-md:max-w-full" />

        <footer class="flex items-center mt-8 w-[912px] max-w-full text-xl text-white">
            <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
            <a href="https://t.me/aksler30" class="mr-[110px]">Наш тг</a>
            <a href="#vk" class="mr-[110px]">Вконтакте</a>
            <a href="mailto:profi38@mail.ru">profi38@mail.ru</a>
        </footer>

        <hr class="w-full mt-7 border border-neutral-600 max-md:max-w-full" />
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filterForm = document.getElementById('filter-form');
            const priceRange = document.getElementById('price-range');
            const priceMinInput = document.getElementById('price-min-input');
            const priceMaxInput = document.getElementById('price-max-input');
            const minPriceDisplay = document.getElementById('min-price');
            const maxPriceDisplay = document.getElementById('max-price');
            const resetFiltersButton = document.getElementById('reset-filters');

            // Эти значения уже установлены в HTML через value="{{ $minPrice }}" и value="{{ $maxPrice }}"
            // priceMinInput.value = {{ $minPrice }}; 
            // priceMaxInput.value = {{ $maxPrice }};
            // priceRange.value = {{ $maxPrice }}; 

            minPriceDisplay.textContent = priceMinInput.value + 'р';
            maxPriceDisplay.textContent = priceMaxInput.value + 'р';

            priceRange.addEventListener('input', function() {
                priceMaxInput.value = this.value;
                maxPriceDisplay.textContent = this.value + 'р';
            });

            priceMinInput.addEventListener('input', function() {
                minPriceDisplay.textContent = this.value + 'р';
            });

            priceMaxInput.addEventListener('input', function() {
                priceRange.value = this.value; 
                maxPriceDisplay.textContent = this.value + 'р';
            });

            resetFiltersButton.addEventListener('click', function() {
                filterForm.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
                priceMinInput.value = priceMinInput.min; 
                priceMaxInput.value = priceMaxInput.max; 
                priceRange.value = priceRange.max;
                minPriceDisplay.textContent = priceMinInput.value + 'р';
                maxPriceDisplay.textContent = priceMaxInput.value + 'р';

                filterForm.submit();
            });

            filterForm.querySelectorAll('input').forEach(input => {
                input.addEventListener('change', function() {;
                });
            });

            function toggleFilter(section) {
                const filterSection = document.getElementById(section + '-filters');
                const arrow = document.querySelector(`[onclick="toggleFilter('${section}')"] .filter-arrow`);
                
                filterSection.classList.toggle('hidden');
                arrow.classList.toggle('open');
            }
            window.toggleFilter = toggleFilter; 

            document.getElementById('categories-filters').classList.add('hidden');
            document.getElementById('brands-filters').classList.add('hidden');
            document.getElementById('price-filters').classList.add('hidden');
        });
    </script>
</body>
</html>