<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $products = Product::with('category')
        ->active()
        ->latest()
        ->limit(8)
        ->get();
        $categories = Category::get();
        return view('front.home',compact('products','categories'));
    }

    public function about()
    {
        return view('front.about.about');
    }
    public function contact()
    {
        return view('front.contact.contact');
    }
}
