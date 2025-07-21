<?php

declare(strict_types=1);

return [
    'public' => [
        'contact' => [
            'success' => [
                'title' => '¡Gracias por contactarnos!',
                'message' => 'Le hemos enviado un correo electrónico con tu mensaje. Te contactaremos en breve.',
            ],
            'error' => [
                'title' => '¡Ups! Algo salió mal.',
                'message' => 'No hemos podido enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.',
            ],
        ],
        'product' => [
            'success' => [
                'title' => 'La orden se ha creado correctamente',
                'message' => 'La orden se ha creado correctamente. Alguien te contactará pronto.',
            ],
            'error' => [
                'title' => '¡Ups! Algo salió mal.',
                'message' => 'No hemos podido crear tu orden. Por favor, inténtalo de nuevo más tarde.',
            ],
        ],
    ],
];
