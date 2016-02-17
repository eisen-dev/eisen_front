<?php
/**
 * Eisen Frontend
 * http://eisen-dev.github.io
 *
 * Copyright (c) 2016 Alice Ferrazzi <alice.ferrazzi@gmail.com> - Takuma Muramatsu <t.muramatu59@gmail.com>
 * Dual licensed under the MIT or GPL Version 3 licenses or later.
 * http://eisen-dev.github.io/License.md
 *
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
    $manager_id = htmlspecialchars($_GET["manager"]);
    echo '<br>'.$manager_id;
}
echo '<br>------------------------<br>';

$manager_data = $dba->hostManagerid2ip($dbh, $manager_id);
$target_data = $dba->targetHostInf($dbh, $target_host, $manager_id);

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

echo $task_id;