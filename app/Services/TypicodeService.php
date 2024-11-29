<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

final readonly class TypicodeService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function listPosts()
    {
        return rescue(function () {
            $response = $this->client->get('https://jsonplaceholder.typicode.com/posts');
            $data = json_decode($response->getBody(), true);
            Log::info('Attempted to get post from API', ['response' => $data]);

            return $data;
        });
    }

    /**
     * @throws GuzzleException
     */
    public function storePost(array $post)
    {
        return rescue(function () use ($post) {
            $response = $this->client->post('https://jsonplaceholder.typicode.com/posts', [
                'json' => $post,
            ]);
            $data = json_decode($response->getBody(), true);
            Log::info('Store a post', ['response' => $data]);

            return $data;
        });
    }

    public function getPost(int $id)
    {
        return rescue(function () use ($id) {
            $response = $this->client->get('https://jsonplaceholder.typicode.com/posts/'.$id);
            $data = json_decode($response->getBody(), true);
            Log::info('Retrieve a post', ['response' => $data]);

            return $data;
        });
    }
}
