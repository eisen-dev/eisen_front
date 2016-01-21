<?php

use Monolog\Handler\SlackHandler;
use Monolog\Logger;

/**
 * @return Logger
 */
public function logger()
{
    require_once __DIR__ . '/../../vendor/autoload.php';
    require_once __DIR__ . '/monologDB.php';
    $dba = new DbAction();
    $dbh = $dba->Connect();
    $log = new Logger('name');
    // create a log channel
    $log->pushHandler(new PDOHandler($dbh));
    $log->pushHandler(new SlackHandler(
        '',
        '#logger',
        'Monolog',
        true,
        null,
        Logger::INFO
    )
    );
    return $log;
}