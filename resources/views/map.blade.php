<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PROFI - Спортивный магазин</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://api-maps.yandex.ru/2.1/?apikey=ваш_api_ключ&lang=ru_RU" type="text/javascript"></script>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #404040;
      color: white;
    }
    #map {
      width: 100%;
      height: 400px;
    }
    .contact-card {
      transition: all 0.3s ease;
    }
    .contact-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    @media (max-width: 768px) {
      #map {
        height: 300px;
      }
      .flex-col-on-mobile {
        flex-direction: column;
      }
      .w-full-on-mobile {
        width: 100% !important;
      }
      .ml-0-on-mobile {
        margin-left: 0 !important;
      }
      .mt-4-on-mobile {
        margin-top: 1rem !important;
      }
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
    .kont{
        margin-left: 500px;
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
    </header>

    <!-- Основное содержимое -->
    <main class="w-full max-w-6xl px-4 mt-10 md:mt-20">
      <h2 class="kont text-xl font-semibold text-white text-center md:text-left">
        Контакты
      </h2>

      <section class="mt-7">
        <div class="flex flex-col-on-mobile gap-5">
          <!-- Боковая панель с контактами -->
          <aside class="w-full md:w-[26%]">
            <div class="contact-card flex flex-col p-4 text-white border border-stone-500 rounded-md">
              <h3 class="self-center text-2xl">Контакты</h3>
              <hr class="w-full mt-3 border border-stone-500">

              <address class="not-italic mt-4 space-y-4">
                <div class="flex gap-4 items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <p>
                    Санкт-Петербург,<br />
                    Невский пр. 140
                  </p>
                </div>

                <div class="flex gap-4 items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                  </svg>
                  <a href="#telegram" class="hover:text-gray-300">Наш тг</a>
                </div>

                <div class="flex gap-4 items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  <a href="mailto:profi38@mail.ru" class="hover:text-gray-300">profi38@mail.ru</a>
                </div>
              </address>
            </div>
          </aside>

          <!-- Карта -->
          <article class="w-full md:w-[74%] ml-0-on-mobile md:ml-5 mt-4-on-mobile md:mt-0">
            <div class="contact-card flex flex-col p-4 border border-stone-500 rounded-md">
              <h3 class="text-2xl mb-4">Адрес нашего магазина</h3>
              <hr class="w-full mb-4 border border-stone-500">
              <div id="map"></div>
            </div>
          </article>
        </div>
      </section>
    </main>

    <!-- Подвал -->
    <hr class="w-full mt-20 border border-neutral-600 max-md:mt-10 max-md:max-w-full" />

    <footer class="flex items-center mt-8 w-[912px] max-w-full text-xl text-white">
      <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
      <a href="https://t.me/aksler30" class="mr-[110px] hover:text-gray-300">Наш тг</a>
      <a href="#vk" class="mr-[110px] hover:text-gray-300">Вконтакте</a>
      <a href="mailto:profi38@mail.ru hover:text-gray-300">profi38@mail.ru</a>
    </footer>

    <hr class="w-full mt-7 border border-neutral-600 max-md:max-w-full" />
    </footer>
  </div>

  <script>
    // Инициализация карты
    ymaps.ready(init);
    
    function init() {
      const map = new ymaps.Map("map", {
        center: [59.934280, 30.335099], // Координаты Невского пр. 140
        zoom: 15,
        controls: ['zoomControl']
      });
      
      // Добавляем метку
      const placemark = new ymaps.Placemark([59.934280, 30.335099], {
        hintContent: 'PROFI - Спортивный магазин',
        balloonContent: 'Невский пр. 140, Санкт-Петербург'
      }, {
        iconLayout: 'default#image',
        iconImageHref: 'https://cdn-icons-png.flaticon.com/512/484/484167.png',
        iconImageSize: [40, 40],
        iconImageOffset: [-20, -40]
      });
      
      map.geoObjects.add(placemark);
      
      // Адаптация карты под мобильные устройства
      if (window.innerWidth < 768) {
        map.behaviors.disable('drag');
      }
    }
    
    // Обработчик изменения размера окна
    window.addEventListener('resize', function() {
      if (window.innerWidth < 768) {
        document.getElementById('map').style.height = '300px';
      } else {
        document.getElementById('map').style.height = '400px';
      }
    });
  </script>
</body>
</html>