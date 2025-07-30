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
            $table->id('id');
            $table->string('order_number')->unique();
            $table->string('customer_firstname')->nullable();
            $table->string('customer_lastname')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
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
