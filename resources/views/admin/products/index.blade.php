@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Управление товарами</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Добавить товар
            </a>
            <a href="{{ route('admin.categories.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                Управление категориями
            </a>
        </div>


        <div class="overflow-x-auto">
            <table class="min-w-full bg-neutral-600 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-neutral-700 text-white">
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Изображение</th>
                        <th class="py-2 px-4 text-left">Название</th>
                        <th class="py-2 px-4 text-left">Цена</th>
                        <th class="py-2 px-4 text-left">В наличии</th>
                        <th class="py-2 px-4 text-left">Бренд</th>
                        <th class="py-2 px-4 text-left">Категория</th>
                        <th class="py-2 px-4 text-left">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-b border-neutral-500 text-gray-200">
                            <td class="py-2 px-4">{{ $product->id }}</td>
                            <td class="py-2 px-4">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    Нет изображения
                                @endif
                            </td>
                            <td class="py-2 px-4">{{ $product->name }}</td>
                            <td class="py-2 px-4">{{ $product->price }}</td>
                            <td class="py-2 px-4">{{ $product->in_stock ? 'Да' : 'Нет' }}</td>
                            <td class="py-2 px-4">{{ $product->brand ?? 'N/A' }}</td>
                            <td class="py-2 px-4">{{ $product->category->name ?? 'Без категории' }}</td>
                            <td class="py-2 px-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.products.show', $product) }}" class="bg-blue-600 hover:bg-blue-800 text-white px-3 py-1 rounded text-sm">Просмотр</a>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="bg-yellow-600 hover:bg-yellow-800 text-white px-3 py-1 rounded text-sm">Редактировать</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот товар?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-800 text-white px-3 py-1 rounded text-sm">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 px-4 text-center text-gray-400">Товаров пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection