1. Fix boost
```json

    "post-update-cmd": [
                "@php artisan vendor:publish --tag=laravel-assets --ansi --force",
                "@php artisan boost:update --ansi"
            ],
```
