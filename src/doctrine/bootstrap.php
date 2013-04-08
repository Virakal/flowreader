<?php

use Symfony\Component\Yaml\Yaml;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$appConfig = Yaml::parse(__DIR__ . '/../../config/config.yaml');

$isDevMode = isset($appConfig['environment']['devMode']) && $appConfig['environment']['devMode'];

$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/../../config/objects"), $isDevMode);

$entityManager = EntityManager::create($appConfig['database'], $config);