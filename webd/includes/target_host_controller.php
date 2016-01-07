<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2016/01/07
 * Time: 10:22
 */
require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";
require_once __DIR__."/restclient.php";

class TargetHostController
{
    public function get_TargetHost($user_id)
    {
        $dba = new DbAction();
        $dbh = $dba->Connect();
        $machine = $dba->MachineList($user_id,$dbh);
        $module=$machine[0];
        $ipaddress=$machine[1];
        $port=$machine[2];
        $username=$machine[3];
        $password=$machine[4];
        $rest = new restclient();
        $hosts = $rest->host_list($ipaddress,$port,$username,$password);
        $this->check_os($hosts, $ipaddress, $port, $username, $password);
        return $hosts;
    }

    public function check_os($hosts, $rest_host, $rest_port, $username, $password){
        $rest = new restclient();
        $command = "cat /etc/*{release,version}";
        $module = "shell";
        $task_id = $rest->task_register($rest_host, $rest_port, $username, $password, $hosts, $command, $module);
        $rest->tasks_run($rest_host, $rest_port, $username, $password, $task_id);
        $result = $rest->tasks_result($rest_host, $rest_port, $username, $password, $task_id);
        var_dump($result);
    }



}