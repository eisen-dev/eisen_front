<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/11/19
 * Time: 10:20
 */
require_once __DIR__."/restclient.php";
require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";

$me = new Session();
$me->start_session();
$me->is_session_started();

$task_id = $_GET['id'];

$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

$machine = $dba->MachineList($user_id,$dbh);
$module=$machine[0];
$ipaddress=$machine[1];
$port=$machine[2];
$username=$machine[3];
$password=$machine[4];
$rest = new restclient();
//$rest->restconnect($ipaddress,$port,$username,$password);
$hosts = $rest->tasks_run($ipaddress,$port,$username,$password,$task_id);
var_dump($hosts);

foreach ($hosts as $i=>$row) {
    var_dump($i);
    var_dump($row);
}

