<?php

namespace Component;

class CategoryValidator extends Validator
{
    protected $rules = [
        [
            'validator' => 'requireValidator',
            'fields' => [
                'name'
            ]
        ],
        [
            'validator' => 'notEmptyValidator',
            'fields' => [
                'name'
            ]
        ]
    ];
}