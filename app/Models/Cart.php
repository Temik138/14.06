<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts'; 
    
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'size'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cart()
{
    return $this->hasMany(Cart::class);
}
}