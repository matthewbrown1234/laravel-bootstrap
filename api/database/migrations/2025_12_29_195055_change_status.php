<?php

use App\Domains\Order\Models\OrderStatus;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {

        $values = collect(OrderStatus::cases())
            ->map(fn($case) => "'{$case->value}'")
            ->implode(', ');

        DB::transaction(function () use ($values) {
            $columnName = 'status';
            $tableName = 'orders';
            DB::statement("ALTER TABLE {$tableName} DROP CONSTRAINT IF EXISTS {$tableName}_{$columnName}_check");

            DB::statement("ALTER TABLE {$tableName} ADD CONSTRAINT {$tableName}_{$columnName}_check CHECK ({$columnName} IN ({$values}))");
        });
    }
};
