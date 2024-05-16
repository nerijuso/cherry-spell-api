<?php

return [
    'user' => [
        'name' => [
            'required' => 'Missing a key: screen_name!',
            'min' => 'Name too short. Minimum 3 characters required.',
            'max' => 'Name too long. Limit: 32 characters.',
        ],
    ],
    'subscription' => [
        'user' => [
            'exist' => 'User already exist. Please download the Cherry Spell app and log in – or use a different email.',
            'has_subscription' => 'User already has a subscription. Please download the Cherry Spell app and log in – or use a different email.',
        ],
    ],
];
