@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Детали категории: {{ $category->name }}</h1>

        <div class="bg-neutral-600 p-6 rounded-lg shadow-md text-gray-200">
            <p class="mb-2"><strong>ID:</strong> {{ $category->id }}</p>
            <p class="mb-2"><strong>Название:</strong> {{ $category->name }}</p>
            <p class="mb-2"><strong>Slug:</strong> {{ $category->slug }}</p>
            <p class="mb-2"><strong>Создано:</strong> {{ $category->created_at->format('d.m.Y H:i') }}</p>
            <p class="mb-2"><strong>Обновлено:</strong> {{ $category->updated_at->format('d.m.Y H:i') }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.categories.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Назад к списку категорий
            </a>
            <a href="{{ route('admin.categories.edit', $category) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">
                Редактировать
            </a>
        </div>
    </div>
@endsection