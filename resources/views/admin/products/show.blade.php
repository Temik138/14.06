@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Детали товара: {{ $product->name }}</h1>

        <div class="bg-neutral-600 p-6 rounded-lg shadow-md text-gray-200">
            <p class="mb-2"><strong>ID:</strong> {{ $product->id }}</p>
            <p class="mb-2"><strong>Название:</strong> {{ $product->name }}</p>
            <p class="mb-2"><strong>Slug:</strong> {{ $product->slug }}</p>
            <p class="mb-2"><strong>Описание:</strong> {{ $product->description }}</p>
            <p class="mb-2"><strong>Цена:</strong> {{ $product->price }} руб.</p>
            @if ($product->image)
                <div class="mb-4">
                    <strong>Изображение:</strong>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mt-2 w-48 h-48 object-cover rounded">
                </div>
            @endif
            <p class="mb-2"><strong>В наличии:</strong> {{ $product->in_stock ? 'Да' : 'Нет' }}</p>
            <p class="mb-2"><strong>Бренд:</strong> {{ $product->brand ?? 'N/A' }}</p>
            <p class="mb-2"><strong>Категория:</strong> {{ $product->category->name ?? 'Без категории' }}</p>
            <p class="mb-2"><strong>Создано:</strong> {{ $product->created_at->format('d.m.Y H:i') }}</p>
            <p class="mb-2"><strong>Обновлено:</strong> {{ $product->updated_at->format('d.m.Y H:i') }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Назад к списку товаров
            </a>
            <a href="{{ route('admin.products.edit', $product) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">
                Редактировать
            </a>
        </div>
    </div>
@endsection