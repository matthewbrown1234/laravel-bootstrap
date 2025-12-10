<?php

use App\Domains\Order\Models\InvoiceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('order_id')->index()->references('id')->on('orders');
            $table->ulid('external_id')->index();
            $table->bigInteger('sub_total')->comment('four decimal places');
            $table->bigInteger('total')->comment('four decimal places');
            $table->enum('status', InvoiceStatus::cases())->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
