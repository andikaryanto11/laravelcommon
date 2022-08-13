<?php

return [
    'entity' => [
        'mapping' => [
            'app' => base_path() . '/app/Entities/Mapping'
        ]
    ],
    'jwt' => [
        'expired_in_days' => 90
    ],
    'collection_paging' => [
        'size' => 100
    ]
];
