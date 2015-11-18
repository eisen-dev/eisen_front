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
        include('includes/rest_client/httpful.phar');
        $uri = 'http://'.$rest_host.':'.$rest_port.'/todo/api/v1.0/agent';
        $response = \Httpful\Request::get($uri)
            ->authenticateWith('ansible', 'default')
            ->send();
    }
}