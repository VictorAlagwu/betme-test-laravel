<?php

namespace App\Domain\Dto\Value\SportProvider;

class OddsApiResponseDto extends SportProviderResponseDto
{
    public bool $success;
    public string $message;
    public ?array $data;

    public function __construct(bool $success, string $message, ?array $data)
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }
}
