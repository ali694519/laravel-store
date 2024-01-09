<?php

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class frontLayout extends Component
{

    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($title = null)
    {
        $this->title = $title ?? config('app.name');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::where('parent_id', null)->with('subcategories')->get();
        return view('layouts.front',compact('categories'));
    }
}
