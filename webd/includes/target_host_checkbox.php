<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2016/01/07
 * Time: 9:19
 */

require_once __DIR__ . '/DbAction.php';
$dba = new DbAction();
$dbh = $dba->Connect();

if (isset($_POST['list-action']) )
{
    $action = ($_POST['list-action']);
    echo $action;
}
if (isset($_POST['managerHostAddress']) )
{
    $test = ($_POST['managerHostAddress']);
    l($test);
}
if (isset($_POST['managerHostId']) )
{
    $test = ($_POST['managerHostId']);
    l($test);
}

$check = $_POST['check'];
if (empty($check))
{
    echo('You didnt select any checks.');
    header('location:../target_list.php');
}
else
{
    $N = count($check);

    echo('You selected $N check(s): ');
    for($i=0; $i < $N; $i++)
    {
        echo($check[$i] . ' ');
        //$dba->hostManagerActive($dbh, $action, $check[$i]);
    }
}
if (strcmp($action,0) === 1) {
    header('location:../package_list.php');
} elseif (strcmp($action,2) === 0) {
    header('location:../task_list.php');
} elseif (strcmp($action,3) === 0) {
    header('location:../variable_list.php');
}