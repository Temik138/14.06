<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Добавляем поле 'slug'
            // after('name') разместит 'slug' сразу после 'name'
            $table->string('slug')->unique()->after('name');

            // Добавляем поле 'category_id'
            // unsignedBigInteger нужен для внешних ключей, nullable() - чтобы поле могло быть пустым
            // constrained('categories') указывает на таблицу, с которой связана категория
            // onDelete('set null') означает, что если категория удаляется, то category_id у продуктов становится null
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null')->after('slug');

            // Добавляем поле 'brand'
            $table->string('brand')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // В методе down мы отменяем изменения, сделанные в up
            // Удаляем внешний ключ перед удалением колонки
            $table->dropForeign(['category_id']);
            $table->dropColumn(['slug', 'category_id', 'brand']);
        });
    }
};