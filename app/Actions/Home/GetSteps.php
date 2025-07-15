<?php

declare(strict_types=1);

namespace App\Actions\Home;

use Illuminate\Support\Facades\DB;

final class GetSteps
{
    public function handle(): array
    {
        return DB::transaction(function () {
            return [
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
        });
    }
}
