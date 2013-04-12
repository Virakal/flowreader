<?php

require_once __DIR__ . '/vendor/virakal/cli/Cli.php';

class Cli extends Virakal\Cli\Cli
{
    public static function header($text)
    {
        return Cli::colour('* ' . $text, 'white', 'blue', array('bold')) . PHP_EOL . PHP_EOL;
    }

    public static function step($text)
    {
        return Cli::colour($text, null, null, array('bold')) . '...' . PHP_EOL;
    }
}

echo PHP_EOL;

echo Cli::header('FlowReader Installer');

echo Cli::step('Running Composer');

Cli::execInteractive('./composer.phar install 2>&1');

require_once __DIR__ . '/vendor/autoload.php';