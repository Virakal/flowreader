<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Application();

// Config
$app['config'] = Yaml::parse(__DIR__ . '/../config/config.yaml');

// Twig
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/templates',
));

// Doctrine
$app->register(new DoctrineServiceProvider(), array(
    'db.options' => $app['config']['database'],
));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->run();
