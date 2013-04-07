<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

// Config
$app['config'] = Symfony\Component\Yaml\Yaml::parse(__DIR__ . '/../config.yaml');

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/templates',
));

// Doctrine
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $app['config']['database'],
));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->run();
