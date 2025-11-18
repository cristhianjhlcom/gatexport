<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Actions\Setting\GetCompanyLogos;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class MobileNavigation extends Component
{
    public $items = [];

    public $logos = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = Category::with('subcategories')
            ->orderBy('name')
            ->get()
            ->map(fn ($category) => [
                'name' => $category->name,
                'slug' => $category->slug,
                'image' => $category->imageUrl,
                'subcategories' => $category->subcategories->map(fn ($subcategory) => [
                    'name' => $subcategory->name,
                    'slug' => $subcategory->slug,
                    'image' => $subcategory->imageUrl,
                ]),
            ]);

        $this->logos = (new GetCompanyLogos)->execute();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common.mobile-navigation');
    }
}
