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

require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";
require_once __DIR__."/restclient.php";

if(isset($_POST['submit'])){
    $targetHost = htmlspecialchars($_POST["targetHost"]);
    $managerHost = htmlspecialchars($_POST["managerHost"]);
    $groups = htmlspecialchars($_POST["groups"]);
}

$me = new Session();
$me->start_session();
$me->is_session_started();

$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

$machine = $dba->hostManagerip2id($dbh,$managerHost);
$module=$machine[1];
$ipaddress=$machine[2];
$port=$machine[3];
$username=$machine[4];
$password=$machine[5];

$rest = new restclient();
# TODO need to be fixed on the python side because the host
# is actually not registered yet
$hosts=$rest->host_register($ipaddress,$port,$username,$password,$host,$groups);
# debugging
var_dump($ipaddress,$port,$username,$password,$host,$groups);