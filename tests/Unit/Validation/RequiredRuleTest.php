<?php

it('should pass the check with string', function () {
    // given
    $input = 'string';

    // when
    $rule = new \App\Core\Validation\Rules\Required();

    //then
    expect($rule->check($input))->toBeTrue();
});

it('should pass the check with integer', function () {
    // given
    $input = 123;

    // when
    $rule = new \App\Core\Validation\Rules\Required();

    //then
    expect($rule->check($input))->toBeTrue();
});

it('should fail the check with empty string', function () {
    // given
    $input = '';

    // when
    $rule = new \App\Core\Validation\Rules\Required();

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class);

it('should fail the check with null', function () {
    // given
    $input = null;

    // when
    $rule = new \App\Core\Validation\Rules\Required();

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class);
