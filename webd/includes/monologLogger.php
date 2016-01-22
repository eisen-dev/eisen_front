<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/monologDB.php';
use Monolog\Handler\SlackHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Logger;

/**
 * Class loggerStart
 */
 class LoggerAtOnce
{
    /**
     * @return Logger
     */
    public function loggerInject()
    {

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
        ));
        $log->pushHandler(new BrowserConsoleHandler(\Monolog\Logger::INFO));
        $log->pushHandler(new StreamHandler('php://stderr', \Monolog\Logger::ERROR));
        return $log;
    }
}