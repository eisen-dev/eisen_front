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

# get needed class
$me = new Session();
$rest = new restclient();

$me->start_session();
$me->is_session_started();

$target = [];
if(isset($_GET['package'])){
    $package = htmlspecialchars($_GET["package"]);
    echo ($package);
}
if(isset($_GET['action'])){
    $action = htmlspecialchars($_GET["action"]);
    echo ($action);
}
if(isset($_GET['target'])){
    $target_host = htmlspecialchars($_GET["target"]);
    echo ( $target["ipaddress"]);
}
if(isset($_GET['module'])){
    $target["module"] = htmlspecialchars($_GET["module"]);
}

$task_id = $rest->package_Action(
$rest_host,
$rest_port,
$username,
$password,
$target_host,
$targetOs,
$packageName,
$packageVersion,
$packageAction
);
