<?php

namespace App\DTO;

use Illuminate\Contracts\Support\Arrayable;

final readonly class PostDTO implements Arrayable
{
    public function __construct(public string $title, public string $body, public int $userId)
    {

    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            $data['body'],
            rand(1, 100)
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'userId' => $this->userId
        ];
    }
}
