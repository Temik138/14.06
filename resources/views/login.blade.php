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
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #404040;
      color: white;
    }
    .contact-card {
      transition: all 0.3s ease;
    }
    .contact-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
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
    .footer-link{
      margin-left: 495px;
    }

    /* Стили для формы */
    label {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      margin-top: 10px;
    }

    input {
      border: 1px solid white;
      outline: none;
      background-color: transparent;
      padding: 5px;
      width: 100%;
      text-align: center;
      color: white;
      border-radius: 5px;
      height: 30px;
    }

    input:focus {
      border: 1px solid #ccc;
    }
  </style>
</head>
<body class="bg-neutral-700">
  <div class="flex flex-col items-center pt-5">
    <p class="text-sm text-white underline max-md:max-w-full">
      Многие люди терпят неудачу только потому, что сдаются в двух шагах от успеха.
    </p>

    <hr class="w-full mt-6 border border-neutral-600 max-md:max-w-full" />

    <nav class="flex justify-between items-center mt-8 w-[1193px] max-w-full text-xl text-white">
      <div class="flex items-center gap-[130px]">
      <a href="{{ route('home') }}" class="text-5xl font-bold">PROFI</a>
        <div class="flex gap-[90px]">
          <a href="{{ route('map') }}" class="first-link hover:text-gray-300">Контакты</a>
          <a href="{{ route('login') }}" class="nav-link hover:text-gray-300">Личный кабинет</a>
          <a href="{{ route('catalog') }}" class="nav-link hover:text-gray-300">Каталог</a>
        </div>
      </div>
      <a href="{{ route('cart') }}" class="my-auto hover:text-gray-300">Корзина</a>
    </nav>

    <hr class="w-full mt-7 border border-neutral-600 max-md:max-w-full" />

    <!-- Основное содержимое -->
    <main class="flex flex-col items-center">
      <h2 class="mt-32 text-xl max-md:mt-10 text-white">Авторизация</h2>

      <!-- Вывод ошибок -->
      @if($errors->any())
        <div class="text-red-500 mb-4">
          {{ $errors->first() }}
        </div>
      @endif

      <form class="flex flex-col items-center" method="POST" action="{{ route('login') }}">
        @csrf
        
        <label for="email" class="mt-8 text-white">E-mail</label>
        <input
          id="email"
          type="email"
          name="email"
          value="{{ old('email') }}"
          required
          autofocus
          class="flex shrink-0 mt-1 rounded-md border border-solid border-stone-500 h-[30px] w-[180px] bg-transparent"
        />

        <label for="password" class="mt-5 text-white">Пароль</label>
        <input
          id="password"
          type="password"
          name="password"
          required
          autocomplete="current-password"
          class="flex shrink-0 mt-1 rounded-md border border-solid border-stone-500 h-[30px] w-[180px] bg-transparent"
        />

        <!-- Запомнить меня -->
        <div class="block mt-5">
          <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ml-2 text-sm text-white">Запомнить меня</span>
          </label>
        </div>

        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="mt-3 text-white text-sm hover:text-gray-300">
            Забыли пароль?
          </a>
        @endif

        <button
          type="submit"
          class="flex shrink-0 mt-5 rounded-md bg-zinc-600 bg-opacity-70 h-[35px] w-[140px] items-center justify-center text-white hover:bg-zinc-500 transition-colors"
        >
          Войти
        </button>

        <a href="{{ route('register') }}" class="mt-4 text-xs text-white hover:text-gray-300">
          Нет аккаунта? Зарегистрировать
        </a>
      </form>
    </main>

    <!-- Подвал -->
    <hr class="w-full mt-40 border border-neutral-600 max-md:mt-10 max-md:max-w-full" />

    <footer class="flex items-center mt-8 w-[912px] max-w-full text-xl text-white">
      <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
      <a href="https://t.me/aksler30" class="mr-[110px] hover:text-gray-300">Наш тг</a>
      <a href="#vk" class="mr-[110px] hover:text-gray-300">Вконтакте</a>
      <a href="mailto:profi38@mail.ru" class="hover:text-gray-300">profi38@mail.ru</a>
    </footer>

    <hr class="w-full mt-7 border border-neutral-600 max-md:max-w-full" />
  </div>
</body>
</html>