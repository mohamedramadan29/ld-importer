<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Product;
use App\Models\dashboard\ProductCategory;

class WelcomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_categories'         => ProductCategory::count(),
            'active_categories'        => ProductCategory::where('status', 1)->count(),
            'inactive_categories'      => ProductCategory::where('status', 0)->count(),
            'total_products'           => Product::count(),
            'active_products'          => Product::where('status', 1)->count(),
            'inactive_products'        => Product::where('status', 0)->count(),
            'available_products'       => Product::where('availability', 1)->count(),
            'unavailable_products'     => Product::where('availability', 0)->count(),
            'products_with_discount'   => Product::whereNotNull('discount_price')->where('discount_price', '>', 0)->count(),
        ];

        return view("dashboard.welcome", compact('stats'));
    }
}
