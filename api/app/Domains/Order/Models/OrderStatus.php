<?php

namespace App\Domains\Order\Models;

enum OrderStatus: string
{
    case ABANDONED = 'abandoned';
    case LOCKED = 'locked';
    case CANCELLED = 'cancelled';
    case ORDERED = 'ordered';
    case PROCESSING = 'processing';
    case CLOSED = 'closed';
}
