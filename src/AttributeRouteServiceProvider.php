<?php

namespace Diyorbek\AttributeRoutes;

use Illuminate\Support\ServiceProvider;

class AttributeRouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $registrar = new AttributeRouteRegistrar();
        $registrar->registerRoutes();
    }

    public function register()
    {
        //
    }
}
