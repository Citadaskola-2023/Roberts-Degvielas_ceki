<?php

it('should pass the validation if input is higher than rule expected', function () {
    // given
    $input = 42.42;

    // when
    $rule = new \App\Core\Validation\Rules\Between(
        min: 10.21
    );

    //then
    expect($rule->check($input))->toBeTrue();
});

it('should fail the validation if input is lower than rule expected', function () {
    // given
    $input = 9.99;

    // when
    $rule = new \App\Core\Validation\Rules\Between(
        min: 10
    );

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Number must be higher or equal than');

it('should pass the validation if input is lower than rule expected', function () {
    // given
    $input = 7;

    // when
    $rule = new \App\Core\Validation\Rules\Between(
        max: 10
    );

    //then
    expect($rule->check($input))->toBeTrue();
});

it('should fail the validation if input is higher than rule expected', function () {
    // given
    $input = 42.42;

    // when
    $rule = new \App\Core\Validation\Rules\Between(
        max: 10
    );

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Number must be lower or equal than');

it('should allow validation to pass with correct number between two numbers', function () {
    // given
    $input = 52;

    // when
    $rule = new \App\Core\Validation\Rules\Between(
        min: 42,
        max: 69
    );

    //then
    expect($rule->check($input))->toBeTrue();
});

it('should fail validation with number outside the required range', function () {
    // given
    $input = 100;

    // when
    $rule = new \App\Core\Validation\Rules\Between(
        min: 42,
        max: 69
    );

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Number must be between');

it('should fail the validation if input is negative (below zero)', function () {
    // given
    $input = "-42";

    // when
    $rule = new \App\Core\Validation\Rules\Between(
        min: 0
    );

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Number must be higher or equal than 0');
