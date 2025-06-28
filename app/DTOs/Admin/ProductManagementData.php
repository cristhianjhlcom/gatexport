<?php

declare(strict_types=1);

namespace App\DTOs\Admin;

use App\Enums\ProductStatusEnum;

final readonly class ProductManagementData
{
    public function __construct(
        public string $name,
        public string $slug,
        public ?string $description,
        public ?string $seoTitle,
        public ?string $seoDescription,
        public ProductStatusEnum $status,
        public int $categoryId,
        public int $subcategoryId,
        public array $images = [],
        public array $specifications = []
    ) {}

    public static function fromForm(object $form): self
    {
        return new self(
            name: $form->name,
            slug: $form->slug,
            description: $form->description,
            seoTitle: $form->seo_title,
            seoDescription: $form->seo_description,
            status: $form->status,
            categoryId: $form->selectedCategoryId,
            subcategoryId: $form->selectedSubcategoryId,
            images: $form->images,
            specifications: $form->specifications
        );
    }
}
