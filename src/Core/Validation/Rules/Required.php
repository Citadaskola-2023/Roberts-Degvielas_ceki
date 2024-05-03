<?php

namespace App\Core\Validation\Rules;

use App\Core\Validation\Exceptions\ValidationException;
use App\Core\Validation\Rule;

readonly class Required extends Rule
{
    public function check(mixed $value): true
    {
        if (is_string($value) && mb_strlen(trim($value), 'UTF-8') === 0) {
            throw new ValidationException('Field is required');
        }

        if (is_array($value) && count($value) === 0) {
            throw new ValidationException('Array items are required');
        }

        if (is_null($value)) {
            throw new ValidationException('Value cannot be empty');
        }

        return true;
    }

}
