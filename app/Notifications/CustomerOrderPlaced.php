<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CustomerOrderPlaced extends Notification
{
    use Queueable;

    public function __construct(protected $order)
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'type' => 'order',
            'title' => 'Order placed successfully',
            'message' => 'Your order #' . $this->order->id . ' has been placed successfully.',
            'order_id' => $this->order->id,
            'url' => route('front.orderDetail', ['id' => $this->order->id]),
        ];
    }
}
