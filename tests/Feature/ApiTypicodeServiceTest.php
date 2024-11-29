<?php

namespace Tests\Feature;

use App\Services\TypicodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTypicodeServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_list_posts()
    {
        $apiService = new TypicodeService();
        $posts = $apiService->listPosts();

        $this->assertNotEmpty($posts);
        $this->assertCount(100, $posts);
    }

    public function test_create_post()
    {
        $apiService = new TypicodeService();
        $data = [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'user_id' => rand(1, 100),
        ];
        $response = $apiService->storePost($data);

        $this->assertEquals($data['title'], $response['title']);
        $this->assertEquals($data['body'], $response['body']);
        $this->assertEquals($data['user_id'], $response['user_id']);
    }
}
