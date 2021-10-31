<?php

namespace App\Domain\Dto\Value\SportProvider;

class OddsApiResponseDto extends SportProviderResponseDto
{
    public bool $status;
    public string $message;
    public ?array $data;

    public function __construct(bool $status, string $message, ?array $data)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
}
