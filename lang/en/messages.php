<?php

declare(strict_types=1);

return [
    'public' => [
        'contact' => [
            'greeting' => 'Hello,',
            'success' => [
                'title' => 'Thanks for contacting us!',
                'message' => 'We have sent you an email with your message. We will contact you soon.',
            ],
            'error' => [
                'title' => 'Oops! Something went wrong.',
                'message' => 'We could not send your message. Please try again later.',
            ],
        ],

        'product' => [
            'success' => [
                'title' => 'Order created successfully',
                'message' => 'Order created successfully. Someone will contact you soon.',
            ],
            'error' => [
                'title' => 'Oops! Something went wrong.',
                'message' => 'Cannot create the order, try again later.',
            ],
        ],
    ],
];
