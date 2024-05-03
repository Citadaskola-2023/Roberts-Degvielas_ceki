<?php

it('should pass validation with correct date format', function () {
    // given
    $input = '2024-05-03 07:25:49';

    // when
    $rule = new \App\Core\Validation\Rules\Date(
        format: 'Y-m-d H:i:s'
    );

    //then
    expect($rule->check($input))->toBeTrue();
});

it('should fail validation with different date format', function () {
    // given
    $input = '2024-05-03 07:25:49';

    // when
    $rule = new \App\Core\Validation\Rules\Date(
        format: 'Y-m-d'
    );

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Date format not valid');

it('should fail validation with false positive date format', function () {
    // given
    $input = '2024-05-03 07:25:49';

    // when
    $rule = new \App\Core\Validation\Rules\Date(
        format: 'Y-m-d G:i:s'
    );

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Date format not valid');

it('should fail validation if input value is later than required', function () {
    // given
    $input = '2024-05-03 10:25:49';

    // when
    $rule = new \App\Core\Validation\Rules\Date(
        format: 'Y-m-d H:i:s',
        before: new DateTimeImmutable('2024-05-03 07:25:49')
    );

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Given date has to be before');

it('should fail validation if input value is sooner than required', function () {
    // given
    $input = '2024-05-02 10:25:49';

    // when
    $rule = new \App\Core\Validation\Rules\Date(
        format: 'Y-m-d H:i:s',
        after: new DateTimeImmutable('2024-05-03 07:25:49')
    );

    //then
    expect($rule->check($input));
})->throws(\App\Core\Validation\Exceptions\ValidationException::class, 'Given date has to be after');
