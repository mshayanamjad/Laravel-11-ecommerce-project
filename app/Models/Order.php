<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'subtotal',
        'shipping',
        'discount',
        'grand_total',
        'payment_status',
        'status',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country_id',
        'address',
        'apartment',
        'city',
        'state',
        'zip',
        'note',
    ];

    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class, 'order_id');
    }

    public function recordStatusChange(string $previousStatus, string $newStatus, ?int $changedBy = null, ?string $note = null): void
    {
        if ($previousStatus === $newStatus) {
            return;
        }

        OrderStatusHistory::create([
            'order_id' => $this->id,
            'previous_status' => $previousStatus,
            'new_status' => $newStatus,
            'changed_by' => $changedBy,
            'note' => $note,
        ]);
    }

    public function getStatusTimeline(): array
    {
        $statuses = [
            'pending' => 'Order placed',
            'confirmed' => 'Confirmed',
            'packed' => 'Packed',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
        ];

        $timeline = [];
        $history = $this->statusHistory()->orderBy('created_at')->get();

        foreach ($history as $item) {
            $timeline[] = [
                'status' => $item->new_status,
                'label' => $statuses[$item->new_status] ?? ucfirst($item->new_status),
                'date' => $item->created_at,
                'note' => $item->note,
            ];
        }

        if (empty($timeline) && !empty($this->status)) {
            $timeline[] = [
                'status' => $this->status,
                'label' => $statuses[$this->status] ?? ucfirst($this->status),
                'date' => $this->created_at,
                'note' => null,
            ];
        }

        return $timeline;
    }
}
