<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id','user_id','payment_method','status','payment_status'
    ];

    public function store() {
        return $this->belongsTo(store::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class,
        'order_items',
        'order_id',
        'product_id',
        'id',
        'id')
        ->using(OrderItem::class)
        ->as('order_item')
        ->withPivot([
            'product_name','price','quantity','options'
        ]);
    }

    public function items() {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function user() {
        return $this->belongsTo(User::class)
        ->withDefault([
            'name'=>'Guest Customer'
        ]);
    }

    public function addresses() {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress() {
        return $this->hasOne(OrderAddress::class,'order_id','id')
        ->where('type','billing'); //return model
        //or
        // return $this->address()->where('type','billing'); // return collection
    }

    public function shippingAddress() {
        return $this->hasOne(OrderAddress::class,'order_id','id')
        ->where('type','shipping');
    }

    public function delivery() {
        return $this->hasOne(Delivery::class);
    }



    protected static function booted() {
        static::creating(function(Order $order) {
            //20230001,20230002
            $order->number = Order::getnextOrderNumber();
        });
    }


    public static function getnextOrderNumber() {
        //SELECT MAX(number) FROM orders
       $year = Carbon::now()->year;
       $number =  Order::whereYear('created_at',$year)->max('number');
       if($number) {
        return $number + 1;
       }
       return $year.'0001';
    }
}
