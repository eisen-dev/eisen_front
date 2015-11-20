<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/11/18
 * Time: 10:08
 */
class restclient
{
    public function restconnect($rest_host,$rest_port,$username,$password)
    {
        include(dirname(__FILE__).'/rest_client/httpful.phar');
        $uri = 'http://'.$rest_host.':'.$rest_port.'/todo/api/v1.0/agent';
        $response = \Httpful\Request::get($uri)
            ->authenticateWith('ansible', 'default')
            ->send();
        $max = sizeof($response);
        for($i = 0; $i < $max;$i++){
            if (!empty($response)) {
                return 'online';
            }else{
                return "offline";
            }
        }
    }

    public function host_list($rest_host,$rest_port,$username,$password)
    {
        include(dirname(__FILE__).'/rest_client/httpful.phar');
        $uri = 'http://'.$rest_host.':'.$rest_port.'/todo/api/v1.0/hosts';
        $response = \Httpful\Request::get($uri)
            ->authenticateWith('ansible', 'default')
            ->send();
        $hosts = array();
        $max = sizeof($response->body->host);
        for($i = 0; $i < $max;$i++){
            if (!empty($response->body->host[$i])) {
                $hosts[]=($response->body->host[$i]);
            }
        }
        return $hosts;
    }
    public function tasks_list($rest_host,$rest_port,$username,$password)
    {
        include(dirname(__FILE__).'/rest_client/httpful.phar');
        $uri = 'http://'.$rest_host.':'.$rest_port.'/todo/api/v1.0/tasks';
        $response = \Httpful\Request::get($uri)
            ->authenticateWith('ansible', 'default')
            ->send();
        $tasks = array();
        $max = sizeof($response->body->tasks);
        for($i = 0; $i < $max;$i++){
            if (!empty($response->body->tasks[$i])) {
                $tasks[] = ($response->body->tasks[$i]);
            }
        }
        return $tasks;
    }

    public function tasks_run($rest_host,$rest_port,$username,$password,$task_id)
    {
        include(dirname(__FILE__).'/rest_client/httpful.phar');
        $uri = 'http://'.$rest_host.':'.$rest_port.'/todo/api/v1.0/task/'.$task_id.'/run';
        $response = \Httpful\Request::get($uri)
            ->authenticateWith('ansible', 'default')
            ->send();
        $body = array();
        $max = sizeof($response->body->task);
        //var_dump($response);
        for($i = 0; $i < $max;$i++){
            if (!empty($response->body->task)) {
                $body[] = ($response->body->task);
            }
        }
        return $body;
    }

    public function Register($rest_host,$rest_port,$username,$password,$task_id)
    {
        //$response = \Httpful\Request::post($uri2)                  // Build a PUT request...
        //->sendsJson()                               // tell it we're sending (Content-Type) JSON...
        //->authenticateWith('ansible', 'default')  // authenticate with basic auth...
        //->body('{"hosts":"vmware","command":"uptime","module":"shell"}')             // attach a body/payload...
        //->send();                                   // and finally, fire that thing off!
        include(dirname(__FILE__).'/rest_client/httpful.phar');
        $uri = 'http://'.$rest_host.':'.$rest_port.'/todo/api/v1.0/task/'.$task_id.'/run';
        $response = \Httpful\Request::get($uri)
            ->authenticateWith('ansible', 'default')
            ->send();
        $body = array();
        $max = sizeof($response->body->task);
        //var_dump($response);
        for($i = 0; $i < $max;$i++){
            if (!empty($response->body->task)) {
                $body[] = ($response->body->task);
            }
        }
        return $body;
    }
}