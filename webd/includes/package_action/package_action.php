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
$dba = new DbAction();
$dbh = $dba->Connect();
$me->start_session();
$me->is_session_started();

$target = [];
if(isset($_GET['packageName'])){
    $packageName = htmlspecialchars($_GET["packageName"]);
    echo ($packageName);
}
if(isset($_GET['packageVersion'])){
    $packageVersion = htmlspecialchars($_GET["packageVersion"]);
    echo ('<br>'.$packageVersion);
}
if(isset($_GET['action'])){
    $packageAction = htmlspecialchars($_GET["action"]);
    echo ('<br>'.$packageAction);
}
if(isset($_GET['target'])){
    $target_host = htmlspecialchars($_GET["target"]);
    echo ( '<br>'.$target_host);
}
if(isset($_GET['manager'])){
    $manager_ipaddress = htmlspecialchars($_GET["manager"]);
    echo '<br>'.$manager_ipaddress;
}
echo '<br>------------------------<br>';

$manager_data = $dba->hostManagerip2id($dbh, $manager_ipaddress);
$manager_id = $manager_data[0]['machine_id'];
Kint::dump($manager_data);
$target_data = $dba->targetHostInf($dbh, $target_host, $manager_id);
Kint::dump($target_data);

$task_id = $rest->package_Action(
$manager_data[0]['ipaddress'],
$manager_data[0]['port'],
$manager_data[0]['username'],
$manager_data[0]['password'],
$target_data[0]['ipaddress'],
$target_data[0]['os'],
$packageName,
$packageVersion,
$packageAction
);
