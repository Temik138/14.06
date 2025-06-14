<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Добавь, если используешь Str::slug в контроллере

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image', // Пока оставляем основное изображение, но в будущем можем убрать
        'in_stock',
        'brand',
        'category_id',
    ];

    // Отношение "один ко многим" для изображений
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Отношение "многие ко многим" для размеров
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    // Отношение "один ко многим" с категориями
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Автоматическое создание slug при сохранении, если его нет
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}