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
.heiht{
    height: 953px;
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
        label {
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
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
      border-radius: 5px; /* Добавляем скругление углов */
    }

    input:focus {
      border: 1px solid #ccc; /* Подсветка при фокусе */
    }
    </style>
</head>
<body>
<div class="flex overflow-hidden flex-col items-center pt-5 bg-neutral-700 heiht">
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
                <a href="/cart" class="nav-link">Корзина</a>
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
        
        <label for="email" class="mt-8 text-white ">E-mail</label>
    <input
        id="email"
        type="email"
        name="email"
        class="flex shrink-0 mt-1 items-center rounded-md text-white border border-solid border-stone-500 h-[30px] w-[180px] bg-transparent"
        required
        autocomplete="email"
        placeholder="email"
    />

    <label for="password" class="mt-5 text-white">Пароль</label>
    <input
        id="password"
        type="password"
        name="password"
        class="flex shrink-0 mt-1 text-white rounded-md border border-solid border-stone-500 h-[30px] w-[180px] bg-transparent"
        required
        autocomplete="new-password"
        placeholder="Пароль"
    />

      
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

    <hr class="mt-40 w-full h-px border border-solid border-neutral-600 max-md:mt-20 max-md:mr-1.5"/>
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