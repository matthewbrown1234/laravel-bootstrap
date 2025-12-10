<?php

namespace App\Domains\Order\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $invoice_id
 * @property string $order_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder<static>|Order newModelQuery()
 * @method static Builder<static>|Order newQuery()
 * @method static Builder<static>|Order query()
 * @method static Builder<static>|Order whereCreatedAt($value)
 * @method static Builder<static>|Order whereId($value)
 * @method static Builder<static>|Order whereInvoiceId($value)
 * @method static Builder<static>|Order whereUpdatedAt($value)
 * @method static Builder<static>|Order whereOrderNumber($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Order\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @method static \Database\Factories\Domains\Order\Models\OrderFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */


class Order extends Model
{
    use HasFactory, HasUlids;

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
