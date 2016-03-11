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
require_once __DIR__."/restclient.php";
require_once __DIR__."/session.php";

$me = new Session();
$me->start_session();
$me->is_session_started();
$rest = new restclient();
$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

if (isset($_POST['list-action']) )
{
    $action = ($_POST['list-action']);
}
if (isset($_POST['managerHostAddress'])) {
    $managerHostAddress = ($_POST['managerHostAddress']);
}

$check = $_POST['managerHostId'];
if (empty($check)) {
    echo('You didnt select any checks.');
    //header('location:../target_list.php');
} else {
    $N = count($check);

    echo('You selected $N check(s): ');
    for ($i = 0; $i < $N; $i++) {
        echo($check[$i] . ' ');
        if ($action == 1) {
            $machine = $dba->hostManagerActiveListFind(
                $user_id,
                $dbh,
                $managerHostAddress[$check[$i]]
            );
            try {
                $rest->tasks_run(
                    $machine[0]['ipaddress'],
                    $machine[0]['port'],
                    $machine[0]['username'],
                    $machine[0]['password'],
                    $check[$i]
                );
            } catch (HttpException $ex) {
                echo $ex;
            }
            header('location:../task_list.php');
        } elseif ($action == 2) {
            $machine = $dba->hostManagerActiveListFind(
                $user_id,
                $dbh,
                $managerHostAddress[$check[$i]]
            );
            try {
                $result = $rest->tasks_result(
                    $machine[0]['ipaddress'],
                    $machine[0]['port'],
                    $machine[0]['username'],
                    $machine[0]['password'],
                    $check[$i]
                );
                kint::dump($result);
            } catch (HttpException $ex) {
                echo $ex;
            }
        }
    }
}