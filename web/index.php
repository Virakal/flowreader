<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/templates',
));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->run();
