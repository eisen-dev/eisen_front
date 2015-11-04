<?php
require_once "includes/session.php";
require_once "/includes/jsonRPCClient.php";
require_once __DIR__ . '/includes/DbAction.php';
$dba = new DbAction();
$dbh = $dba->Connect();

$me = new Session();
$me->is_session_started();
$user_id = 'test';

$data=$dba ->MachineList($user_id,$dbh);
var_dump($data);
/*

$stm = $dbh->prepare("select * from machine_information WHERE user_id=:user_id;");
$stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
$stm->execute();
$data = $stm->fetchAll();
$cnt  = count($data); //in case you need to count all rows
foreach ($data as $i => $row)
        $js_host=$row['ipaddress'];
        $js_port=$row['port'];

$server= new jsonRPCClient("http://$js_host:$js_port");
ini_set('max_execution_time', 0); //300 seconds = 5 mi.12

$data=$server->install_package('games-misc/fortune-mod');
var_dump($data);*/