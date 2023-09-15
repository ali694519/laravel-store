<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array   // User Model <= $notifiable
    {

        return ['mail','database','broadcast'];

    //    $channels = ['database'];
    //    if( $notifiable->notifications_preferences['order_created']['sms'] ?? false){
    //         $channels[] = 'vonage';
    //     }
    //       if($notifiable->notifications_preferences['order_created']['email'] ?? false){
    //         $channels[] = 'mail';
    //     }
    //       if($notifiable->notifications_preferences['order_created']['broadcast'] ?? false){
    //         $channels[] = 'broadcast';
    //     }
    //     return  $channels;

    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
            ->subject("New Order# {$this->order->number}")
            ->greeting("Hi {$notifiable->name},")
            ->line("A new order (#{$this->order->number}) created by {$addr->name}from {$addr->country_name}.")  // <p>...</p>
            ->action('View Order', url('/dashboard'))  // url
            ->line('Thank you for using our application!');  //<p>...</p>
    }




    public function toDatabase(object $notifiable)
    {
        $addr = $this->order->billingAddress;
        return [
            'body'=>"A new order (#{$this->order->number}) created by {$addr->name}from {$addr->country_name}.",
            "icon"=>'fas fa-file',
            "url"=>url('/dashboard'),
            'order_id'=>$this->order->id,
        ];
    }

    public function toBroadcast($notifiable) {
         $addr = $this->order->billingAddress;
        return new BroadcastMessage( [
            'body'=>"A new order (#{$this->order->number}) created by {$addr->name}from {$addr->country_name}.",
            "icon"=>'fas fa-file',
            "url"=>url('/dashboard'),
            'order_id'=>$this->order->id,
        ]);
    }



    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
