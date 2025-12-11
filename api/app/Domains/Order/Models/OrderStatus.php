<?php

namespace App\Domains\Order\Models;

enum OrderStatus: string
{
    case ABANDONED = 'abandoned';
    case LOCKED = 'locked';
    case WAREHOUSE = 'warehouse';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';
}
