<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Для работы с сессиями

class CartController extends Controller
{
    /**
     * Метод для добавления товара в корзину.
     * Он получает product_id и size_id из данных POST-запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', // Проверяем, что product_id существует в таблице products
            'quantity' => 'required|integer|min:1',
            'size_id' => 'nullable|exists:sizes,id', // size_id может быть null, но если есть, то должен существовать в таблице sizes
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $sizeId = $request->input('size_id'); // Может быть null, если размер не выбран

        $product = Product::find($productId); // Находим продукт по ID
        if (!$product) {
            return back()->with('error', 'Выбранный товар не найден.');
        }

        $cart = Session::get('cart', []); // Получаем текущую корзину из сессии или пустой массив
        $itemKey = $productId . ($sizeId ? '-' . $sizeId : ''); // Генерируем уникальный ключ для товара (product_id-size_id)

        // Если товар (с таким же размером) уже есть в корзине, увеличиваем количество
        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += $quantity;
        } else {
            // Иначе добавляем новый товар в корзину
            $cart[$itemKey] = [
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
                'size_id' => $sizeId,
                'size_name' => $sizeId ? Size::find($sizeId)->name : null, // Получаем имя размера, если ID предоставлен
            ];
        }

        Session::put('cart', $cart); // Сохраняем обновленную корзину обратно в сессию

        // Перенаправляем на страницу корзины с сообщением об успехе
        return redirect()->route('cart')->with('success', 'Товар успешно добавлен в корзину!');
    }

    /**
     * Метод для отображения содержимого корзины.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sessionCart = Session::get('cart', []); // Получаем корзину из сессии

        $cartItems = [];
        $total = 0;
        $itemsCount = 0;

        foreach ($sessionCart as $itemKey => $itemData) {
            $product = Product::find($itemData['product_id']);

            if ($product) {
                $cartItem = (object) [ // Преобразуем массив в объект для удобства в Blade
                    'id' => $itemKey, // Уникальный ключ для элемента корзины (для удаления/обновления)
                    'product' => (object) [ // Делаем product объектом для удобного доступа в Blade
                        'id' => $product->id,
                        'name' => $product->name,
                        'image' => $product->image,
                        'price' => $product->price,
                    ],
                    'quantity' => $itemData['quantity'],
                    'size' => $itemData['size_name'], // Передаем имя размера
                ];
                $cartItems[] = $cartItem;
                $total += $product->price * $itemData['quantity'];
                $itemsCount += $itemData['quantity'];
            }
            // Если продукт не найден, мы просто не добавляем его в $cartItems,
            // но в этой реализации он останется в сессии, пока не будет явно удален.
            // Для более строгой очистки можно добавить: unset($sessionCart[$itemKey]);
        }

        $isEmpty = empty($cartItems); // Проверяем, пуста ли корзина

        return view('cart', compact('cartItems', 'total', 'itemsCount', 'isEmpty'));
    }

    /**
     * Метод для обновления количества товара в корзине.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $itemKey  Уникальный ключ товара в корзине (product_id-size_id)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $itemKey)
    {
        $request->validate([
            'operation' => 'required|in:increase,decrease',
        ]);

        $cart = Session::get('cart', []);

        if (isset($cart[$itemKey])) {
            if ($request->input('operation') == 'increase') {
                $cart[$itemKey]['quantity']++;
            } elseif ($request->input('operation') == 'decrease') {
                if ($cart[$itemKey]['quantity'] > 1) {
                    $cart[$itemKey]['quantity']--;
                } else {
                    // Если количество станет 0, удаляем товар из корзины
                    unset($cart[$itemKey]);
                }
            }
            Session::put('cart', $cart);
            return back()->with('success', 'Количество товара обновлено.');
        }

        return back()->with('error', 'Товар в корзине не найден.');
    }

    /**
     * Метод для удаления товара из корзины.
     *
     * @param  string  $itemKey  Уникальный ключ товара в корзине (product_id-size_id)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($itemKey)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemKey])) {
            unset($cart[$itemKey]);
            Session::put('cart', $cart);
            return back()->with('success', 'Товар удален из корзины.');
        }

        return back()->with('error', 'Товар в корзине не найден.');
    }

    /**
     * Метод для получения количества товаров в корзине (для AJAX).
     *
     * @return \Illuminate\Http\JsonResponse
     */
     public static function getCartItemCount(): int
    {
        $cart = Session::get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}