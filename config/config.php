<?php

return [
    'queues' => [
        [
            'default' => [
                'enabled' => false,

                'connection' => 'database',

                'options' => [
                    'sleep' => 3,
                    'tries' => 3,
                    'max-time' => 3600,
                ],
            ],
        ]
    ]
];
