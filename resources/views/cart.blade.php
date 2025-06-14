<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PROFI - Спортивные товары</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #404040;
      color: white;
    }
    .product-item {
      transition: all 0.3s ease;
    }
    .product-item:hover {
      background-color: rgba(255,255,255,0.05);
    }
    .quantity-control {
      background-color: rgba(255,255,255,0.1);
      border-radius: 6px;
    }
    .checkout-btn {
      transition: all 0.3s ease;
    }
    .checkout-btn:hover {
      background-color: rgba(255,255,255,0.2);
      transform: translateY(-2px);
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
    .footer-link{
      margin-left: 495px;
    }
    .mr-count{
      margin-right: 120px;
    }
    .product-image {
      border: 2px solid rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      padding: 4px;
      background-color: rgba(255, 255, 255, 0.05);
      transition: all 0.3s ease;
    }
    .product-image:hover {
      border-color: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }
    .remove-btn {
      transition: all 0.2s ease;
      opacity: 0.7;
    }
    .remove-btn:hover {
      opacity: 1;
      color: #f87171;
    }
    .summary-item {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
    }
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
    /* Для Firefox */
    input[type="number"] {
      -moz-appearance: textfield;
    }
    
    .quantity-btn {
      transition: background-color 0.2s ease;
    }
  </style>
</head>
<body class="bg-neutral-700 pt-5 ">
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

  <!-- Основное содержимое -->
  <main class="bg-neutral-700 pb-20">
    <div class="container mx-auto px-4">
        <h2 class="text-xl font-semibold text-white text-center mt-10 md:mt-20">Корзина</h2>
        
        @if($isEmpty)
            <!-- Сообщение о пустой корзине -->
            <div class="text-center mt-10 p-4 bg-neutral-600 rounded-lg">
                <p class="text-lg">Ваша корзина пуста</p>
                <a href="/catalog" class="inline-block mt-4 px-6 py-2 bg-zinc-600 bg-opacity-70 rounded-md hover:bg-opacity-80 transition">Перейти в каталог</a>
            </div>
        @else
            <!-- Заголовки таблицы -->
            <div class="flex justify-between mt-10 text-xs md:text-sm tracking-widest text-white">
                <span class="w-1/2 md:w-2/3">Товар</span>
                <div class="flex justify-between w-1/2 md:w-1/3">
                    <span class="w-1/3 text-center">Цена</span>
                    <span class="w-2/3 text-center">Количество</span>
                </div>
            </div>

            <hr class="w-full mt-1 border border-neutral-600">

            <!-- Список товаров -->
            <div id="cart-items">
                @foreach($cartItems as $item)
<section class="product-item mt-5 p-4 rounded-lg" data-id="{{ $item->id }}">
    <div class="flex flex-col md:flex-row gap-4">
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-2/3">
            <img
                src="{{ $item->product->image }}"
                alt="{{ $item->product->name }}"
                class="product-image w-20 h-24 md:w-24 md:h-28 object-contain"
            />
            <div class="flex flex-col">
                <h3 class="text-lg md:text-xl">{{ $item->product->name }}</h3>
                <p class="mt-2 text-sm md:text-base">Размер: {{ $item->size ?? 'не указан' }}</p> <!-- Отображаем размер -->
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="remove-btn text-M mt-2 text-left md:text-left w-max">Удалить</button>
                </form>
                            </div>
                        </div>
                        <div class="flex justify-between items-center w-full md:w-1/3">
                            <span class="text-base font-semibold w-1/3 text-center">{{ number_format($item->product->price, 0, '', ' ') }} ₽</span>
                            <div class="mr-count flex items-center">
    <!-- Форма для уменьшения -->
    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex">
        @csrf
        @method('PATCH')
        <input type="hidden" name="operation" value="decrease">
        <button type="submit" class="quantity-btn px-3 py-1 rounded-l-md bg-zinc-700 hover:bg-zinc-600 transition">-</button>
    </form>
    
    <!-- Поле с количеством -->
    <span class="w-12 text-center bg-zinc-600 bg-opacity-70 py-1">{{ $item->quantity }}</span>
    
    <!-- Форма для увеличения -->
    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex">
        @csrf
        @method('PATCH')
        <input type="hidden" name="operation" value="increase">
        <button type="submit" class="quantity-btn px-3 py-1 rounded-r-md bg-zinc-700 hover:bg-zinc-600 transition">+</button>
    </form>
</div>
                        </div>
                    </div>
                </section>
                <hr class="w-full mt-4 border border-neutral-600">
                @endforeach
            </div>

            <!-- Итоговая сумма -->
            <div class="mt-8 p-4 bg-neutral-600 bg-opacity-50 rounded-lg">
                <div class="summary-item">
                    <span>Товары ({{ $itemsCount }})</span>
                    <span>{{ number_format($total, 0, '', ' ') }} ₽</span>
                </div>
                <div class="summary-item">
                    <span>Доставка</span>
                    <span>Бесплатно</span>
                </div>
                <hr class="w-full my-2 border border-neutral-600">
                <div class="summary-item text-lg font-semibold">
                    <span>Итого</span>
                    <span>{{ number_format($total, 0, '', ' ') }} ₽</span>
                </div>
            </div>

            <!-- Кнопка оформления -->
            <div class="flex justify-center mt-10">
                    <button type="submit" class="checkout-btn px-6 py-4 text-base mt-10 font-semibold text-white rounded-md bg-zinc-600 bg-opacity-70 w-full md:w-40">
                        Оформить
                    </button>
            </div>
        @endif
    </div>
</main>

  <footer class="bg-neutral-700">
    <hr class="w-full border border-neutral-600 max-md:mt-10 max-md:max-w-full" />

    <div class="footer-link flex items-center mt-8 w-[912px] max-w-full text-xl text-white">
      <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
      <a href="https://t.me/aksler30" class="mr-[110px]">Наш тг</a>
      <a href="#vk" class="mr-[110px]">Вконтакте</a>
      <a href="mailto:profi38@mail.ru">profi38@mail.ru</a>
    </div>

    <hr class="w-full mt-7 border border-neutral-600 max-md:max-w-full" />
  </footer>
</body>
</html>