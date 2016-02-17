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