<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderStatusHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_records_status_history_when_order_status_changes(): void
    {
        $customer = User::factory()->create([
            'role' => 'customer',
            'status' => 'active',
        ]);

        $country = Country::create([
            'name' => 'United States',
            'code' => 'US',
        ]);

        $order = new Order();
        $order->user_id = $customer->id;
        $order->subtotal = 100;
        $order->shipping = 10;
        $order->grand_total = 110;
        $order->payment_status = 'not paid';
        $order->status = 'pending';
        $order->first_name = 'John';
        $order->last_name = 'Doe';
        $order->email = 'john@example.com';
        $order->phone = '123456789';
        $order->country_id = $country->id;
        $order->address = 'Test address';
        $order->city = 'Test city';
        $order->state = 'Test state';
        $order->zip = '12345';
        $order->save();

        $order->recordStatusChange('pending', 'shipped', $customer->id, 'Order is on the way.');

        $this->assertDatabaseHas('order_status_histories', [
            'order_id' => $order->id,
            'previous_status' => 'pending',
            'new_status' => 'shipped',
            'changed_by' => $customer->id,
            'note' => 'Order is on the way.',
        ]);

        $this->assertInstanceOf(OrderStatusHistory::class, $order->statusHistory()->first());
    }
}
