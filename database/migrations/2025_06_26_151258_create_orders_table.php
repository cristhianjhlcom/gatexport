<?php

declare(strict_types=1);

use App\Enums\OrderStatusEnum;
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
            $table->uuid('id')->primary();
            $table->string('customer_firstname');
            $table->string('customer_lastname');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('notes')->nullable();
            /*
            $table->string('customer_address');
            $table->string('customer_city');
            $table->string('customer_state');
            $table->string('customer_zip');
            */
            $table->enum('status', OrderStatusEnum::values())->default(OrderStatusEnum::DRAFT);
            $table->foreignId('manager_id')
                ->nullable()
                ->constrained()
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->integer('total_products')->default(0);
            $table->integer('total_price')->default(0);
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
