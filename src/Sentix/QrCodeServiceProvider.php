<?php

namespace Sentix;

use Illuminate\Support\ServiceProvider;

class QrCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // Merge default configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../config/qr_code.php', // Use __DIR__ here
            'qr_code'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/qr_code.php' => dirname(__DIR__, 3) . '/config/qr_code.php', // Adjust path accordingly
        ], 'config');
    }
}
