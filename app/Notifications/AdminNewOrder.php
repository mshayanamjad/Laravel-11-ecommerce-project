<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminNewOrder extends Notification
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
            'title' => 'New order received',
            'message' => 'A new order #' . $this->order->id . ' has been placed by ' . $this->order->first_name . ' ' . $this->order->last_name . '.',
            'order_id' => $this->order->id,
            'url' => route('order.index'),
        ];
    }
}
