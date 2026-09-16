<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationInboxTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_access_notifications_inbox(): void
    {
        $user = User::factory()->create([
            'role' => 'customer',
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->get('/male-fashion/notifications');

        $response->assertStatus(200);
    }

    public function test_admin_can_access_notifications_inbox(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $response = $this->actingAs($user, 'admin')->get('/admin/notifications');

        $response->assertStatus(200);
    }
}
