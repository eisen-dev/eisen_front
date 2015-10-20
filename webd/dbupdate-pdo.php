<?php echo '<p>Hello World</p>';
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
try {
	//connect as appropriate as above
	$dbh->query('hi'); //invalid query!
} catch(PDOException $ex) {
	echo "An Error occured!"; //user friendly message
	some_logging_function($ex->getMessage());
}

$data=$server->get_all_packages();
print_r($data);
phpinfo();
?>
