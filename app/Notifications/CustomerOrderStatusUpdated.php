<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CustomerOrderStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(
        protected $order,
        protected string $previousStatus
    ) {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'type' => 'order',
            'title' => 'Order status updated',
            'message' => 'Your order #' . $this->order->id . ' status changed from '
                . ucfirst($this->previousStatus) . ' to ' . ucfirst($this->order->status) . '.',
            'order_id' => $this->order->id,
            'url' => route('front.orderDetail', ['id' => $this->order->id]),
        ];
    }
}