<?php
require_once __DIR__ . '/includes/DbAction.php';
require_once __DIR__."/includes/session.php";

$dba = new DbAction();
$dbh = $dba->Connect();
$package = $dba->installedPackageList(1,$dbh);

$return = [];
foreach ($package as $i => $row) {
    var_dump($row['installed_pack_name']);
}