<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\Common\Collections\Criteria;
use Doctrine\Orm\Query;

$app = Flow\Bootstrap::bootstrap();

// Admin
$app->get('/admin', function () use ($app) {
    $em = $app['orm.em'];
    $page = new Flow\Entities\Page();

    //$series = $em->find('e:Series', 1);
    $page->setPageNo(1)
        ->setChapter($em->find('e:Chapter', 3))
        ->setFilename('test/3/1.png');

    $em->persist($page);
    $em->flush();

    return "Yadda yadda";
});

// Page
$app->get('/{series}/{chapter}/{page}/',
    function ($series, $chapter, $page) use ($app) {
        $dql = 'SELECT p FROM e:Page p JOIN p.chapter c JOIN c.series s'
         . ' WHERE s.slug = ?1 AND c.chapter_no = ?2'
         . ' ORDER BY c.chapter_no DESC';

    $pageList = $app['orm.em']->createQuery($dql)
        ->setParameter(1, $series)
        ->setParameter(2, $chapter)
        ->getResult(Query::HYDRATE_OBJECT);

    $pageList = new Doctrine\Common\Collections\ArrayCollection($pageList);

    $pageEntity = $pageList->matching(Criteria::create()
        ->where(Criteria::expr()->eq('pageNo', (int) $page))
    )->first();

    return $app['twig']->render('page/index.html.twig', array(
        'page' => $pageEntity,
        'pages' => $pageList,
        'chapter' => $pageEntity->getChapter(),
        'series' => $pageEntity->getChapter()->getSeries(),
    ));
});

// Chapter
$app->get('/{series}/{chapter}/',
    function ($series, $chapter) use ($app) {
    $dql = 'SELECT c FROM e:Chapter c JOIN c.pages p JOIN c.series s'
         . ' WHERE s.slug = ?1 AND c.chapter_no = ?2'
         . ' ORDER BY c.chapter_no DESC';

    $chapterEntity = $app['orm.em']->createQuery($dql)
        ->setParameter(1, $series)
        ->setParameter(2, $chapter)
        ->getSingleResult();

    return $app['twig']->render('chapter/index.html.twig', array(
        'chapter' => $chapterEntity,
        'series' => $chapterEntity->getSeries(),
        'pages' => $chapterEntity->getPages(),
    ));
});

// Series
$app->get('/{series}/',
    function ($series) use ($app) {

    $dql = 'SELECT s FROM e:Series s JOIN s.chapters c'
         . ' WHERE s.name = ?1 ORDER BY c.chapter_no';

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
    $dql = 'SELECT s FROM e:Series s ORDER BY s.name';

    $query = $app['orm.em']->createQuery($dql);

    $seriesList = $query->getResult();

    return $app['twig']->render('index.html.twig', array(
        'seriesList' => $seriesList,
    ));
});

$app->run();
