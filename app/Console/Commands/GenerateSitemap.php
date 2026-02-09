<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\ProductStatusEnum;
use App\Models\Article;
use App\Models\Category;
use App\Models\Policy;
use App\Models\Product;
use App\Models\Subcategory;
use DateTimeInterface;
use Illuminate\Console\Command;
use SimpleXMLElement;

final class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate {--path= : The path where sitemap.xml will be saved}';

    protected $description = 'Generate sitemap.xml file for search engines';

    public function handle(): int
    {
        // Set locale to Spanish for consistent URL generation
        app()->setLocale('es');

        $this->components->info('Generating sitemap.xml...');

        // Create XML structure
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        // Add static routes
        $this->addStaticRoutes($xml);

        // Add dynamic content
        $this->addCategories($xml);
        $this->addSubcategories($xml);
        $this->addProducts($xml);
        $this->addArticles($xml);
        $this->addPolicies($xml);

        // Save the sitemap
        $path = $this->option('path') ?? public_path('sitemap.xml');
        file_put_contents($path, $xml->asXML());

        $this->components->info("Sitemap generated successfully at: {$path}");

        return self::SUCCESS;
    }

    protected function addStaticRoutes(SimpleXMLElement $xml): void
    {
        $staticRoutes = [
            ['route' => 'home.index', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['route' => 'faqs.index', 'priority' => '0.2', 'changefreq' => 'monthly'],
            ['route' => 'about-us.index', 'priority' => '0.2', 'changefreq' => 'monthly'],
            ['route' => 'services.index', 'priority' => '0.2', 'changefreq' => 'monthly'],
            ['route' => 'articles.index', 'priority' => '0.3', 'changefreq' => 'weekly'],
            ['route' => 'products.index', 'priority' => '0.3', 'changefreq' => 'weekly'],
            ['route' => 'categories.index', 'priority' => '0.2', 'changefreq' => 'monthly'],
        ];

        foreach ($staticRoutes as $routeData) {
            $url = route($routeData['route']);
            $this->addUrl($xml, $url, $routeData['priority'], $routeData['changefreq']);
        }

        $this->components->task('Added static routes', fn () => true);
    }

    protected function addCategories(SimpleXMLElement $xml): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $this->addUrl(
                $xml,
                $category->showUrl,
                '0.4',
                'monthly',
                $category->updated_at
            );
        }

        $this->components->task("Added {$categories->count()} categories", fn () => true);
    }

    protected function addSubcategories(SimpleXMLElement $xml): void
    {
        $subcategories = Subcategory::with('category')->get();

        foreach ($subcategories as $subcategory) {
            $this->addUrl(
                $xml,
                $subcategory->showUrl,
                '0.6',
                'weekly',
                $subcategory->updated_at
            );
        }

        $this->components->task("Added {$subcategories->count()} subcategories", fn () => true);
    }

    protected function addProducts(SimpleXMLElement $xml): void
    {
        $products = Product::with(['subcategory.category'])
            ->where('status', ProductStatusEnum::PUBLISHED)
            ->get();

        foreach ($products as $product) {
            $this->addUrl(
                $xml,
                $product->showUrl,
                '0.8',
                'weekly',
                $product->updated_at
            );
        }

        $this->components->task("Added {$products->count()} published products", fn () => true);
    }

    protected function addArticles(SimpleXMLElement $xml): void
    {
        $articles = Article::where('is_published', true)->get();

        foreach ($articles as $article) {
            $this->addUrl(
                $xml,
                $article->showUrl,
                '0.5',
                'weekly',
                $article->updated_at
            );
        }

        $this->components->task("Added {$articles->count()} published articles", fn () => true);
    }

    protected function addPolicies(SimpleXMLElement $xml): void
    {
        $policies = Policy::where('is_published', true)->get();

        foreach ($policies as $policy) {
            $url = route('politics.show', ['policy' => $policy->slug]);
            $this->addUrl(
                $xml,
                $url,
                '0.3',
                'monthly',
                $policy->updated_at
            );
        }

        $this->components->task("Added {$policies->count()} published policies", fn () => true);
    }

    protected function addUrl(
        SimpleXMLElement $xml,
        string $url,
        string $priority,
        string $changefreq,
        ?DateTimeInterface $lastmod = null
    ): void {
        $urlElement = $xml->addChild('url');
        $urlElement->addChild('loc', htmlspecialchars($url, ENT_XML1, 'UTF-8'));
        $urlElement->addChild('priority', $priority);
        $urlElement->addChild('changefreq', $changefreq);

        if ($lastmod) {
            $urlElement->addChild('lastmod', $lastmod->format('Y-m-d'));
        }
    }
}
