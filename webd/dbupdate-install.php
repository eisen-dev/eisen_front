<?php
echo '<p>Hello World</p>';
require_once __DIR__ . '/includes/DbAction.php';
require_once __DIR__."/includes/session.php";
require_once __DIR__."/includes/JsAction.php";

$me = new Session();
$me->start_session();
$me->is_session_started();

$dba = new DbAction();
$dbh = $dba->Connect();

$user_id = $me->get_user_id();
$stm = $dbh->prepare("select * from machine_information WHERE user_id=:user_id;");
$stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
$stm->execute();
$data = $stm->fetchAll();
$cnt  = count($data); //in case you need to count all rows
//var_dump($data);
foreach ($data as $i => $row) {
    $js_host = $row['ipaddress'];
    $js_port = $row['port'];
}
print $js_host;
print $js_port;

$jsc = new JsAction();
$server = $jsc->ClientConnect($js_host,$js_port);

$test=1;
$data=$server->get_installed_packages();

$dba->UpdateInstalledPackageList($data,$dbh);

//$data=$server->get_all_packages();
//print_r($data);
//phpinfo();
