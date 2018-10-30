<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use Carbon\Carbon;
use App\Http\Composers\PostSidebarComposer;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViewComposers();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }

        Carbon::setLocale(config('app.locale')); //Esta linea puede estar en cualquier service provider
    }

    protected function registerViewComposers()
    {
        View::composer('posts.sidebar', PostSidebarComposer::class);
    }
}
