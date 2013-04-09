<?php

namespace Flow;

use Silex\Application;
use Silex\ServiceProviderInterface;

class UrlGeneratorServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['url'] = $app->share(function ($app) {
            return new UrlGenerator();
        });
    }

    public function boot(Application $app)
    {
    }
}