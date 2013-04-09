<?php

require_once __DIR__ . "/src/Flow/Bootstrap.php";
use Doctrine\ORM\Tools\Setup;use Doctrine\ORM\EntityManager;
$app = Flow\Bootstrap::bootstrap();

$entityManager = $app['orm.em'];

$helperSet = new Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager)
));