<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

final class HomeIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $steps = [
            [
                'title' => 'Cultivo Sostenible',
                'description' => 'Cultivamos nuestro Palo Santo siguiendo prácticas sostenibles y respetuosas con el medio ambiente.',
                'icon' => 'tree',
                'step' => 1,
            ],
            [
                'title' => 'Selección y Cosecha',
                'description' => 'Seleccionamos cuidadosamente cada árbol, asegurando su madurez óptima.',
                'icon' => 'hand-select',
                'step' => 2,
            ],
            [
                'title' => 'Procesamiento',
                'description' => 'Procesamos la madera siguiendo estrictos estándares de calidad.',
                'icon' => 'cog',
                'step' => 3,
            ],
            [
                'title' => 'Control de Calidad',
                'description' => 'Cada lote pasa por rigurosos controles de calidad.',
                'icon' => 'clipboard-check',
                'step' => 4,
            ],
            [
                'title' => 'Empaque',
                'description' => 'Empacamos según especificaciones del cliente y normativas internacionales.',
                'icon' => 'package',
                'step' => 5,
            ],
            [
                'title' => 'Distribución Global',
                'description' => 'Exportamos a más de 25 países con eficiencia logística.',
                'icon' => 'globe',
                'step' => 6,
            ],
        ];

        $advantages = [
            [
                'id' => 1,
                'title' => 'Lorem Ipsum Dolor',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim at fugit explicabo expedita consequuntur tenetur, tempore quas nihil laboriosam veniam?',
                'icon' => 'check-circle',
            ],
            [
                'id' => 2,
                'title' => 'Lorem Ipsum Dolor',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim at fugit explicabo expedita consequuntur tenetur, tempore quas nihil laboriosam veniam?',
                'icon' => 'shield-check',
            ],
            [
                'id' => 3,
                'title' => 'Lorem Ipsum Dolor',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim at fugit explicabo expedita consequuntur tenetur, tempore quas nihil laboriosam veniam?',
                'icon' => 'check-circle',
            ],
            [
                'id' => 4,
                'title' => 'Lorem Ipsum Dolor',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim at fugit explicabo expedita consequuntur tenetur, tempore quas nihil laboriosam veniam?',
                'icon' => 'check-circle',
            ],
            [
                'id' => 5,
                'title' => 'Lorem Ipsum Dolor',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim at fugit explicabo expedita consequuntur tenetur, tempore quas nihil laboriosam veniam?',
                'icon' => 'check-circle',
            ],
            [
                'id' => 6,
                'title' => 'Lorem Ipsum Dolor',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim at fugit explicabo expedita consequuntur tenetur, tempore quas nihil laboriosam veniam?',
                'icon' => 'check-circle',
            ],
        ];

        $categories = Category::with('subcategories')
            ->orderBy('name')
            ->limit(4)
            ->get();

        return view('pages.homepage.index')->with([
            'process' => $steps,
            'advantages' => $advantages,
            'categories' => $categories,
        ]);
    }
}
