<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        return view('front.index');
    }

    public function about() {
        return view('front.about');
    }

    public function contact(){
        return view('front.contact');
    }
}
