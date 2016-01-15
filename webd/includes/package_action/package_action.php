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
require_once __DIR__."/../dbcontroller.php";


# get needed class
$test = new dbcontroller();
$me = new Session();
$rest = new restclient();

$me->start_session();
$me->is_session_started();

$target = array();
if(isset($_GET['package'])){
    $package = htmlspecialchars($_GET["package"]);
}
if(isset($_GET['action'])){
    $action = htmlspecialchars($_GET["action"]);
}
if(isset($_GET['target'])){
    $target["ipaddress"] = htmlspecialchars($_GET["target"]);
}
if(isset($_GET['module'])){
    $target["module"] = htmlspecialchars($_GET["module"]);
}



var_dump($package);
var_dump($action);
var_dump($target);

// get the machine manager variables
// is defined in host_manager.php

$module=$_SESSION["manager"]["module"];
$ipaddress=$_SESSION["manager"]["ipaddress"];
$port=$_SESSION["manager"]["port"];
$username=$_SESSION["manager"]["username"];
$password=$_SESSION["manager"]["password"];
$machine_host=$_SESSION["manager"];
var_dump($machine_host);

// Get the target host variable
// is defined in target_list.php

$target_module="portage";
$target_host=$target["ipaddress"];
$os = $target['os'];

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
$task_id=$rest->task_register($ipaddress,$port,$username,$password,$target_host,$command,$target_module);
$package=$rest->tasks_run($ipaddress,$port,$username,$password,$task_id);
$rest->tasks_delete($ipaddress,$port,$username,$password,$task_id);

#better var_dump for httpful
foreach ($package as $i=>$row) {
    var_dump($i);
    var_dump($row);
}

# Excluded target command because now is doing only gentoo package
# to be added in the future.
$test->updateInstalledPackage($machine_host,$target_host,$target_module);
$test->updatePackage($machine_host,$target_host,$target_module);