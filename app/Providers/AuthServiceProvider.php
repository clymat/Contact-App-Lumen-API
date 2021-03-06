<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
   {
     $this->app['auth']->viaRequest('api', function ($request) {
     if ($request->header('Authorization')) {
       return User:: where('accessTokens', '=', $request->header('Authorization'))->first();
     }
     });
   }

}
