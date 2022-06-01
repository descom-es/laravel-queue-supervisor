<?php

return [
    'workers' => [
        'default' => [
            'options' => [
                // 'sleep' => 3,
                // 'tries' => 3,
                // 'max-time' => 3600,
            ],

            // 'connection' => 'database',

            // 'enabled' => false,
        ],

        // 'other_worker' => [
        //     'options' => [max-time' => 3600],
        //     'connection' => 'sqs',
        // ],
    ],

    'schedule' => [

        'start' => [
            'enabled' => true,

            // 'cron' => '* * * * *',
        ],



    ],
];
