<?php

namespace App\Core\Validation\Rules;

use App\Core\Validation\Exceptions\ValidationException;
use App\Core\Validation\Rule;

readonly class Numeric extends Rule
{
    public const int STRICT_INTEGER = FILTER_VALIDATE_INT;
    public const int STRICT_FLOAT = FILTER_VALIDATE_FLOAT;

    public function __construct(
        /** @var ?self::STRICT_* */
        private ?int $strict = null,
    )
    {
    }

    public function check(mixed $value): true
    {
        if (!$this->strict) {
            if (!is_numeric($value)) {
                throw new ValidationException('Given value is not a valid numeric value');
            }
        }

        if ($this->strict && filter_var($value, $this->strict) === false) {
            throw new ValidationException('Given value is not a valid numeric value (strict)');
        }

        return true;
    }
}
