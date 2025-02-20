<?php

declare(strict_types=1);

namespace RobinWieske\LaravelActionCommand\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidatesModel
{
    /**
     * @param  array<string,mixed>  $data
     * @return array<string,mixed>
     */
    public function isValid(array $data, string $errorBag = ''): array
    {
        return Validator::make($data, $this->rules ?? [])
            ->setException(ValidationException::class)
            ->validateWithBag($errorBag);
    }
}
