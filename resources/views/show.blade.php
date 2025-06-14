<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFI - {{ $product->name ?? 'Товар не найден' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            scroll-behavior: smooth;
        }
        .nav-link {
            margin-left: 40px;
        }
        .first-link {
            margin-left: 40px;
        }
        .my-auto{
            margin-left: 130px;
        }

        .my-bask{
            margin-left: 130px;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .size-option {
            cursor: pointer;
            transition: all 0.2s ease;
            width: 50px;
            text-align: center;
        }
        .size-option.selected {
            background-color: #525252;
        }
        .buy-btn {
            transition: all 0.3s ease;
        }
        .buy-btn:hover {
            background-color: #3f3f3f;
            transform: scale(1.05);
        }
        .size-column {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .small-images {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .small-image {
            width: 100%;
            height: auto;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .small-image:hover {
            opacity: 0.8;
        }
        /* Стили для кнопок количества */
        .quantity-selector {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }
        .quantity-btn {
            background-color: #616161;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 1.2rem;
        }
        .quantity-input {
            width: 50px;
            text-align: center;
            border: none;
            background-color: transparent;
            color: white; /* Установим цвет текста белым */
            -moz-appearance: textfield; /* Убираем стрелки в Firefox */
        }
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body>
<header class="flex overflow-hidden flex-col items-center pt-5 bg-neutral-700">
    <p class="text-sm text-white underline max-md:max-w-full">
        Многие люди терпят неудачу только потому, что сдаются в двух шагах от успеха.
    </p>

    <hr class="self-stretch mt-6 w-full border border-solid border-neutral-600 min-h-px max-md:max-w-full"/>

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

    <hr class="self-stretch mt-7 w-full border border-solid border-neutral-600 min-h-px max-md:max-w-full"/>

    <h2 class="mt-20 text-xl font-semibold text-white max-md:mt-10">Карточка товара</h2>

    <main class="mt-20 max-w-full w-[936px] max-md:mt-10">
        <article class="flex gap-5 max-md:flex-col">
            <section class="w-[56%] max-md:ml-0 max-md:w-full flex">
                <div class="w-full mr-4">
                    <img
                        src="{{ $product->image }}"
                        class="object-cover w-full h-full rounded-md"
                        id="main-image"
                        alt="{{ $product->name }}"
                    />
                </div>

               <div class="small-images w-[30%]">
                    {{-- Основное изображение как первое маленькое --}}
                    <img
                        src="{{ $product->image }}"
                        class="small-image rounded-md"
                        onclick="changeMainImage(this.src)"
                        alt="{{ $product->name }} - Основное изображение"
                    />

                    {{-- Дополнительные изображения --}}
                    @foreach($product->images as $img)
                        <img
                            src="{{ $img->url }}"
                            class="small-image rounded-md"
                            onclick="changeMainImage(this.src)"
                            alt="{{ $product->name }} - Доп. изображение {{ $loop->iteration }}"
                        />
                    @endforeach
                </div>
            </section>

            <section class="ml-5 w-[44%] max-md:ml-0 max-md:w-full">
                <div class="w-full max-md:mt-10">
                    <h3 class="text-2xl font-semibold text-white max-md:mr-1">
                        {{ $product->name }}
                    </h3>
                    <hr class="shrink-0 mt-2 h-px border border-solid border-neutral-600" />

                    <div class="flex gap-1.5 mt-2.5">
                        <div class="flex flex-col items-start">
                            <h4 class="text-xl font-semibold text-white">Размер</h4>

                            <div class="size-column mt-3">
                                @forelse($availableSizes as $size) {{-- Итерируем по объектам Size --}}
                                    <button
                                        class="size-option px-3 py-1 text-sm border text-white border-neutral-600 rounded-md @if($loop->first) selected @endif"
                                        onclick="selectSize(this, '{{ $size->id }}')" {{-- Передаем ID размера --}}
                                        data-size-id="{{ $size->id }}" {{-- Добавляем data-атрибут с ID --}}
                                    >
                                        {{ $size->name }} {{-- Отображаем имя размера --}}
                                    </button>
                                @empty
                                    <p class="text-white/70">Размеры не указаны</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex flex-col grow shrink-0 text-white basis-0 w-fit">
                            <p class="text-sm leading-5">
                                {!! nl2br(e($product->description)) !!} {{-- Описание продукта --}}
                            </p>

                            <form action="{{ route('cart.add') }}" method="POST" class="mt-10 sm:mt-12">
                                @csrf
                                <div class="flex flex-wrap items-center gap-6 sm:gap-8">
                                    <div class="font-rubik-semibold text-4xl sm:text-5xl text-white">{{ $product->price }} ₽</div>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}"> {{-- Скрытое поле для ID продукта --}}
                                    <input type="hidden" name="size_id" id="selected-size-id" value=""> {{-- Скрытое поле для ID выбранного размера --}}
                                </div>

                                <div class="flex items-center mt-4">
                                    <label for="quantity" class="font-rubik-light text-white/80 mr-2 whitespace-nowrap">Количество:</label>
                                    <div class="quantity-selector">
                                        <button type="button" class="quantity-btn minus" onclick="this.nextElementSibling.stepDown()">−</button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="100" aria-label="Количество товара" class="quantity-input">
                                        <button type="button" class="quantity-btn plus" onclick="this.previousElementSibling.stepUp()">+</button>
                                    </div>
                                </div>

                                <button type="submit" class="buy-btn self-center px-10 py-4 max-w-full text-base font-semibold whitespace-nowrap rounded-md bg-zinc-600 bg-opacity-70 w-[260px] max-md:px-5 hover:bg-opacity-90 mt-6">
                                    Добавить в корзину
                                </button>
                            </form>

                            {{-- Блоки для вывода сообщений об успехе или ошибках --}}
                            @if(session('success'))
                                <div class="text-green-500 mt-4">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="text-red-500 mt-4">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </main>

    <section class="w-full flex flex-col items-center">
            <h2 class="mt-20 text-xl font-semibold text-white max-md:mt-10">
                Горячие предложения
            </h2>

            <div class="flex flex-wrap gap-10 mt-11 max-w-full text-white w-[1187px] max-md:mt-10">
                <!-- Карточка 1 -->
                <a href="product/sorty-manto-muzskie" class="flex-1">
                    <article
                        class="product-card flex flex-col items-center p-3 text-xl rounded-md border border-solid border-stone-500 hover:border-white hover:bg-neutral-600 cursor-pointer h-full">
                        <img
                            src="https://i.ibb.co/gLyFBj9P/pr-21558-1.png"
                            alt="Шорты salomon"
                            class="object-contain mx-3.5 aspect-square w-[140px] max-md:mx-2.5"
                        />
                        <h3 class="mt-3 text-center">Шорты manto</h3>
                        <p class="mt-2">3990р</p>
                    </article>
                </a>

                <!-- Карточка 2 -->
                <a href="/product/kurtka-redfox" class="flex-1">
                    <article
                        class="product-card flex flex-col items-center px-6 py-3 text-xl rounded-md border border-solid border-stone-500 hover:border-white hover:bg-neutral-600 cursor-pointer h-full">
                        <img
                            src="https://i.ibb.co/BHX2X4gm/redfox-no-bg-preview-carve-photos-1.png"
                            alt="Куртка RedFox"
                            class="object-contain aspect-square w-[140px] max-md:mx-1.5"
                        />
                        <h3 class="mt-3 text-center">Куртка RedFox</h3>
                        <p class="mt-2">10290р</p>
                    </article>
                </a>

                <!-- Карточка 3 -->
                <a href="/product/krossovki-salomon-muzskie" class="flex-1">
                    <article
                        class="product-card flex flex-col items-center px-3.5 py-3 rounded-md border border-solid border-stone-500 hover:border-white hover:bg-neutral-600 cursor-pointer h-full">
                        <img
                            src="https://i.ibb.co/xS0jbkX5/salomon-no-bg-preview-carve-photos-1.png"
                            alt="Кроссовки salomon"
                            class="object-contain mx-3 aspect-square w-[140px] max-md:mx-2.5"
                        />
                        <h3 class="mt-3 text-base text-center">Кроссовки salomon</h3>
                        <p class="mt-3 text-xl">8700р</p>
                    </article>
                </a>

                <!-- Карточка 4 -->
                <a href="/product/sorty-puma" class="flex-1">
                    <article
                        class="product-card flex flex-col items-center px-6 py-3 text-xl rounded-md border border-solid border-stone-500 hover:border-white hover:bg-neutral-600 cursor-pointer h-full max-md:px-5">
                        <img
                            src="https://i.ibb.co/s9fYLWRR/puma-no-bg-preview-carve-photos-1.png"
                            alt="Шорты puma"
                            class="object-contain aspect-square w-[140px]"
                        />
                        <h3 class="mt-3 text-center">Шорты puma</h3>
                        <p class="mt-2">3200р</p>
                    </article>
                </a>

                <!-- Карточка 5 -->
                <a href="/product/sorty-salomon-zenskie" class="flex-1">
                    <article
                        class="product-card flex flex-col items-center px-4 py-3 rounded-md border border-solid border-stone-500 hover:border-white hover:bg-neutral-600 cursor-pointer h-full">
                        <img
                            src="https://i.ibb.co/bRryw9hW/salomon-no-bg-preview-carve-photos-1.png"
                            alt="Шорты salomon (ж)"
                            class="object-contain mx-2.5 aspect-square w-[140px]"
                        />
                        <h3 class="mt-3 text-base text-center">Шорты salomon (ж)</h3>
                        <p class="mt-3 text-xl">3790р</p>
                    </article>
                </a>
            </div>
        </section>
</main>
<hr class="mt-20 w-full h-px border border-solid border-neutral-600 max-md:mt-20 max-md:mr-1.5" />
<footer class="flex items-center mt-8 w-[912px] max-w-full text-xl text-white">
    <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
    <a href="https://t.me/aksler30" class="mr-[110px] hover:text-gray-300">Наш тг</a>
    <a href="#vk" class="mr-[110px] hover:text-gray-300">Вконтакте</a>
    <a href="mailto:profi38@mail.ru" class="hover:text-gray-300">profi38@mail.ru</a>
</footer>
<hr class="w-full h-px mt-7 border border-solid border-neutral-600 max-md:mr-1.5" />

<script>
    // Инициализация выбранного размера при загрузке страницы
    document.addEventListener('DOMContentLoaded', function() {
        const firstSizeButton = document.querySelector('.size-option');
        if (firstSizeButton) {
            firstSizeButton.classList.add('selected');
            // Здесь мы должны получить data-size-id из кнопки
            document.getElementById('selected-size-id').value = firstSizeButton.dataset.sizeId;
        }
    });

    // Выбор размера
    function selectSize(button, sizeId) {
        // Убираем выделение у всех кнопок размера
        document.querySelectorAll('.size-option').forEach(btn => {
            btn.classList.remove('selected');
        });

        // Добавляем выделение выбранной кнопке
        button.classList.add('selected');

        // Обновляем скрытое поле с выбранным ID размера
        document.getElementById('selected-size-id').value = sizeId;
    }

    // Смена основной фотографии при клике на маленькую
    function changeMainImage(src) {
        document.getElementById('main-image').src = src;
    }
    //     fetch('{{ route('cart.count') }}')

</script>
</body>
</html>