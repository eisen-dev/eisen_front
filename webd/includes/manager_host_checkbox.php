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

if(isset($_POST['list-action'])){
    $action = ($_POST['list-action']);
    echo $action;
}

$check = $_POST['check'];
if(empty($check))
{
    echo('You didnt select any checks.');
}
else
{
    $N = count($check);

    echo('You selected $N check(s): ');
    for($i=0; $i < $N; $i++)
    {
        if ($action == 0 || $action == 1) {
            echo($check[$i] . ' ');
            $dba->hostManagerActive($dbh, $action, $check[$i]);
        } elseif ($action == 2) {
            echo'削除';
            $dba->hostManagerDelete($dbh, $check[$i]);
        }
    }
}
header('location:../host_manager.php');