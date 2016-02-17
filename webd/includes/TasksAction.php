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

$machine = $dba->hostManagerActiveList($user_id, $dbh);
kint::dump($machine);
$rest = new restclient();
//$rest->restconnect($ipaddress,$port,$username,$password);
if (strcmp($action, "start") == 0) {
    $rest->tasks_run(
        $manager_host,
        $machine[0]['port'],
        $machine[0]['username'],
        $machine[0]['password'],
        $task_id
    );
    echo($hosts);

    foreach ($hosts as $i => $row) {
        echo($i);
        echo($row);
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