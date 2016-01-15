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
$action =$_GET['action'];

$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

$machine = $dba->MachineList($user_id,$dbh);
    $machine_id=$machine[0];
    $module=$machine[1];
    $ipaddress=$machine[2];
    $port=$machine[3];
    $username=$machine[4];
    $password=$machine[5];
$rest = new restclient();
//$rest->restconnect($ipaddress,$port,$username,$password);
if (strcmp($action, "start") == 0) {
    $hosts = $rest->tasks_run($ipaddress, $port, $username, $password, $task_id);
    var_dump($hosts);

    foreach ($hosts as $i => $row) {
        var_dump($i);
        var_dump($row);
    }
}

if (strcmp($action, "result") == 0) {
    $hosts = $rest->tasks_result($ipaddress, $port, $username, $password, $task_id);
    Kint::dump($hosts);

    foreach ($hosts as $i => $row) {
        Kint::dump($i);
        Kint::dump($row);
    }
}