<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Product;
use App\Models\dashboard\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function category()
    {
        $categories = ProductCategory::where('status', 1)
            ->with(['products' => function($q) {
                $q->where('status', 1)->with('mainImage');
            }])
            ->get();

        $allProducts = Product::where('status', 1)
            ->with(['mainImage', 'category'])
            ->latest()
            ->get();

        return view('front.category', compact('categories', 'allProducts'));
    }

    public function categoryShow($slug)
    {
        $category = ProductCategory::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $categories = ProductCategory::where('status', 1)->get();

        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->with(['mainImage', 'category'])
            ->latest()
            ->get();

        return view('front.category-show', compact('category', 'categories', 'products'));
    }

    public function product($slug)
    {
        $product = Product::with('images', 'category')
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $relatedProducts = Product::with('mainImage')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->take(4)
            ->get();

        return view('front.product', compact('product', 'relatedProducts'));
    }
}
