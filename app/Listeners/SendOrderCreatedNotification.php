<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderCreated;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
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
    public function handle(OrderCreated $event)
    {
        $order = $event->order;
        $user = User::where('store_id',$order->store_id)->first();
        $user->notify(new OrderCreatedNotification(($order)));

        // Notification::send($user,new OrderCreatedNotification(($order)));

       // $users = User::where('store_id',$order->store_id)->get();
       // Notification::send($users,new OrderCreatedNotification($order)); // to send all users
    }
}
