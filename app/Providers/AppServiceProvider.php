<?php

namespace App\Providers;

use App\Http\Clients\EmployeesClient;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Resource::withoutWrapping();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EmployeesClient::class, function(){
            $config = $this->app->get('config')['employees'];

            return new EmployeesClient([
                'base_uri' => $config['base_uri']
            ]);
        });
    }
}
