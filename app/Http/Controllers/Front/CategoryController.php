<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function index() {

    }


    public function show(Category $product) {
        return view('front.products.show',compact('product'));
     }
}
