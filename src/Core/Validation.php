<?php

namespace App\Core;

class Validation
{
    private array $errors = [];
    private bool $failed = false;
    private array $unvalidated = [];

    /** @var array<string, \App\Core\Validation\Rule[]> */
    private array $rules;

    /** @param  array<string, \App\Core\Validation\Rule[]>  $requestRules */
    public function __construct(
        private readonly array $request = [],
        array $requestRules = [],
    ) {
        foreach ($requestRules as $field => $rules) {
            foreach ($rules as $rule) {
                $this->rules[$field][] = $rule->withValidation($this);
            }
        }
    }

    public function validate(): array
    {
        $validated = [];
        $this->unvalidated = $this->request;

        foreach ($this->rules as $field => $rules) {
            unset($this->unvalidated[$field]);
            $value = $this->request[$field] ?? null;

            try {
                foreach ($rules as $rule) {
                    $msg = $rule->getCustomMessage();
                    $rule->check($value);
                }
                $validated[$field] = $value;
            } catch (\Exception $e) {

                $this->errors[$field] = $msg ?? $e->getMessage();
                $this->failed = true;
            }
        }

        return $validated;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function isFailed(): bool
    {
        return $this->failed;
    }

    public function old(string $field): mixed
    {
        return $this->request[$field] ?? null;
    }
}
