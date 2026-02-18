<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\Category;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            // Cache categories for 24 hours to improve performance
            // This prevents database queries on every request
            $categories = Cache::remember('app.categories', 86400, function () {
                return Category::all();
            });
            view()->share('categories', $categories);
        } catch (\Exception $e) {
            // Handle case when database tables don't exist yet
        }

        // Register image helper Blade directive
        Blade::directive('image', function ($expression) {
            return "<?php echo asset(\\App\\Helpers\\ImageHelper::getImagePath({$expression})); ?>";
        });
    }
}

