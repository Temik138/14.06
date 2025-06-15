@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Управление категориями</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Добавить категорию
            </a>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                К товарам
            </a>
        </div>


        <div class="overflow-x-auto">
            <table class="min-w-full bg-neutral-600 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-neutral-700 text-white">
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Название</th>
                        <th class="py-2 px-4 text-left">Slug</th>
                        <th class="py-2 px-4 text-left">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-b border-neutral-500 text-gray-200">
                            <td class="py-2 px-4">{{ $category->id }}</td>
                            <td class="py-2 px-4">{{ $category->name }}</td>
                            <td class="py-2 px-4">{{ $category->slug }}</td>
                            <td class="py-2 px-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.categories.show', $category) }}" class="bg-blue-600 hover:bg-blue-800 text-white px-3 py-1 rounded text-sm">Просмотр</a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="bg-yellow-600 hover:bg-yellow-800 text-white px-3 py-1 rounded text-sm">Редактировать</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить эту категорию? Все товары, связанные с ней, будут без категории.');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-800 text-white px-3 py-1 rounded text-sm">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-4 text-center text-gray-400">Категорий пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection