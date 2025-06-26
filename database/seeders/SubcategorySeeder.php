<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            // Anillos
            [
                'category_id' => 1,
                'name' => 'Anillos de Compromiso',
                'slug' => Str::slug('anillos-de-compromiso'),
            ],
            [
                'category_id' => 1,
                'name' => 'Anillos Redimensionables',
                'slug' => Str::slug('anillos-redimensionables'),
            ],
            [
                'category_id' => 1,
                'name' => 'Anillos con Figuras',
                'slug' => Str::slug('anillos-con-figuras'),
            ],
            // Aretes
            [
                'category_id' => 2,
                'name' => 'Aretes de Moda',
                'slug' => Str::slug('aretes-de-moda'),
            ],
            [
                'category_id' => 2,
                'name' => 'Aretes Punk',
                'slug' => Str::slug('aretes-punk'),
            ],
            [
                'category_id' => 2,
                'name' => 'Aretes de Aro',
                'slug' => Str::slug('aretes-de-aro'),
            ],
            [
                'category_id' => 2,
                'name' => 'Aretes de Cruz',
                'slug' => Str::slug('aretes-de-cruz'),
            ],
            [
                'category_id' => 2,
                'name' => 'Aretes Clip',
                'slug' => Str::slug('aretes-clip'),
            ],
            // Brazaletes
            [
                'category_id' => 3,
                'name' => 'Brazaletes de Cuerda',
                'slug' => Str::slug('brazaletes-de-cuerda'),
            ],
            [
                'category_id' => 3,
                'name' => 'Brazaletes de Cuero',
                'slug' => Str::slug('brazaletes-de-cuero'),
            ],
            [
                'category_id' => 3,
                'name' => 'Brazaletes de Titanio',
                'slug' => Str::slug('brazaletes-de-titanio'),
            ],
            [
                'category_id' => 3,
                'name' => 'Brazaletes Cola de zorro',
                'slug' => Str::slug('brazaletes-cola-de-zorro'),
            ],
            // Pulseras
            [
                'category_id' => 4,
                'name' => 'Pulseras de Cuero',
                'slug' => Str::slug('pulseras-de-cuero'),
            ],
            [
                'category_id' => 4,
                'name' => 'Pulseras Doradas',
                'slug' => Str::slug('pulseras-doradas'),
            ],
            // Collares
            [
                'category_id' => 5,
                'name' => 'Collares Dorados',
                'slug' => Str::slug('collares-dorados'),
            ],
            [
                'category_id' => 5,
                'name' => 'Collares Plateados',
                'slug' => Str::slug('collares-plateados'),
            ],
            // Pendientes
            [
                'category_id' => 6,
                'name' => 'Pendientes sin Perforacion',
                'slug' => Str::slug('pendientes-sin-perforacion'),
            ],
            [
                'category_id' => 6,
                'name' => 'Pendientes de Plata',
                'slug' => Str::slug('pendientes-de-plata'),
            ],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::firstOrCreate($subcategory);
        }
    }
}
