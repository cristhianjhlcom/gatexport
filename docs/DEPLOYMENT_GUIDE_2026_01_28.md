# Deployment Guide - 2026-01-28

This document provides step-by-step instructions to deploy the changes made on January 28, 2026.

---

## Pre-Deployment Checklist

- [ ] Backup the production database
- [ ] Backup the current production files
- [ ] Notify users of potential downtime (if applicable)
- [ ] Ensure you have FTP/SSH access to the server

---

## Database Migration Required

**IMPORTANT:** This deployment includes a database migration that adds `slug_en` columns to three tables.

### Migration File:
```
database/migrations/2026_01_28_210246_add_slug_en_to_categories_subcategories_products_tables.php
```

### Tables Affected:
- `categories` - adds `slug_en` column (nullable, unique)
- `subcategories` - adds `slug_en` column (nullable, unique)
- `products` - adds `slug_en` column (nullable, unique)

---

## Deployment Steps

### Step 1: Enable Maintenance Mode (Optional but Recommended)
```bash
php artisan down --secret="your-secret-token"
```

### Step 2: Upload Files via FTP

Upload all modified files listed in the "Files to Upload" section below.

### Step 3: Run Database Migration
```bash
php artisan migrate --force
```

### Step 4: Clear Application Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Step 5: Rebuild Cache (Production)
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 6: Disable Maintenance Mode
```bash
php artisan up
```

---

## Files to Upload via FTP

### PHP Files - Controllers (4 files)
```
app/Http/Controllers/Admin/ImageDeleteController.php
app/Http/Controllers/Admin/ImageUploadController.php
app/Http/Middleware/RoleMiddleware.php
routes/public.php
```

### PHP Files - Livewire Components (14 files)
```
app/Livewire/Admin/Articles/CreateArticle.php
app/Livewire/Admin/Articles/UpdateArticle.php
app/Livewire/Admin/Categories/CategoryEditManagement.php
app/Livewire/Admin/Categories/CategoryIndexManagement.php
app/Livewire/Admin/Products/ProductEditManagement.php
app/Livewire/Admin/Subcategories/SubcategoryCreateManagement.php
app/Livewire/Admin/Subcategories/SubcategoryIndexManagement.php
app/Livewire/Admin/Users/UserCreateManagement.php
app/Livewire/Admin/Users/UserIndexManagement.php
app/Livewire/Forms/Admin/CategoryManagementForm.php
app/Livewire/Forms/Admin/ProductManagementForm.php
app/Livewire/Forms/Admin/SubcategoryManagementForm.php
app/Livewire/Public/Products/CategoriesCatalog.php
app/Livewire/Public/Products/PageView.php
app/Livewire/Public/Products/SubcategoriesCatalog.php
```

### PHP Files - Models (3 files)
```
app/Models/Category.php
app/Models/Product.php
app/Models/Subcategory.php
```

### PHP Files - Other (4 files)
```
app/Observers/SettingObserver.php
app/Policies/CategoryPolicy.php
app/View/Components/Common/MobileNavigation.php
app/View/Components/Common/Navigation.php
app/View/Components/Common/StickyHeader.php
```

### PHP Files - Migration (1 file)
```
database/migrations/2026_01_28_210246_add_slug_en_to_categories_subcategories_products_tables.php
```

### Blade View Files (7 files)
```
resources/views/livewire/admin/categories/create.blade.php
resources/views/livewire/admin/categories/edit.blade.php
resources/views/livewire/admin/products/content.blade.php
resources/views/livewire/admin/subcategories/create.blade.php
resources/views/livewire/admin/subcategories/edit.blade.php
resources/views/livewire/admin/subcategories/index.blade.php
resources/views/partials/category-menu.blade.php
```

### Documentation Files (Optional - 2 files)
```
docs/FEATURES_SESSION_2026_01_28.md
docs/DEPLOYMENT_GUIDE_2026_01_28.md
```

---

## Summary: Total Files to Upload

| Category | Count |
|----------|-------|
| Controllers & Middleware | 4 |
| Livewire Components | 15 |
| Models | 3 |
| Observers & Policies | 2 |
| View Components | 3 |
| Migration | 1 |
| Blade Views | 7 |
| **Total** | **35** |

---

## Post-Deployment Verification

### 1. Test Multi-Language Slugs
- [ ] Navigate to admin panel and edit a category
- [ ] Add an English slug to a category
- [ ] Verify the category is accessible via both Spanish and English URLs
- [ ] Repeat for subcategories and products

### 2. Test Admin Functionality
- [ ] Create a new category with both slugs
- [ ] Create a new subcategory with both slugs
- [ ] Create a new product with both slugs
- [ ] Delete a subcategory (should fail if it has products)
- [ ] Delete a subcategory without products (should succeed)

### 3. Test Public Pages
- [ ] Visit product listing page - verify it loads quickly
- [ ] Navigate using category menu - verify links work
- [ ] Test English URLs (if English slugs are configured)

### 4. Test Navigation
- [ ] Click on category buttons in the navigation menu
- [ ] Verify they navigate to the category page
- [ ] Verify hover still shows subcategories dropdown

---

## Rollback Plan

If issues occur, follow these steps:

### 1. Restore Files
Upload the backup files via FTP.

### 2. Rollback Migration (if needed)
```bash
php artisan migrate:rollback --step=1
```
This will remove the `slug_en` columns from all three tables.

### 3. Clear Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

---

## Features Included in This Deployment

1. **Multi-Language Slug Support** - Categories, subcategories, and products now support English slugs with fallback to Spanish
2. **Editable Slugs** - Spanish slugs are now editable in admin forms
3. **Subcategory Delete** - Admin can delete subcategories (blocked if products exist)
4. **Position-Based Ordering** - Consistent ordering by position across the application
5. **Clickable Category Navigation** - Category buttons now link to category pages
6. **Performance Improvements** - Fixed N+1 queries in product listings
7. **Bug Fixes** - Multiple security and validation fixes

For detailed feature descriptions, see `docs/FEATURES_SESSION_2026_01_28.md`.

---

## Support

If you encounter any issues during deployment, check:
1. Laravel logs: `storage/logs/laravel.log`
2. PHP error logs on your server
3. Browser console for JavaScript errors
