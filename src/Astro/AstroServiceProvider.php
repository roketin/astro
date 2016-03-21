<?php
namespace Roketin\Astro;

/**
 * This file is part of Astro,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Roketin\Astro
 */

use Illuminate\Support\ServiceProvider;

class AstroServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('astro.php'),
        ]);

        // Register commands
        $this->commands('command.astro.migration');

        // Register blade directives
        $this->bladeDirectives();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAstro();

        $this->registerCommands();

        $this->mergeConfig();
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        // Call to Astro::hasRole
        \Blade::directive('role', function ($expression) {
            return "<?php if (\\Astro::hasRole{$expression}) : ?>";
        });

        \Blade::directive('endrole', function ($expression) {
            return "<?php endif; // Astro::hasRole ?>";
        });

        // Call to Astro::can
        \Blade::directive('permission', function ($expression) {
            return "<?php if (\\Astro::can{$expression}) : ?>";
        });

        \Blade::directive('endpermission', function ($expression) {
            return "<?php endif; // Astro::can ?>";
        });

        // Call to Astro::ability
        \Blade::directive('ability', function ($expression) {
            return "<?php if (\\Astro::ability{$expression}) : ?>";
        });

        \Blade::directive('endability', function ($expression) {
            return "<?php endif; // Astro::ability ?>";
        });
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerAstro()
    {
        $this->app->bind('astro', function ($app) {
            return new Astro($app);
        });

        $this->app->alias('astro', 'Roketin\Astro\Astro');
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.astro.migration', function ($app) {
            return new MigrationCommand();
        });
    }

    /**
     * Merges user's and astro's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'astro'
        );
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.astro.migration',
        ];
    }
}
