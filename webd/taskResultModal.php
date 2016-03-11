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

require_once __DIR__ . '/includes/DbAction.php';
require_once __DIR__."/includes/restclient.php";
require_once __DIR__."/includes/session.php";

$me = new Session();
$me->start_session();
$me->is_session_started();
$rest = new restclient();
$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

$task_id = $_POST['task_id'];;
$managerHost = $_POST['managerHost'];;

$machine = $dba->hostManagerActiveListFind(
    $user_id,
    $dbh,
    $managerHost
);
$result = $rest->tasks_result(
    $machine[0]['ipaddress'],
    $machine[0]['port'],
    $machine[0]['username'],
    $machine[0]['password'],
    $task_id
);

$return = [$task_id, $result];

echo json_encode([
   'return' => $return
]);
