<?php

namespace App\View\Components;

use App\Facades\Cart;
use App\Repositories\Cart\CartRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartMenu extends Component
{
    public $items;
    public $total;
    /**
     * Create a new component instance.
     */
    //  public function __construct(CartRepository $cart)  get form services container
    // {
    //     $this->items = $cart->get();
    //     $this->total = $cart->total();
    // }

    public function __construct()  // get from facade
    {
        $this->items = Cart::get();
        $this->total = Cart::total();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-menu');
    }
}
