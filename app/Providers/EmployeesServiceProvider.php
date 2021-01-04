<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Clients\EmployeesClient;

class EmployeesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EmployeesClient::class, function(){
            return new EmployeesClient([
                'base_uri' => 'http://technical_test.client.cosmicdevelopment.com/'
            ]);
        });
    }
}
