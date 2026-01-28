<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Actions\Setting\GetCompanyLogos;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
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
            ->ordered()
            ->get()
            ->map(fn ($category) => [
                'name' => $category->name[app()->getLocale()],
                'slug' => $category->slug,
                'icon_primary' => Storage::disk('public')->url($category->icon_primary),
                'url' => route('categories.show', $category->slug),
                'subcategories' => $category->subcategories->map(fn ($subcategory) => [
                    'name' => $subcategory->name[app()->getLocale()],
                    'slug' => $subcategory->slug,
                    'url' => route('subcategories.index', [
                        'category' => $category->slug,
                        'subcategory' => $subcategory->slug,
                    ]),
                    'icon_primary' => Storage::disk('public')->url($subcategory->icon_primary),
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
