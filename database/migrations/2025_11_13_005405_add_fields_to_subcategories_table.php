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
        Schema::table('subcategories', function (Blueprint $table) {
            $table->string('background_color')->default('#E6A857');
            $table->json('background_image')->nullable();
            $table->string('icon_white')->nullable();
            $table->string('icon_primary')->nullable();
            $table->json('description')->nullable();
            $table->string('seo_image')->nullable();
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subcategories', function (Blueprint $table) {
            $table->dropColumn([
                'background_color',
                'background_image',
                'icon_white',
                'icon_primary',
                'description',
                'seo_image',
                'seo_title',
                'seo_description',
            ]);
        });
    }
};
