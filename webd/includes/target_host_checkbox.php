<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2016/01/07
 * Time: 9:19
 */

require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";

$dba = new DbAction();
$dbh = $dba->Connect();

$me = new Session();
$me->start_session();
$me->is_session_started();

if (isset($_POST['list-action'])) {
    $_SESSION['action'] = $_POST['list-action'];
    #Kint::dump($_SESSION['action']);
}

$check = $_POST['check'];
if (empty($check)) {
    echo('You didnt select any checks.');
    header('location:../target_list.php');
}
else
{
    $N = count($check);

    echo('You selected $N check(s): ');
    for ($i=0; $i < $N; $i++) {
        echo($check[$i] . ' ');
        $targetHostId = $check[$i];
        $data = $dba->targetHostIdInf($dbh, $targetHostId);
        $_SESSION['target_host'] = $data;
    }
}
if (strcmp($_SESSION['action'],0) === 1) {
    header('location:../package_list.php');
} elseif (strcmp($_SESSION['action'],2) === 0) {
    header('location:../task_list.php');
} elseif (strcmp($_SESSION['action'],3) === 0) {
    header('location:../variable_list.php');
}