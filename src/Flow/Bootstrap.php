<?php

namespace Flow;

use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Doctrine\ORM\Mapping\Driver\YamlDriver;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\Yaml\Yaml;

class Bootstrap
{
    public static function bootstrap()
    {
        $app = new Application();

        // Config
        $app['config'] = Yaml::parse(__DIR__ . '/../../config/config.yaml');

        // Debug mode
        $app['debug'] = isset($app['config']['environment']['devMode'])
            && $app['config']['environment']['devMode'];

        // Twig
        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__ . '/Resources/Templates',
        ));

        // Doctrine DBAL
        $app->register(new DoctrineServiceProvider(), array(
            'db.options' => $app['config']['database'],
        ));

        // Doctrine ORM
        $app->register(new DoctrineOrmServiceProvider(), array(
            'orm.proxies_dir' => __DIR__ . '/../DoctrineProxy',
            'orm.em.options' => array(
                'mappings' => array(
                    array(
                        'type' => 'yml',
                        'namespace' => 'Flow\Entities',
                        'path' => realpath(__DIR__ . '/../../config/entities/'),
                    ),
                ),
            ),
        ));

        $app['orm.em']->getConfiguration()
            ->addEntityNamespace('e', 'Flow\Entities');

        // Locale
        date_default_timezone_set($app['config']['environment']['timezone']);

        // URL Generator
        $app->register(new UrlGeneratorServiceProvider());

        return $app;
    }
}