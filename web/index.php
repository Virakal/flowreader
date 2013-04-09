<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = Flow\Bootstrap::bootstrap();

// Admin
$app->get('/admin', function () use ($app) {
    $chapter = new Flow\Entities\Chapter();

    $chapter->setTitle('Test Chapter')
        ->setChapterNo(1)
        ->setDate(new DateTime('now', new DateTimeZone('UTC')))
        ->setSeries($app['orm.em']->find('e:Series', 1));

    $app['orm.em']->persist($chapter);
    $app['orm.em']->flush();

    return "Made {$chapter->getId()} with name {$chapter->getTitle()}";
});

// Page
$app->get('/{series}/{chapter}/{page}',
    function ($series, $chapter, $page) use ($app) {

    return 'placeholder';
});

// Chapter
$app->get('/{series}/{chapter}',
    function ($series, $chapter) use ($app) {

    return 'placeholder';
});

// Series
$app->get('/{series}',
    function ($series) use ($app) {

    $dql = 'SELECT s FROM e:Series s WHERE s.name = ?1';

    $seriesEntity = $app['orm.em']->createQuery($dql)
        ->setParameter(1, $series)
        ->getSingleResult();

    return $app['twig']->render('series/index.html.twig', array(
        'series' => $seriesEntity,
        'chapters' => $seriesEntity->getChapters(),
    ));
});

// Index
$app->get('/', function () use ($app) {
    $dql = 'SELECT COUNT(p) FROM e:Page p';

    $query = $app['orm.em']->createQuery($dql);

    $pageCount = $query->getSingleScalarResult();

    return $app['twig']->render('index.html.twig', array(
        'pageCount' => $pageCount,
    ));
});

$app->run();
