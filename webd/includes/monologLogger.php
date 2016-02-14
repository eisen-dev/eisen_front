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
        $config = (parse_ini_file(realpath("../config.ini")));
        $log = new Logger('name');
        // create a log channel
        $log->pushHandler(new PDOHandler($dbh));
        if (isset($config['token'])) {
            $log->pushHandler(new SlackHandler(
                $config['token'],
                $config['channel'],
                $config['botname'],
                true,
                null,
                Logger::INFO
            ));
        }
        $log->pushHandler(new BrowserConsoleHandler(\Monolog\Logger::INFO));
        $log->pushHandler(new StreamHandler('php://stderr', \Monolog\Logger::ERROR));
        return $log;
    }
}
