<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/11/24
 * Time: 0:58
 */
require_once __DIR__."/restclient.php";
require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";

if(isset($_POST['submit'])){
    $package = htmlspecialchars($_POST["package"]);
}

printf($package);
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
$task_module='shell';
$hosts='192.168.233.129';
$command="l	equery --no-pipe --quiet list python -F'{\"category\":\"$category\",
\"name\":\"$name\",\"version\":\"$version\",\"revision\":\\\"$revision\\\"},' | sed '$s/
.$//'";
//$rest->task_register($ipaddress,$port,$username,$password,$hosts,$command,$task_module);
//$hosts = $rest->tasks_run($ipaddress,$port,$username,$password,$task_id);
//var_dump($hosts);

//foreach ($hosts as $i=>$row) {
//    var_dump($i);
//    var_dump($row);
//}

