<?php

namespace App\Domains\Order\Models;

use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $order_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Order\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Order\Models\OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @method static Builder<static>|Order applySortBy(?array $sortables)
 * @method static \Database\Factories\Domains\Order\Models\OrderFactory factory($count = null, $state = [])
 * @method static Builder<static>|Order newModelQuery()
 * @method static Builder<static>|Order newQuery()
 * @method static Builder<static>|Order query()
 * @method static Builder<static>|Order whereCreatedAt($value)
 * @method static Builder<static>|Order whereId($value)
 * @method static Builder<static>|Order whereOrderNumber($value)
 * @method static Builder<static>|Order whereStatus($value)
 * @method static Builder<static>|Order whereUpdatedAt($value)
 * @method static Builder<static>|Order withSubtotal()
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory, HasUlids, Sortable;

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeWithSubtotal($query)
    {
        return $query->withSum('orderItems as sub_total', 'price');
    }
    public function getSubTotal(): int | null
    {
        // This will use the aggregated value if available, otherwise calculate
        return $this->sub_total;
    }
}
