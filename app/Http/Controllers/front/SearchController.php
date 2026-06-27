<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Product;
use App\Models\dashboard\ProductCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', '');
        $categoryId = $request->input('category', '');
        $sort = $request->input('sort', 'latest');

        $products = Product::where('status', 1)
            ->with(['mainImage', 'category']);

        if (!empty($query)) {
            $products->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('materials', 'like', "%{$query}%")
                  ->orWhere('color', 'like', "%{$query}%")
                  ->orWhere('sku', 'like', "%{$query}%");
            });
        }

        if (!empty($categoryId)) {
            $products->where('category_id', $categoryId);
        }

        switch ($sort) {
            case 'price_low':
                $products->orderBy('price', 'asc');
                break;
            case 'price_high':
                $products->orderBy('price', 'desc');
                break;
            case 'name':
                $products->orderBy('name', 'asc');
                break;
            default:
                $products->latest();
                break;
        }

        $products = $products->get();
        $categories = ProductCategory::where('status', 1)->get();

        return view('front.search', compact('products', 'categories', 'query', 'categoryId', 'sort'));
    }

    public function live(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $products = Product::where('status', 1)
            ->with(['mainImage', 'category'])
            ->where('name', 'like', "%{$query}%")
            ->take(8)
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->has_discount ? $product->discount_price : $product->price,
                    'original_price' => $product->price,
                    'has_discount' => $product->has_discount,
                    'category' => $product->category->name ?? '',
                    'image' => $product->mainImage ? asset('assets/uploads/products/' . $product->mainImage->image) : 'https://via.placeholder.com/100',
                    'url' => route('front.product', $product->slug),
                ];
            });

        return response()->json($products);
    }
}
