<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminNewCustomer extends Notification
{
    use Queueable;

    public function __construct(protected $customer)
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'type' => 'customer',
            'title' => 'New customer registered',
            'message' => 'A new customer, ' . $this->customer->name . ', has registered on the site.',
            'customer_id' => $this->customer->id,
            'url' => route('user.list'),
        ];
    }
}
