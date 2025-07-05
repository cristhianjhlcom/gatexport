<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

final class ProductShowController extends Controller
{
    public function __invoke(Request $request, Product $product)
    {
        return view('pages.products.show')->with([
            'product' => $product,
        ]);
    }
}
