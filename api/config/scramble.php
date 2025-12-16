<?php

use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

return [
    'middleware' => [
        RestrictedDocsAccess::class,
    ],
    'api_path' => ''
];
