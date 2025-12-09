<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS in production and non-local environments
        if (! $this->app->environment('local')) {
            URL::forceScheme('https');

            // Get the current request's host and force HTTPS for assets
            if (request()->hasHeader('X-Forwarded-Host')) {
                $host = request()->header('X-Forwarded-Host');
                URL::forceRootUrl('https://' . $host);
            }
        }
    }
}
