<?php

declare(strict_types=1);

namespace Tests\Feature\Console;

use App\Enums\ProductStatusEnum;
use App\Models\Article;
use App\Models\Category;
use App\Models\Policy;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class GenerateSitemapCommandTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        // Clean up generated sitemap after each test
        if (file_exists(public_path('sitemap.xml'))) {
            unlink(public_path('sitemap.xml'));
        }

        parent::tearDown();
    }

    public function test_it_generates_sitemap_xml_file(): void
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'status' => ProductStatusEnum::PUBLISHED,
        ]);

        $this->artisan('sitemap:generate')
            ->assertSuccessful();

        $this->assertFileExists(public_path('sitemap.xml'));

        $xml = simplexml_load_file(public_path('sitemap.xml'));
        $this->assertNotFalse($xml);

        $content = file_get_contents(public_path('sitemap.xml'));
        $this->assertStringContainsString(route('home.index'), $content);
        $this->assertStringContainsString($product->showUrl, $content);
    }

    public function test_it_includes_all_published_products(): void
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);

        $publishedProduct1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'status' => ProductStatusEnum::PUBLISHED,
        ]);

        $publishedProduct2 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'status' => ProductStatusEnum::PUBLISHED,
        ]);

        $this->artisan('sitemap:generate')
            ->assertSuccessful();

        $content = file_get_contents(public_path('sitemap.xml'));
        $this->assertStringContainsString($publishedProduct1->showUrl, $content);
        $this->assertStringContainsString($publishedProduct2->showUrl, $content);
    }

    public function test_it_excludes_draft_products(): void
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);

        $draftProduct = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'status' => ProductStatusEnum::DRAFT,
        ]);

        $publishedProduct = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'status' => ProductStatusEnum::PUBLISHED,
        ]);

        $this->artisan('sitemap:generate')
            ->assertSuccessful();

        $content = file_get_contents(public_path('sitemap.xml'));
        $this->assertStringContainsString($publishedProduct->showUrl, $content);
        $this->assertStringNotContainsString($draftProduct->showUrl, $content);
    }

    public function test_it_excludes_unpublished_articles(): void
    {
        $publishedArticle = Article::factory()->create([
            'is_published' => true,
            'title' => ['es' => 'Artículo publicado', 'en' => 'Published article'],
            'slug' => 'articulo-publicado',
            'content' => ['es' => 'Contenido', 'en' => 'Content'],
            'summary' => ['es' => 'Resumen', 'en' => 'Summary'],
        ]);
        $unpublishedArticle = Article::factory()->create([
            'is_published' => false,
            'title' => ['es' => 'Artículo no publicado', 'en' => 'Unpublished article'],
            'slug' => 'articulo-no-publicado',
            'content' => ['es' => 'Contenido', 'en' => 'Content'],
            'summary' => ['es' => 'Resumen', 'en' => 'Summary'],
        ]);

        $this->artisan('sitemap:generate')
            ->assertSuccessful();

        $content = file_get_contents(public_path('sitemap.xml'));
        $this->assertStringContainsString($publishedArticle->showUrl, $content);
        $this->assertStringNotContainsString($unpublishedArticle->showUrl, $content);
    }

    public function test_it_includes_static_routes(): void
    {
        $this->artisan('sitemap:generate')
            ->assertSuccessful();

        $content = file_get_contents(public_path('sitemap.xml'));

        // Check all static routes are present
        $this->assertStringContainsString(route('home.index'), $content);
        $this->assertStringContainsString(route('faqs.index'), $content);
        $this->assertStringContainsString(route('about-us.index'), $content);
        $this->assertStringContainsString(route('services.index'), $content);
        $this->assertStringContainsString(route('articles.index'), $content);
        $this->assertStringContainsString(route('products.index'), $content);
        $this->assertStringContainsString(route('categories.index'), $content);
    }

    public function test_it_uses_spanish_locale_urls(): void
    {
        $category = Category::factory()->create([
            'slug' => 'categoria-es',
            'slug_en' => 'category-en',
        ]);

        $this->artisan('sitemap:generate')
            ->assertSuccessful();

        $content = file_get_contents(public_path('sitemap.xml'));

        // Should use Spanish slug
        $this->assertStringContainsString('categoria-es', $content);
        $this->assertStringNotContainsString('category-en', $content);
    }

    public function test_it_includes_categories_and_subcategories(): void
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);

        $this->artisan('sitemap:generate')
            ->assertSuccessful();

        $content = file_get_contents(public_path('sitemap.xml'));
        $this->assertStringContainsString($category->showUrl, $content);
        $this->assertStringContainsString($subcategory->showUrl, $content);
    }

    public function test_it_includes_published_policies(): void
    {
        $publishedPolicy = Policy::factory()->create([
            'is_published' => true,
            'title' => ['es' => 'Política publicada', 'en' => 'Published policy'],
            'content' => ['es' => 'Contenido', 'en' => 'Content'],
            'slug' => 'politica-publicada',
        ]);
        $unpublishedPolicy = Policy::factory()->create([
            'is_published' => false,
            'title' => ['es' => 'Política no publicada', 'en' => 'Unpublished policy'],
            'content' => ['es' => 'Contenido', 'en' => 'Content'],
            'slug' => 'politica-no-publicada',
        ]);

        $this->artisan('sitemap:generate')
            ->assertSuccessful();

        $content = file_get_contents(public_path('sitemap.xml'));
        $policyUrl = route('politics.show', ['policy' => $publishedPolicy->slug]);
        $unpublishedPolicyUrl = route('politics.show', ['policy' => $unpublishedPolicy->slug]);

        $this->assertStringContainsString($policyUrl, $content);
        $this->assertStringNotContainsString($unpublishedPolicyUrl, $content);
    }

    public function test_it_can_save_to_custom_path(): void
    {
        $customPath = storage_path('app/test-sitemap.xml');

        $this->artisan('sitemap:generate', ['--path' => $customPath])
            ->assertSuccessful();

        $this->assertFileExists($customPath);

        // Clean up
        if (file_exists($customPath)) {
            unlink($customPath);
        }
    }
}
