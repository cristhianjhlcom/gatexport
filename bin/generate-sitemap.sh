#!/bin/bash

set -e

echo "🗺️  Starting sitemap generation..."

# Change to project root directory
cd "$(dirname "$0")/.."

echo "→ Generating sitemap.xml..."
php artisan sitemap:generate

if [ -f "public/sitemap.xml" ]; then
    file_size=$(stat -f%z "public/sitemap.xml" 2>/dev/null || stat -c%s "public/sitemap.xml" 2>/dev/null)
    echo "✅ Sitemap generated successfully! (${file_size} bytes)"
    echo "   Location: public/sitemap.xml"
else
    echo "❌ Sitemap generation failed!" >&2
    exit 1
fi
