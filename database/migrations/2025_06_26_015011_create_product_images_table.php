<?php

declare(strict_types=1);

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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('filename'); // nombre del archivo
            $table->string('original_name'); // nombre original del archivo
            $table->string('path'); // ruta relativa desde storage
            $table->string('mime_type', 50); // image/webp
            $table->unsignedInteger('size'); // tamaño en bytes
            $table->unsignedSmallInteger('width')->default(1000);
            $table->unsignedSmallInteger('height')->default(1000);
            $table->unsignedTinyInteger('order')->default(0); // orden de visualización
            $table->timestamps();

            $table->index(['product_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
