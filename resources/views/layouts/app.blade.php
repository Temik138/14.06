<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PROFI - Sports Equipment Store</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      scroll-behavior: smooth;
      background-color: #404040;
      color: white;
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
    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 25px;
      background-color: #4CAF50;
      color: white;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      z-index: 1000;
      opacity: 0;
      transition: opacity 0.5s ease;
    }
    .notification.show {
      opacity: 1;
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
    <span id="cart-counter" class="absolute -top-2 -right-4 bg-red-500 text-white text-xs rounded-full h-5 w-5 items-center justify-center" 
          style="display: {{ auth()->check() && auth()->user()->cart()->count() > 0 ? 'flex' : 'none' }}">
        {{ auth()->check() ? auth()->user()->cart()->count() : 0 }}
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

    <!-- Здесь будет основной контент страницы -->
    <main>
      {{ $slot }}
    </main>

    <hr class="mt-20 w-full border border-solid border-neutral-600 min-h-px max-md:mt-10 max-md:max-w-full"/>

    <section class="text-center">
      <h3 class="self-center mt-12 text-2xl font-semibold max-md:mt-10 max-md:max-w-full">
        Мечты - это характеристики нашей личности....
      </h3>

      <img
        src="https://i.ibb.co/XZTXVY9Q/image-3.png"
        alt="Decorative image"
        class="first-link object-contain self-center mt-11 max-w-full rounded-md aspect-[1.59] w-[201px] max-md:mt-10"
      />
    </section>

    <hr class="mt-20 w-full border border-solid border-neutral-600 min-h-px max-md:mt-10 max-md:max-w-full"/>

    <footer class="nav-link flex items-center mt-8 w-[912px] max-w-full text-xl">
      <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
      <a href="https://t.me/aksler30" class="mr-[110px] hover:text-gray-300">Наш тг</a>
      <a href="#vk" class="mr-[110px] hover:text-gray-300">Вконтакте</a>
      <a href="mailto:profi38@mail.ru" class="hover:text-gray-300">profi38@mail.ru</a>
    </footer>

    <hr class="w-full mt-7 border border-neutral-600 max-md:max-w-full" />
  </div>
</body>
</html>