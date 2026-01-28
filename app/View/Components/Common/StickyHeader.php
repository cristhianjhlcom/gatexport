<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Actions\Setting\GetCompanyLogos;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

final class StickyHeader extends Component
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
                'name' => $category->localizedName,
                'slug' => $category->localizedSlug,
                'secondary_icon' => isset($category->icon_white) ? Storage::disk('public')->url($category->icon_white) : null,
                'url' => $category->showUrl,
                'primary_icon' => isset($category->icon_primary) ? Storage::disk('public')->url($category->icon_primary) : null,
                'background_color' => $category->background_color,
                'subcategories' => $category->subcategories->map(fn ($subcategory) => [
                    'name' => $subcategory->localizedName,
                    'slug' => $subcategory->localizedSlug,
                    'url' => route('subcategories.index', [
                        'category' => $category->localizedSlug,
                        'subcategory' => $subcategory->localizedSlug,
                    ]),
                    'secondary_icon' => isset($subcategory->icon_white) ? Storage::disk('public')->url($subcategory->icon_white) : null,
                    'primary_icon' => isset($subcategory->icon_primary) ? Storage::disk('public')->url($subcategory->icon_primary) : null,
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
        return view('components.common.sticky-header');
    }
}
