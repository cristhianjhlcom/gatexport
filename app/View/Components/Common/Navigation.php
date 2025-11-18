<?php

namespace App\View\Components\Common;

use App\Actions\Setting\GetCompanyLogos;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Navigation extends Component
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
            ->map(fn($category) => [
                'name' => $category->localizedName,
                'slug' => $category->slug,
                'secondary_icon' => Storage::disk('public')->url($category->icon_white),
                'primary_icon' => Storage::disk('public')->url($category->icon_primary),
                'background_color' => $category->background_color,
                'subcategories' => $category->subcategories->map(fn($subcategory) => [
                    'name' => $subcategory->localizedName,
                    'slug' => $subcategory->slug,
                    'secondary_icon' => Storage::disk('public')->url($subcategory->icon_white),
                    'primary_icon' => Storage::disk('public')->url($subcategory->icon_primary),
                    'background_color' => $subcategory->background_color,
                ]),
            ]);

        $this->logos = (new GetCompanyLogos)->execute();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common.navigation');
    }
}
