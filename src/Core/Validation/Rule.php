<?php

namespace App\Core\Validation;

readonly abstract class Rule
{
    protected ?string $message;

    abstract public function check(mixed $value): true;

    public function withMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCustomMessage(): ?string
    {
        return $this->message ?? null;
    }

}
