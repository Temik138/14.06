<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFI - Личный кабинет</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #3f3f3f; /* Цвет фона, как на скриншоте */
            color: #ffffff; /* Общий цвет текста */
            scroll-behavior: smooth;
        }
        .nav-link {
            margin-left: 40px;
        }
        .first-link {
            margin-left: 40px;
        }
        .my-auto{
            margin-left: 130px; /* Adjusted to 130px as in your initial request, not 10px from the new header */
        }
        .my-bask{ /* This class was not present in the new header HTML, keeping it for consistency if it's used elsewhere */
            margin-left: 130px;
        }

        /* Стили для полей ввода и кнопки, чтобы они соответствовали скриншоту */
        .custom-input {
            background-color: #3f3f3f; /* Цвет фона, как и основной фон */
            border: 1px solid #666; /* Серая обводка */
            color: #ffffff; /* Белый текст */
            padding: 10px 15px;
            border-radius: 5px;
            width: 300px; /* Фиксированная ширина */
            max-width: 100%;
        }
        .custom-input:focus {
            outline: none;
            border-color: #7a7a7a;
            box-shadow: 0 0 0 1px #7a7a7a;
        }
        .custom-label {
            color: #ffffff; /* Белый цвет для меток */
            font-weight: 500;
            margin-bottom: 5px;
        }
        .custom-button {
            background-color: #525252; /* Серый фон кнопки */
            color: #ffffff; /* Белый текст кнопки */
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .custom-button:hover {
            background-color: #616161; /* Чуть светлее при наведении */
        }
        /* Убираем стандартные стили Laravel Breeze, если они конфликтуют */
        .space-y-6 > div {
            margin-bottom: 20px; /* Отступы между полями */
        }
        .space-y-6 {
            display: flex;
            flex-direction: column;
            gap: 20px; /* Отступы между секциями */
        }

        /* Additional styles from the provided header/footer page */
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

        {{-- Надпись "Личный кабинет" по центру и увеличена --}}
        <h2 class="mt-20 text-3xl font-semibold text-white text-center w-full max-md:mt-10">Личный кабинет</h2>
    </header>

    <main class="flex flex-col items-center py-20">
        <section class="max-w-xl w-full px-4 sm:px-0">
            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="custom-label">{{ __('Имя') }}</label>
                    <input id="name" name="name" type="text" class="mt-1 block w-full custom-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="custom-label">{{ __('E-mail') }}</label>
                    <input id="email" name="email" type="email" class="mt-1 block w-full custom-input" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="custom-label">{{ __('Номер телефона') }}</label>
                    <input id="phone" name="phone" type="text" class="mt-1 block w-full custom-input" value="{{ old('phone', $user->phone) }}" autocomplete="tel" />
                    @error('phone')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="custom-button">{{ __('Оформить') }}</button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-green-500"
                        >{{ __('Сохранено.') }}</p>
                    @endif
                </div>
            </form>
        </section>
    </main>
  <p class="mt-10 text-sm text-white/70 text-center text-xl">Мечты - это характеристики нашей личности....</p>
        {{-- Фото снизу по середине --}}
        <img
            loading="lazy"
            src="https://i.ibb.co/n1r5g81/image.png"
            class="mt-4 w-20 aspect-square mx-auto"
            alt="Small decorative image"
        />

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