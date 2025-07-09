<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Log::info('Deleting Uploads Directory');
        // Limpiar directorios usando el disk correcto
        Storage::disk('public')->deleteDirectory('uploads');
        Storage::disk('local')->deleteDirectory('uploads');

        Log::info('Creating Uploads Directory');
        // Crear directorios usando el disk correcto
        Storage::disk('public')->makeDirectory('uploads/categories');
        Storage::disk('public')->makeDirectory('uploads/subcategories');
        Storage::disk('public')->makeDirectory('uploads/products');

        // Para verificar que los directorios se crearon
        Log::info('Directories created', [
            'categories' => Storage::disk('public')->exists('uploads/categories'),
            'subcategories' => Storage::disk('public')->exists('uploads/subcategories'),
            'products' => Storage::disk('public')->exists('uploads/products'),
        ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            // CategorySeeder::class,
            SubcategorySeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            OrderItemsSeeder::class,
        ]);
    }
}
