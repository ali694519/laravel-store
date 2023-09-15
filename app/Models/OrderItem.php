<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Pivot
{
    use HasFactory;

    protected $table = "order_items";

    public $incrementing = true;
    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class)
        ->withDefault([
            'name'=>$this->product_name
        ]);
    }

     public function order() {
        return $this->belongsTo(Order::class);
    }
}
