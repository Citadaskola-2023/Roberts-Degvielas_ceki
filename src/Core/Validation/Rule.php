<?php

namespace App\Core\Validation;

use App\Core\Validation;

readonly abstract class Rule
{
    protected Validation $validation;
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

    public function withValidation(Validation $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    public function getParamValue(string $name): mixed
    {
        return $this->validation->old($name);
    }
}
