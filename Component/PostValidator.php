<?php

namespace Component;

class PostValidator extends Validator
{
    protected $rules = [
        [
            'validator' => 'requireValidator',
            'fields' => [
                'title',
                'body',
                'category_id'
            ]
        ],
        [
            'validator' => 'notEmptyValidator',
            'fields' => [
                'title',
                'body',
                'category_id'
            ]
        ]
    ];
}