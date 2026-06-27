<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favoriteIds = session()->get('favorites', []);
        $products = Product::with('mainImage', 'category')
            ->whereIn('id', $favoriteIds)
            ->where('status', 1)
            ->get();

        return view('front.favorites', compact('products', 'favoriteIds'));
    }

    public function toggle($id)
    {
        $product = Product::findOrFail($id);
        $favorites = session()->get('favorites', []);

        if (in_array($id, $favorites)) {
            $favorites = array_values(array_diff($favorites, [$id]));
            $added = false;
        } else {
            $favorites[] = $id;
            $added = true;
        }

        session()->put('favorites', $favorites);

        return response()->json([
            'success' => true,
            'added' => $added,
            'count' => count($favorites),
        ]);
    }

    public function count()
    {
        $favorites = session()->get('favorites', []);
        return response()->json(['count' => count($favorites)]);
    }
}
