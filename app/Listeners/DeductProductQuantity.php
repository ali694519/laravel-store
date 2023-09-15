<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Throwable;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        $order = $event->order;
        //UPDATE products SET quantity = 'quantity - 1'
        try{
            foreach($order->products as $product) {
            // $product->decrement($product->pivot->quanti
             $product->decrement('quantity', $product->order_item->quantity);   //pivot as order_item


            // Product::where('id','=',$item->product_id)
            // ->update([
            //     'quantity'=> DB::raw('quantity - '.$item->quantity)
            // ]);
        }
        }
        catch(Throwable $e) {

        }

    }
}
