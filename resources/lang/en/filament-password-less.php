<?php

return [
    'login' => [
        'fields' => [
            'email' => [
                'label' => 'Email address'
            ],
        ],

        'messages' => [
            'passphrase_sent' => 'We have sent a code to your email address to log in.',
            'magic_link_sent' => 'We have sent a message to your email address to log in.'
        ],
    ],

    'confirm' => [
        'fields' => [
            'passphrase' => [
                'label' => 'Pass-phrase'
            ],
        ],

        'buttons' => [
            'confirm' => [
                'label' => 'Confirm'
            ],
            'sign_in' => [
                'label' => 'Sign in to your existing account'
            ],
            'resend' => [
                'help_text' => 'Don\'t receive an email?',
                'label' => 'Resend passphrase'
            ],
        ],

        'messages' => [
            'passphrase_resent' => 'We have re-sent the passphrase to your email, please check.',
        ],
    ]
];
