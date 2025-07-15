<?php

declare(strict_types=1);

namespace App\Actions\Home;

use Illuminate\Support\Facades\DB;

final class GetAdvantages
{
    public function handle(): array
    {
        return DB::transaction(function () {
            return [
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
        });
    }
}
