<?php

namespace App\Core\Validation;

readonly abstract class Rule
{
    abstract public function check(mixed $value): true;
}
