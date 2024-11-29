<?php

namespace App\Http\Controllers\Api;

use App\DTO\PostDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Services\TypicodeService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private readonly TypicodeService $typicodeService
    ) {}

    public function index(Request $request)
    {
        return PostResource::collection($this->typicodeService->listPosts());
    }

    /**
     * @throws GuzzleException
     */
    public function store(PostRequest $request)
    {
        $data = PostDTO::fromArray($request->validated());

        return rescue(fn () => new PostResource($this->typicodeService->storePost($data->toArray())));
    }

    public function show(int $id)
    {
        return rescue(fn () => new PostResource($this->typicodeService->getPost($id)));
    }
}
