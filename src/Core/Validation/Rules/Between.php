<?php

namespace App\Core\Validation\Rules;

use App\Core\Validation\Exceptions\ValidationException;
use App\Core\Validation\Rule;

readonly class Between extends Rule
{
    public function __construct(
        private null|int|float $min = null,
        private null|int|float $max = null,
        private bool $inclusive = true,
    ) {
    }

    public function check(mixed $value): true
    {
        if ($this->min === null && $this->max === null) {
            throw new ValidationException('Rule is not defined properly');
        }

        if (is_string($value) && !is_numeric($value)) {
            return $this->isValidString($value);
        }

        $adjustedMin = $this->inclusive ? $this->min : $this->min + PHP_FLOAT_EPSILON;
        $adjustedMax = $this->inclusive ? $this->max : $this->max - PHP_FLOAT_EPSILON;

        $part = $this->inclusive ? ' or equal' : '';

        if ($this->max === null && $this->min !== null && $adjustedMin > $value) {
            $part = 'higher' . $part;
            throw new ValidationException("Number must be $part than $this->min");
        }

        if (!$this->min === null && $this->max !== null && $adjustedMax < $value) {
            $part = 'lower' . $part;
            throw new ValidationException("Number must be $part than $this->max");
        }

        if ($this->min !== null && $this->max !== null) {
            $min = min($adjustedMin, $adjustedMax);
            $max = max($adjustedMin, $adjustedMax);

            if ($value < $min || $value > $max) {
                throw new ValidationException("Number must be between $this->min and $this->max");
            }
        }

        return true;
    }

    private function isValidString(string $value): true
    {
        $length = mb_strlen($value);

        if ($this->min && $length < $this->min) {
            throw new ValidationException("String cannot be shorter than $this->min characters");
        }

        if ($this->max && $length > $this->max) {
            throw new ValidationException("String cannot be longer than $this->max characters");
        }

        return true;
    }
}
