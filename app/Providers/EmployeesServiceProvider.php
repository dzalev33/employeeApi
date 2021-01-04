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
            $config = $this->app->get('config')['employees'];

            return new EmployeesClient([
                'base_uri' => $config['base_uri']
            ]);
        });
    }
}
