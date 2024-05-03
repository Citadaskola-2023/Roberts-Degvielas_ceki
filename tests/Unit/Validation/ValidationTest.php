<?php

it('should fill validated array with valid given values', function () {
    // given
    $request = [
        'car_number' => 'AB-1234',
        'gmt' => '2024-05-03 11:23:42',
    ];

    $rules = [
        'car_number' => [
            new \App\Core\Validation\Rules\Required()
        ],
        'gmt' => [
            new \App\Core\Validation\Rules\Required(),
            new \App\Core\Validation\Rules\Date(),
        ]
    ];

    // when
    $validation = new \App\Core\Validation($request, $rules);

    // then
    $validated = $validation->validate();
    expect($validated)->toHaveKeys([
        'car_number',
        'gmt'
    ]);
});

it('should omit invalid request values in resulting array', function () {
    // given
    $request = [
        'car_number' => null,
        'gmt' => '2024-05-03 11:23:42',
    ];

    $rules = [
        'car_number' => [
            new \App\Core\Validation\Rules\Required()
        ],
        'gmt' => [
            new \App\Core\Validation\Rules\Required(),
            new \App\Core\Validation\Rules\Date(),
        ],
        'not_found_in_request' => [
            new \App\Core\Validation\Rules\Required(),
        ]
    ];

    // when
    $validation = new \App\Core\Validation($request, $rules);

    // then
    $validated = $validation->validate();
    expect($validated)->not->toHaveKeys([
        'not_found_in_request',
        'car_number',
    ])->and($validation->getErrors())->toHaveKeys([
        'not_found_in_request',
        'car_number',
    ]);
});
