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

if (!empty($_POST)) {
    //echo("post: ");
    //echo("<br>");
    //var_dump($_POST);
    $targetHost = $_POST['targetHost'];
    $managerHost = $_POST['managerHost'];
    $packageName = $_POST['packageName'];
    $packageVersion = $_POST['packageVersion'];
    $packageAction = $_POST['Action'];
    //echo("<br>");
}
require_once __DIR__ . '/../includes/DbAction.php';
require_once __DIR__ . "/../includes/session.php";
require_once __DIR__ . "/../includes/restclient.php";

# get needed class
$me = new Session();
$rest = new restclient();
$dba = new DbAction();
$dbh = $dba->Connect();
$me->start_session();
$me->is_session_started();

$target = [];
//echo '<br>------------------------<br>';

$manager_data = $dba->hostManagerid2ip($dbh, $managerHost);
$manager_id = $manager_data[0]['machine_id'];
$target_data = $dba->targetHostInf($dbh, $targetHost, $manager_id);

try {
    $response = $rest->package_Action(
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
} catch(Exception $e) {
    echo($e);
}
if (isset($response->body->agent->Result)) {
    echo($response->body->agent->Result);
} else {
    kint::dump($response);
}