<?php


use App\Services\TypicodeService;
use Tests\TestCase;

class ApiWebhookCallbackTest extends TestCase
{
    public function test_callback_received()
    {
        $response = $this->withServerVariables(['REMOTE_ADDR' => '127.0.0.1'])
            ->postJson('/callback', [
            'status' => 'success',
            'order_id' => 12345,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Success']);
    }

    public function test_trusted_callback_received()
    {
        $response = $this->withServerVariables(['REMOTE_ADDR' => '178.63.67.153'])
            ->postJson('/callback', [
                'status' => 'success',
                'order_id' => 12345,
            ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Success']);
    }

    public function test_untrusted_callback_received()
    {
        $this->withServerVariables(['REMOTE_ADDR' => '198.168.1.1'])
            ->postJson('/callback', [
                'status' => 'success',
                'order_id' => 12345,
            ])->assertForbidden();
    }
}
