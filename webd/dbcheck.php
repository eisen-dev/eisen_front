<?php echo '<p>DB-check</p>';
require_once "/includes/jsonRPCClient.php";
require_once "/connect.php";

//クライアントに接続
$server= new jsonRPCClient("http://$js_host:$js_port");
ini_set('max_execution_time', 0); //300 seconds = 5 mi.12

//データベースに接続するために必要な情報(PDO)
$dsn = "mysql:dbname=$db_name;host=$db_host;charset=utf8";
//データベース接続
try {
	$dbh = new PDO($dsn, $db_user, $db_pass,
			array(PDO::ATTR_EMULATE_PREPARES => false,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
	exit('データベース接続に失敗しました'.$e->getMessage());
}

print_r($server->get_installed_packages_sha1());
$install_pack_sha1=$server->get_installed_packages_sha1();
$all_pack_sha1=$server->get_all_packages_sha1();

print($install_pack_sha1.'<br>'.$all_pack_sha1);

$pack_name = 'test';
$pack_version = '1.2';

$dbh->prepare("select * from pack_management_system");
$stm->execute();
$data = $stm->fetchAll();
$cnt  = count($data); //in case you need to count all rows
foreach ($data as $i => $row)
    print_r($row);

//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//$query = $dbh->prepare("INSERT INTO pack_management_system (pack_sys_name, pack_sys_version, all_sys_pack_hash, installed_sys_pack_hash) VALUES(?,?,?,?);");
//$query->bindParam(1, $pack_name);
//$query->bindParam(2, $pack_version);
//$query->bindParam(3, $all_pack_sha1);
//$query->bindParam(4, $install_pack_sha1);
//$query->execute();
