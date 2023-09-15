<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepository;


class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.cart',[
            'cart'=>$this->cart,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable','int','min:1']
        ]);

        $products = Product::findOrFail($request->post('product_id'));
        $this->cart->add($products,$request->post('quantity'));

        if($request->expectsJson()) {
            return response()->json([
                'message'=>'Item added to cart!'
            ],201);
        }

        return redirect()->route('carts.index')
        ->with('success','product added to cart !');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
        'quantity'=>['required','int','min:1']
        ]);
        $this->cart->update($id,$request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->cart->delete($id);
        return [
            'message'=>'Item deleted!',
        ];
    }
}
