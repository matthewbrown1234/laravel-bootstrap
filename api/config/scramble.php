<?php

use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

return [
    'servers' => [
        'Local' => 'http://localhost:8000',
        'Production' => null,
    ],
    'middleware' => [
        RestrictedDocsAccess::class,
    ],
];
