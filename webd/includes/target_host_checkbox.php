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

$dba = new DbAction();
$dbh = $dba->Connect();

$me = new Session();
$me->start_session();
$me->is_session_started();

$check = (isset($_POST['check']) ? $_POST['check'] : null);
if ($_SESSION['action'] == 0){
    $_SESSION['action'] = Null;
    $_SESSION['target_host'] = Null;
    header('location:../target_list.php');
}
if (isset($_POST['list-action'])) {
    $_SESSION['action'] = $_POST['list-action'];
    echo($_SESSION['action']);
}
if (is_null($check)) {
    echo('You didnt select any checks.');
    $_SESSION['action'] = Null;
    $_SESSION['target_host'] = Null;
    header('location:../target_list.php');
}else {
    $N = count($check);
    if ($N >= 2) {
        $_SESSION['action'] = Null;
        $_SESSION['target_host'] = Null;
        header('location:../target_list.php');
    }
    echo('You selected $N check(s): ');
    for ($i = 0; $i < $N; $i++) {
        echo($check[$i] . ' ');
        $targetHostId = $check[$i];
        $data = $dba->targetHostIdInf($dbh, $targetHostId);
        $_SESSION['target_host'] = $data;
    }
}
if (!isset($_SESSION['target_host'])) {
    header('location:../target_list.php');
}
if (strcmp($_SESSION['action'],0) === 1) {
    header('location:../package_list.php');
} elseif (strcmp($_SESSION['action'],2) === 0) {
    header('location:../task_list.php');
} elseif (strcmp($_SESSION['action'],3) === 0) {
    header('location:../variable_list.php');
} elseif (strcmp($_SESSION['action'],4) === 0) {
    header('location:../recipe_list.php');
}