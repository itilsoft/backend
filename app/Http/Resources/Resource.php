<?php

namespace App\Http\Resources;

class Resource
{
    private string $success;
    private array $messages;

    public function __construct(bool $success, array $messages = [])
    {
        $this->success = $success;
        $this->messages = array_values($messages);
    }

    public function response(array $additional = []): array
    {
        return [
            'success' => $this->success,
            'messages' => $this->messages,
            ...$additional,
        ];
    }
}
