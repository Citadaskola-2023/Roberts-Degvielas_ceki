<?php

namespace App\Core\Validation\Rules;

use App\Core\Helper\Time;
use App\Core\Validation\Exceptions\ValidationException;
use App\Core\Validation\Rule;

readonly class Date extends Rule
{

    public function __construct(
        private string $format = Time::DF,
        private ?\DateTimeImmutable $before = null,
        private ?\DateTimeImmutable $after = null,
    ) {
    }

    public function check(mixed $value): true
    {
        $date = \DateTimeImmutable::createFromFormat($this->format, $value);

        if (!$date || $date->format($this->format) !== $value) {
            throw new ValidationException('Date format not valid');
        }

        if ($this->before && $date > $this->before) {
            throw new ValidationException('Given date has to be before ' . $this->before->format($this->format));
        }

        if ($this->after && $date < $this->after) {
            throw new ValidationException('Given date has to be after ' . $this->after->format($this->format));
        }

        return true;
    }

}
