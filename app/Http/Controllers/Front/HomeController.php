<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
        ->active()
        ->latest()
        ->limit(8)
        ->get();
        $categories = Category::where('parent_id', null)->with('subcategories')->get();
        $latestProduct = Product::latest()->first();
        return view('front.home',compact('products','categories','latestProduct'));
    }

    public function about()
    {
        return view('front.about.about');
    }
    public function contact()
    {
        return view('front.contact.contact');
    }
    public function blogGridSidebar()
    {
        return view('front.blogs.blog-grid-sidebar');
    }
    public function BlogSingle()
    {
        return view('front.blogs.blog-single');
    }
     public function BlogSingleSidebar()
    {
        return view('front.blogs.blog-single-sidebar');
    }
     public function faq()
    {
        return view('front.faq.faq');
    }
}
