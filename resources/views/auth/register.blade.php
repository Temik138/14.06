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
    .footer-link{
      margin-left: 495px;
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

    <hr class="w-full mt-7 border border-neutral-600 max-md:max-w-full" />
    </header>

    <!-- Основное содержимое -->
    <main class="flex flex-col items-center">
    <h2 class="mt-20 text-xl max-md:mt-10">Регистрация</h2>

    <form class="flex flex-col items-center" method="POST" action="{{ route('register') }}">
    @csrf
    
    <label for="email" class="mt-8 text-white">E-mail</label>
    <input
        id="email"
        type="email"
        name="email"
        class="flex shrink-0 mt-1 rounded-md border border-solid border-stone-500 h-[30px] w-[180px] bg-transparent"
        required
        autocomplete="email"
        placeholder="email"
    />

    <label for="name" class="mt-5 text-white">Имя</label>
    <input
        id="name"
        type="text"
        name="name"
        class="flex shrink-0 mt-1 rounded-md border border-solid border-stone-500 h-[30px] w-[180px] bg-transparent"
        required
        autocomplete="given-name"
        placeholder="Имя"
    />

    <div class="mt-4">
    <label for="phone">Телефон</label>
    <input id="phone"
           type="tel" 
           name="phone" 
           required
           autocomplete="tel" 
           class="flex shrink-0 mt-1 rounded-md border border-solid border-stone-500 h-[30px] w-[180px] bg-transparent text-white"
           placeholder="+7XXXXXXXXXX"
           maxlength="12">
</div>

    <label for="password" class="mt-5 text-white">Пароль</label>
    <input
        id="password"
        type="password"
        name="password"
        class="flex shrink-0 mt-1 rounded-md border border-solid border-stone-500 h-[30px] w-[180px] bg-transparent"
        required
        autocomplete="new-password"
        placeholder="Пароль"
    />

    <label for="password_confirmation" class="mt-5 text-white">Повторите пароль</label>
    <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        class="flex shrink-0 mt-1 rounded-md border border-solid border-stone-500 h-[30px] w-[180px] bg-transparent"
        required
        autocomplete="new-password"
        placeholder="Пароль"
    />
    

    <button
        type="submit"
        class="px-5 py-2.5 mt-5 max-w-full text-base whitespace-nowrap rounded-md bg-zinc-600 bg-opacity-70 w-[140px] hover:bg-zinc-500 transition-colors">
        Регистрация
    </button>
</form>
  </main>

    <!-- Подвал -->
    <hr class=" w-full mt-20 border border-neutral-600 max-md:mt-10 max-md:max-w-full" />

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
document.getElementById('phone').addEventListener('input', function(e) {
    // Сохраняем позицию курсора
    const cursorPosition = e.target.selectionStart;
    
    // Удаляем все символы, кроме цифр и знака +
    let cleanedValue = e.target.value.replace(/[^\d+]/g, '');
    
    // Если нет + в начале, добавляем его
    if (!cleanedValue.startsWith('+')) {
        cleanedValue = '+' + cleanedValue.replace(/\+/g, '');
    }
    
    // Ограничиваем длину номера (максимум 12 символов: + и 11 цифр)
    if (cleanedValue.length > 12) {
        cleanedValue = cleanedValue.substring(0, 12);
    }
    
    // Обновляем значение поля
    e.target.value = cleanedValue;
    
    // Восстанавливаем позицию курсора
    e.target.setSelectionRange(cursorPosition, cursorPosition);
});

// Запрещаем вставку нечисловых символов
document.getElementById('phone').addEventListener('paste', function(e) {
    e.preventDefault();
    const pasteData = e.clipboardData.getData('text/plain').replace(/[^\d+]/g, '');
    document.execCommand('insertText', false, pasteData);
});
</script>

</body>
</html>