<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;    
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {

        $availableSizes = $product->sizes;

        return view('show', compact('product', 'availableSizes'));
    }

}