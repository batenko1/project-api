<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->string('fio');
            $table->tinyInteger('is_agree')->default(0);
            $table->enum('status', Order::STATUSES)->default(Order::NEW_STATUS);
            $table->enum('payment_status', Order::PAYMENT_STATUSES)->default(Order::FAILED_PAYMENT);
            $table->string('file_contract')->nullable();
            $table->decimal('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
