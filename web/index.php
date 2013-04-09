<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = Flow\Bootstrap::bootstrap();

$app->get('/', function () use ($app) {
    $dql = 'SELECT COUNT(p) FROM e:Page p';

    $query = $app['orm.em']->createQuery($dql);

    $pageCount = $query->getSingleScalarResult();

    return $app['twig']->render('index.html.twig', array(
        'pageCount' => $pageCount,
    ));
});

$app->run();
