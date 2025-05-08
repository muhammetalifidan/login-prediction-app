<?php

namespace App\Models\Results;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function __construct(
        public bool $success,
        public int $code,
        public ?string $message = null,
    ) {}

    public static function success(int $code, ?string $message = null): self
    {
        return new self(true, $code, $message);
    }

    public static function error(int $code, ?string $message = null): self
    {
        return new self(false, $code, $message);
    }
}
