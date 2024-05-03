<?php

it('should pass validation with correct integer value', function () {
    // given
    $input = 123;

    // when
    $rule = new \App\Core\Validation\Rules\Numeric();

    // then
    expect($rule->check($input))->toBeTrue();
});

it('should pass validation with correct strict integer value', function () {
    // given
    $input = 123;

    // when
    $rule = new \App\Core\Validation\Rules\Numeric(
        strict: \App\Core\Validation\Rules\Numeric::STRICT_INTEGER
    );

    // then
    expect($rule->check($input))->toBeTrue();
});

it('should allow validation to pass with correct integer inside string', function () {
    // given
    $input = "123";

    // when
    $rule = new \App\Core\Validation\Rules\Numeric();

    // then
    expect($rule->check($input))->toBeTrue();
});

it('should fail validation with not integer value', function () {
    // given
    $input = 'xxx';

    // when
    $rule = new \App\Core\Validation\Rules\Numeric();

    // then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Given value is not a valid numeric value');

it('should fail validation with not strict integer value', function () {
    // given
    $input = 123.12;

    // when
    $rule = new \App\Core\Validation\Rules\Numeric(
        strict: \App\Core\Validation\Rules\Numeric::STRICT_INTEGER
    );

    // then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Given value is not a valid numeric value (strict)');
