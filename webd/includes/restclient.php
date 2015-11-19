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
                var_dump($response);
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
            if (!empty($response->body->host[$i]->host)) {
                $hosts[]=($response->body->host[$i]->host);
            }
        }
        return $hosts;
    }
}