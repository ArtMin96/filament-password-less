<?php

return [
    'login' => [
        'fields' => [
            'email' => [
                'label' => 'Adresse Email'
            ],
        ],

        'messages' => [
            'passphrase_sent' => 'Nous avons envoyé un code à votre adresse e-mail pour vous connecter.',
            'magic_link_sent' => 'Nous avons envoyé un message à votre adresse e-mail pour vous connecter.'
        ],
    ],

    'confirm' => [
        'fields' => [
            'passphrase' => [
                'label' => 'Phrase secrète'
            ],
        ],

        'buttons' => [
            'confirm' => [
                'label' => 'Confirmer'
            ],
            'sign_in' => [
                'label' => 'Connectez-vous à votre compte existant'
            ],
            'resend' => [
                'help_text' => 'Vous ne recevez pas l\'email ?',
                'label' => 'Renvoyer la phrase secrète'
            ],
        ],

        'messages' => [
            'passphrase_resent' => 'Nous avons renvoyé la phrase secrète à votre adresse e-mail, veuillez vérifier.',
        ],
    ]
];
