<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // Получаем параметры фильтрации из запроса
        $categoryIds = $request->input('categories', []);
        $brands = $request->input('brands', []);
        $minPrice = $request->input('min_price', 1290); // Устанавливаем дефолтное значение для минимальной цены
        $maxPrice = $request->input('max_price', 12000); // Устанавливаем дефолтное значение для максимальной цены

        // Начинаем строить запрос к продуктам
        $products = Product::query()
            ->with('category') // Загружаем связанные категории для каждого продукта
            ->whereBetween('price', [$minPrice, $maxPrice]); // Применяем фильтр по цене

        // Применяем фильтр по категориям, если выбраны
        if (!empty($categoryIds)) {
            $products->whereIn('category_id', $categoryIds);
        }

        // Применяем фильтр по брендам, если выбраны
        if (!empty($brands)) {
            $products->whereIn('brand', $brands);
        }

        $products = $products->get(); // Получаем все товары, соответствующие фильтрам

        // Получаем все категории для отображения в фильтрах
        $allCategories = Category::all();

        // Передаём данные в представление
        return view('catalog', compact(
            'products',
            'allCategories',
            'categoryIds',
            'brands',
            'minPrice',
            'maxPrice'
        ));
    }
}