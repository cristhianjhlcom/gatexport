<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

final class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Forestal -> Palo Santo, Resinas, Dragon Blood, Cats Claw
        // Incences -> Palo Santo, Copal, Myrrh, Holders
        // Stones -> Tumbled, Rough, In Forms
        // Personal Care -> Essences, Soap, Lotion, Antibacterial-Gel
        $categories = [
            'Forestal' => [
                'Palo Santo',
                'Resinas',
                'Sangre de Drago',
                'Uña de Gato'
            ],
            'Inciensos' => [
                'Copal',
                'Mirra',
                'Porta Inciensos'
            ],
            'Piedras' => [
                'Pulidas',
                'En Bruto',
                'En Formas'
            ],
            'Cuidado Personal' => [
                'Esencias',
                'Jabones',
                'Lociones',
                'Gel Antibacterial'
            ]
        ];

        foreach ($categories as $name => $subcategories) {
            $category = Category::factory()->create([
                'name' => $name,
                'slug' => str()->slug($name),
            ]);

            foreach ($subcategories as $subcategory) {
                Subcategory::factory()->create([
                    'name' => $subcategory,
                    'slug' => str()->slug($subcategory),
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
