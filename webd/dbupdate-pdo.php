<?php echo '<p>Hello World</p>';
require_once "/includes/jsonRPCClient.php";
require_once "/connect.php";

//クライアントに接続
$serveraddress = "192.168.23.128";
$port = "8080";
$server= new jsonRPCClient("http://$serveraddress:$port");
ini_set('max_execution_time', 0); //300 seconds = 5 mi.12

//データベースに接続するために必要な情報(PDO)
$dsn = "mysql:dbname=$db_name;host=$db_host";

//データベース接続
try {
$dbh = new PDO($dsn, $db_user, $db_pass);
array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
 exit('データベース接続に失敗しました'.$e->getMessage());
}

$data=$server->get_all_packages();
print_r($data);
phpinfo();
?>
