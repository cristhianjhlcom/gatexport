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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug_en')->nullable()->unique()->after('slug');
        });

        Schema::table('subcategories', function (Blueprint $table) {
            $table->string('slug_en')->nullable()->unique()->after('slug');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('slug_en')->nullable()->unique()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug_en');
        });

        Schema::table('subcategories', function (Blueprint $table) {
            $table->dropColumn('slug_en');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug_en');
        });
    }
};
