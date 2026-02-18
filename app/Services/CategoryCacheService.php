<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CategoryCacheService
{
    /**
     * Clear category cache
     * Call this whenever a category is created, updated, or deleted
     */
    public static function clearCache()
    {
        Cache::forget('app.categories');
    }

    /**
     * Warm up the category cache
     */
    public static function warmCache()
    {
        return Cache::remember('app.categories', 86400, function () {
            return \App\Models\Category::all();
        });
    }
}
