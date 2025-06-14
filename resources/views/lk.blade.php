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
    .nav-link {
      margin-left: 495px; 
    }
    .nav-link3 {
      margin-left: 440px; 
    }
    .first-link {
      margin-left: 850px; 
    }
    .nav-link2 {
      margin-left: 40px; 
    }
    .first-link2 {
      margin-left: 40px; 
    }
    .my-auto{
      margin-left: 90px;
    }
  .my-bask{
    margin-left: 130px;
  }
    </style>
    
<header

  class="flex overflow-hidden flex-col pt-5 text-xl text-white bg-neutral-700"
>
  <p class="self-center text-sm underline max-md:max-w-full">
    Многие люди терпят неудачу только потому, что сдаются в двух шагах от
    успеха.
  </p>

  <hr
    class="mt-6 w-full border border-solid border-neutral-600 min-h-px max-md:max-w-full"
  />

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
                    <button type="submit" class="nav-link2 mt-2.5 hover:text-gray-300">Выйти</button>
                </form>
                <a href="{{ route('profile.edit') }}" class="mt-2.5 hover:text-gray-300">Профиль</a>
            @else
                <a href="{{ route('login') }}" class="nav-link2 mt-2.5 hover:text-gray-300">Войти</a>
                <a href="{{ route('register') }}" class="mt-2.5 hover:text-gray-300">Зарегистрироваться</a>
            @endauth
        </nav>

  <hr class="mt-7 w-full border border-solid border-neutral-600 min-h-px max-md:max-w-full"/>

  <h2 class="self-center mt-12 font-semibold max-md:mt-10">Личный кабинет</h2>

  <hr class="mt-12 w-full border border-solid border-neutral-600 min-h-px max-md:mt-10 max-md:max-w-full"/>

  <main  class="flex flex-col items-start self-start mt-20 ml-96 font-semibold max-md:mt-10 max-md:ml-2.5" >
    <section class="self-stretch">
      <p>Имя: Михальченко Артём Евгеньевич</p>
      <p class="mt-8">emal: artem9034artem@mail.ru</p>
      <p class="mt-8">Номер телефона: 89149521050</p>
    </section>
  </main>

  <hr
    class="mt-80 w-full border border-solid border-neutral-600 min-h-px max-md:mt-10 max-md:max-w-full"
  />

  <section class="text-center">
    <h3
      class="self-center mt-12 text-2xl font-semibold max-md:mt-10 max-md:max-w-full"
    >
      Мечты - это характеристики нашей личности....
    </h3>

    <img
      src="https://i.ibb.co/XZTXVY9Q/image-3.png"
      alt="Decorative image"
      class="first-link object-contain self-center mt-11 max-w-full rounded-md aspect-[1.59] w-[201px] max-md:mt-10"
    />
  </section>

  <hr class="mt-20 w-full border border-solid border-neutral-600 min-h-px max-md:mt-10 max-md:max-w-full"/>

  <footer class="nav-link flex items-center mt-8 w-[912px] max-w-full text-xl text-white">
      <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
      <a href="https://t.me/aksler30" class="mr-[110px] hover:text-gray-300">Наш тг</a>
      <a href="#vk" class="mr-[110px] hover:text-gray-300">Вконтакте</a>
      <a href="mailto:profi38@mail.ru hover:text-gray-300">profi38@mail.ru</a>
    </footer>

    <hr class="w-full mt-7 border border-neutral-600 max-md:max-w-full" />
    </footer>
</header>