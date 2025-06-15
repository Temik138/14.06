<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFI - Sports Equipment Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .nav-link {
            margin-left: 40px;
        }
        .first-link {
            margin-left: 40px;
        }

        .my-auto {
            margin-left: 10px;
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<div class="flex overflow-hidden flex-col items-center pt-5 bg-neutral-700">
    <header class="w-full flex flex-col items-center">
        <p class="text-sm text-white underline max-md:max-w-full">
            Многие люди терпят неудачу только потому, что сдаются в двух шагах от
            успеха.
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
                {{-- Кнопка "Админ-панель" только для администраторов --}}
                @if (Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="nav-link mt-2.5 hover:text-gray-300">
                        Админ-панель
                    </a>
                @endif
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
    </header>

    <main class="w-full flex flex-col items-center">
        <input
            type="search"
            placeholder="поиск"
            class="px-3 py-1.5 mt-20 max-w-full text-xl font-semibold text-white whitespace-nowrap rounded-md bg-stone-500 w-[700px] max-md:pr-5 max-md:mt-10"
        />

        <section class="w-full flex flex-col items-center">
            <h2 class="mt-20 text-xl font-semibold text-white max-md:mt-10">
                Категории
            </h2>

            <nav
                class="flex flex-nowrap items-center justify-center mt-11 max-w-full text-2xl tracking-wider text-white w-[1400px] max-md:mt-10 overflow-x-auto">
                <a href="#windbreakers" class="flex items-center gap-2 px-4 whitespace-nowrap">
                    <img
                        src="https://i.ibb.co/xSJN9V1C/Vector.png"
                        alt="Ветровки"
                        class="w-10 h-10 object-contain"
                    />
                    <span>ВЕТРОВКИ</span>
                </a>

                <a href="#sweaters" class="flex items-center gap-2 px-4 whitespace-nowrap">
                    <img
                        src="https://i.ibb.co/BKscrw3Q/Group.png"
                        alt="Кофты"
                        class="w-10 h-10 object-contain"
                    />
                    <span>КОФТЫ</span>
                </a>

                <a href="#pants" class="flex items-center gap-2 px-4 whitespace-nowrap">
                    <img
                        src="https://i.ibb.co/Mx7Z3CMC/Group-1.png"
                        alt="Штаны и шорты"
                        class="w-10 h-10 object-contain"
                    />
                    <span>ШТАНЫ И ШОРТЫ</span>
                </a>

                <a href="#shoes" class="flex items-center gap-2 px-4 whitespace-nowrap">
                    <img
                        src="https://i.ibb.co/VckXFkDT/Group-2.png"
                        alt="Обувь"
                        class="w-14 h-10 object-contain"
                    />
                    <span>ОБУВЬ</span>
                </a>

                <a href="#hats" class="flex items-center gap-2 px-4 whitespace-nowrap">
                    <img
                        src="https://i.ibb.co/FkJ6PcrG/Vector-1.png"
                        alt="Головные уборы"
                        class="w-10 h-10 object-contain"
                    />
                    <span>ГОЛОВНЫЕ УБОРЫ</span>
                </a>
            </nav>
        </section>

        <section class="w-full flex flex-col items-center">
            <h2 class="mt-20 text-xl font-semibold text-white max-md:mt-10">
                Немного интересного
            </h2>

            <div class="mt-11 max-w-full w-[1090px] max-md:mt-10">
                <div class="flex gap-5 max-md:flex-col">
                    <article class="w-[33%] max-md:ml-0 max-md:w-full">
                        <div
                            class="product-card flex grow py-10 pr-3 pl-10 text-xl font-semibold rounded-md border border-solid
                hover:border-white hover:bg-neutral-600 cursor-pointer h-full border-neutral-600 text-zinc-400 max-md:pl-5 max-md:mt-10"
                        >
                            <p class="my-auto max-md:-mr-4">
                                Сегодня распродажа<br/>экипировки venum
                            </p>
                            <img
                                src="https://i.ibb.co/VcCLTwdc/venum-no-bg-preview-carve-photos-2.png"
                                alt="Venum equipment"
                                class="object-contain shrink-0 max-w-full aspect-[1.37] w-[166px]"
                            />
                        </div>
                    </article>

                    <article class="ml-5 w-[33%] max-md:ml-0 max-md:w-full">
                        <div
                            class="product-card flex grow gap-5 justify-between px-8 py-14 text-xl font-semibold rounded-md border border-solid
                hover:border-white hover:bg-neutral-600 cursor-pointer h-full border-neutral-600 text-zinc-400 max-md:px-5 max-md:mt-10"
                        >
                            <p>Скоро поступление новой партии!</p>
                            <img
                                src="https://i.ibb.co/gFfNnB6X/Vector-2.png"
                                alt="New arrival"
                                class="object-contain shrink-0 self-start mt-3 max-w-full aspect-[1.25] w-[35%]"
                            />
                        </div>
                    </article>

                    <article class="ml-5 w-[33%] max-md:ml-0 max-md:w-full">
                        <div
                            class="product-card flex grow gap-3.5 p-8 text-xl font-semibold rounded-md border border-solid border-neutral-600
                hover:border-white hover:bg-neutral-600 cursor-pointer h-full text-zinc-400 max-md:px-5 max-md:mt-10"
                        >
                            <p class="my-auto">В нашем магазине был Джейстон Стетхэм</p>
                            <img
                                src="https://i.ibb.co/1tJ4npDQ/1.png"
                                alt="Jason Statham"
                                class="object-contain shrink-0 max-w-full rounded aspect-[0.78] w-[109px]"
                            />
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="w-full flex flex-col items-center">
            <h2
                class="mt-20 ml-5 text-4xl text-white max-md:mt-10 max-md:max-w-full"
            >
                Опыт - лучший учитель, если вы готовы учиться на своих ошибках.
            </h2>

            <div class="mt-8 ml-20 max-w-full w-[823px]">
                <div class="flex gap-5 max-md:flex-col">
                    <div class="w-6/12 max-md:ml-0 max-md:w-full">
                        <img
                            src="https://i.ibb.co/Ng62wQYX/1.png"
                            alt="Sports motivation"
                            class="object-contain grow w-full rounded aspect-[1.5] max-md:mt-10"
                        />
                    </div>
                    <div class="ml-5 w-6/12 max-md:ml-0 max-md:w-full">
                        <p class="text-xl text-white max-md:mt-10">
                            Быть спортсменом – это не только медали и почести, это в
                            первую очередь тяжкий каждодневный труд. Причем с ранних лет и
                            на протяжении всей карьеры. А еще победы и поражения, строгий
                            режим, специальные диеты и постоянное преодоление своей лени,
                            боли и страхов.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full flex flex-col items-center">
            <h2 class="mt-20 text-xl font-semibold text-white max-md:mt-10">
                Горячие предложения
            </h2>

            <div class="flex flex-wrap gap-10 mt-11 max-w-full text-white w-[1187px] max-md:mt-10">
                <a href="product/sorty-manto-muzskie" class="flex-1">
                    <article
                        class="product-card flex flex-col items-center p-3 text-xl rounded-md border border-solid border-stone-500 hover:border-white hover:bg-neutral-600 cursor-pointer h-full">
                        <img
                            src="https://i.ibb.co/gLyFBj9P/pr-21558-1.png"
                            alt="Шорты manto"
                            class="object-contain mx-3.5 aspect-square w-[140px] max-md:mx-2.5"
                        />
                        <h3 class="mt-3 text-center">Шорты manto</h3>
                        <p class="mt-2">3990р</p>
                    </article>
                </a>

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

    <hr class="mt-20 w-full h-px border border-solid border-neutral-600 max-md:mt-20 max-md:mr-1.5"/>
    <footer class="flex items-center mt-8 w-[912px] max-w-full text-xl text-white">
        <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
        <a href="https://t.me/aksler30" class="mr-[110px] hover:text-gray-300">Наш тг</a>
        <a href="#vk" class="mr-[110px] hover:text-gray-300">Вконтакте</a>
        <a href="mailto:profi38@mail.ru hover:text-gray-300">profi38@mail.ru</a>
    </footer>
    <hr class="w-full h-px mt-7 border border-solid border-neutral-600 max-md:mr-1.5"/>
</div>
</body>
</html>

<script>
    (() => {
        const state = {};
        let context = null;
        let nodesToDestroy = [];
        let pendingUpdate = false;

        function destroyAnyNodes() {
            nodesToDestroy.forEach((el) => el.remove());
            nodesToDestroy = [];
        }

        function update() {
            if (pendingUpdate === true) {
                return;
            }
            pendingUpdate = true;

            document.querySelectorAll("[data-el='div-1']").forEach((el) => {
                el.setAttribute("space", 50);
            });

            document.querySelectorAll("[data-el='div-2']").forEach((el) => {
                el.setAttribute("space", 54);
            });

            destroyAnyNodes();
            pendingUpdate = false;
        }

        update();
    })();
</script>