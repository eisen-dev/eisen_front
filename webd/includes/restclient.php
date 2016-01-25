<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/monologLogger.php';
require_once __DIR__ . '/DbAction.php';

use Httpful\Exception\ConnectionErrorException;
use Monolog\Logger;


/**
 * Class restclient
 */
class restclient
{
    /**
     * @return Logger
     */
    public function logger()
    {
        $log = new LoggerAtOnce();
        $log = $log->loggerInject();

        return $log;
    }

    /**
     * @param $rest_host
     * @param $rest_port
     * @param $username
     * @param $password
     *
     * @return string
     */
    public function restconnect($rest_host, $rest_port, $username, $password)
    {
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/agent';
            $response = \Httpful\Request::get($uri)
                ->authenticateWith($username, $password)
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->send();
            $max = count($response);
            for ($i = 0; $i < $max; $i++) {
                if (!empty($response)) {
                    return 'online';
                }
            }
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
        return 'offline';
    }

    public function host_list($rest_host, $rest_port, $username, $password)
    {
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/hosts';
            $response = \Httpful\Request::get($uri)
                ->authenticateWith($username, $password)
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->send();
            $max = count($response->body->host);
            for ($i = 0; $i < $max; $i++) {
                if (!empty($response->body->host[$i])) {
                    $hosts[] = ($response->body->host[$i]);
                }
            }
        } catch (ConnectionErrorException $ex) {
            //$this->errorHandler($ex);
        }
        if (isset($hosts)) {
            return $hosts;
        }
    }

    public function tasks_list($rest_host, $rest_port, $username, $password)
    {
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/tasks';
            $response = \Httpful\Request::get($uri)
                ->authenticateWith($username, $password)
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->send();
            $tasks = array();
            $max = count($response->body->tasks);
            for ($i = 0; $i < $max; $i++) {
                if (!empty($response->body->tasks[$i])) {
                    $tasks[] = ($response->body->tasks[$i]);
                }
            }
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
        if (isset($tasks)) {
            return $tasks;
        }
    }

    public function variable_list($rest_host, $rest_port, $username, $password)
    {
        try {
            $host_id=1;
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/host/'.$host_id.'/vars';
            $response = \Httpful\Request::get($uri)
                ->authenticateWith($username, $password)
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->send();
            $tasks = array();
            $max = count($response->body->var);
            for ($i = 0; $i < $max; $i++) {
                if (!empty($response->body->var[$i])) {
                    $tasks[] = ($response->body->var[$i]);
                    foreach ($tasks as $x => $row) {
                        $tasks[$x]->manager_host = $rest_host;
                    }
                }
            }
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
        return $tasks;
    }

    public function tasks_run($rest_host, $rest_port, $username, $password, $task_id)
    {
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/task/' . $task_id . '/run';
            $response = \Httpful\Request::get($uri)
                ->authenticateWith($username, $password)
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->send();
            $body = array();
            $max = count($response->body->task);
            //var_dump($response);
            for ($i = 0; $i < $max; $i++) {
                if (!empty($response->body->task)) {
                    $body[] = ($response->body->task);
                }
            }
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
        return $body;
    }

    /**
     * @param $rest_host
     * @param $rest_port
     * @param $username
     * @param $password
     * @param $task_id
     * @return \Httpful\Response|mixed
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function tasks_result($rest_host, $rest_port, $username, $password, $task_id)
    {
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/task/' . $task_id . '/result';
            $response = \Httpful\Request::get($uri)
                ->authenticateWith($username, $password)
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->send();
            # convert json from stdobject to array
            $response = json_decode($response->raw_body, true);
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
        return $response;
    }

    /**
     * @param $rest_host
     * @param $rest_port
     * @param $username
     * @param $password
     * @param $host
     * @param $groups
     */
    public function host_register(
        $rest_host,
        $rest_port,
        $username,
        $password,
        $host,
        $groups
    ) {
        try {
            if (empty($groups)) {
                $groups = '';
            }
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/hosts';
            $response = \Httpful\Request::post($uri)
                ->sendsJson()// tell it we're sending (Content-Type) JSON...
                ->authenticateWith($username, $password)
                ->body('{"host":"' . $host . '","groups":"' . $groups . '"}')// attach a body/payload...
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->sendIt();
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
    }

    /**
     * @param $rest_host
     * @param $rest_port
     * @param $username
     * @param $password
     * @param $hosts
     * @param $command
     * @param $module
     *
     * @return mixed
     */
    public function task_register(
        $rest_host,
        $rest_port,
        $username,
        $password,
        $hosts,
        $command,
        $module
    ) {
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/tasks';
            $response = \Httpful\Request::post($uri)
                ->sendsJson()// tell it we're sending (Content-Type) JSON...
                ->authenticateWith($username, $password)
                ->body(
                    '{"hosts":"' .
                    $hosts .
                    '","command":"' .
                    $command .
                    '","module":"' .
                    $module .
                    '"}'
                )// attach a body/payload...
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->sendIt();
            $uri = $response->body->task->uri;
            $uri = explode("/", $uri);
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
        return $uri[5];
    }

    /**
     * @param $rest_host
     * @param $rest_port
     * @param $username
     * @param $password
     * @param $hosts
     * @param $command
     * @param $module
     *
     * @return mixed
     */
    public function package_Action(
        $rest_host,
        $rest_port,
        $username,
        $password,
        $targetHost,
        $targetOs,
        $packageName,
        $packageVersion,
        $packageAction
    ) {
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/packages';
            $response = \Httpful\Request::post($uri)
                ->sendsJson()// tell it we're sending (Content-Type) JSON...
                ->authenticateWith($username, $password)
                ->body(
                    '{"targetHost":"' .
                    $targetHost .
                    '","targetOs":"' .
                    $targetOs .
                    '","packageName":"' .
                    $packageName .
                    '","packageVersion":"' .
                    $packageVersion .
                    '","packageAction":"' .
                    $packageAction .
                    '"}'
                )// attach a body/payload...
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->sendIt();
            $uri = $response->body->task->uri;
            $uri = explode("/", $uri);
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
        return $uri[5];
    }

    /**
     * @param $rest_host
     * @param $rest_port
     * @param $username
     * @param $password
     * @param $target_host
     * @param $variable_key
     * @param $variable_value
     */
    public function variableRegister(
        $rest_host,
        $rest_port,
        $username,
        $password,
        $target_host,
        $variable_key,
        $variable_value
    ) {
        $host_id = 1;
        try {

            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/host/'.$host_id.'/vars';
            $response = \Httpful\Request::post($uri)
                ->sendsJson()// tell it we're sending (Content-Type) JSON...
                ->authenticateWith($username, $password)
                ->body(
                    '{"host":"' . $target_host .
                    '","variable_key":"' .
                    $variable_key .
                    '","variable_value":"' .
                    $variable_value .
                    '"}'
                )// attach a body/payload...
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->sendIt();
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
    }

    public function tasks_delete($rest_host, $rest_port, $username, $password, $task_id)
    {
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/task/' . $task_id;
            $response = \Httpful\Request::delete($uri)
                ->authenticateWith($username, $password)
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->send();
            //var_dump($response);
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
    }

    /**
     * @param $rest_host
     * @param $rest_port
     * @param $username
     * @param $password
     *
     * @return \Httpful\Response|mixed|null
     */
    public function check_os($rest_host, $rest_port, $username, $password)
    {
        $response = null;
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/os_check';
            $response = \Httpful\Request::get($uri)
                ->authenticateWith($username, $password)
                ->send();
            # convert json from stdobject to array
            $response = json_decode($response->raw_body, true);
        } catch (ConnectionErrorException $ex) {
            // set host manager offline
            $dba = new DbAction();
            $dbh = $dba->Connect();
            $dba->hostManagerStatus($dbh, $rest_host, 'offline');
        }
        return $response;
    }

    public function updatePackage($rest_host, $rest_port, $username, $password)
    {
        try {
            $uri = 'http://' . $rest_host . ':' . $rest_port . '/eisen/api/v1.0/package_retrieve';
            $response = \Httpful\Request::get($uri)
                ->authenticateWith($username, $password)
                ->whenError(
                    function ($error) {
                        $this->errorHandler($error);
                    }
                )
                ->send();
            # convert json from stdobject to array
            $response = json_decode($response->raw_body, true);
        } catch (ConnectionErrorException $ex) {
            $this->errorHandler($ex);
        }
        return $response;
    }

    public function errorHandler($error)
    {
        $log = $this->logger();
        $log->addError($error);
    }
}
