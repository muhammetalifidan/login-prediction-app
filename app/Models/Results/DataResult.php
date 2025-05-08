<?php

namespace App\Models\Results;

class DataResult extends Result
{
    public function __construct(
        public bool $success,
        public int $code,
        public ?string $message = null,
        public ?array $data = [],
    ) {}

    public static function success(int $code, ?string $message = null, ?array $data = []): self
    {
        return new self(true, $code, $message, $data);
    }

    public static function error(int $code, ?string $message = null, ?array $data = []): self
    {
        return new self(false, $code, $message, $data);
    }
}
