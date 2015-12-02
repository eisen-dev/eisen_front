<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/11/18
 * Time: 23:03
 */
require_once __DIR__ . '/../DbAction.php';
require_once __DIR__."/../session.php";
require_once __DIR__."/../restclient.php";

if(isset($_GET['package'])){
    $package = htmlspecialchars($_GET["package"]);
}
if(isset($_GET['action'])){
    $action = htmlspecialchars($_GET["action"]);
}

$me = new Session();
$me->start_session();
$me->is_session_started();

$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

$machine = $dba->MachineList($user_id,$dbh);
$module=$machine[0];
$ipaddress=$machine[1];
$port=$machine[2];
$username=$machine[3];
$password=$machine[4];

var_dump($package);
var_dump($action);
$module="Ansible";
$ipaddress="192.168.233.130";
$port="5000";
$username="ansible";
$password="default";
$rest = new restclient();

$task_module="portage";
$hosts="192.168.233.129";

#TODO we need to filter the variables for security issue
# like injections
if ($action=='install') {
    $command = "package==" . $package . "";
}
elseif($action=='update') {
    $command = "package==" . $package . "";
}
elseif ($action == 'delete') {
    $command = "package==" . $package . " state=absent depclean=yes";
}
#install can be more than 30 sec
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
$task_id=$rest->task_register($ipaddress,$port,$username,$password,$hosts,$command,$task_module);
$package=$rest->tasks_run($ipaddress,$port,$username,$password,$task_id);

#better var_dump for httpful
foreach ($package as $i=>$row) {
    var_dump($i);
    var_dump($row);
}

$rest->tasks_delete($ipaddress,$port,$username,$password,$task_id);