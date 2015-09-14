<?php echo '<p>Hello World</p>';
require_once "/includes/jsonRPCClient.php";
require_once "/connect.php";
$serveraddress = "192.168.233.130";
$port = "8080";
$server= new jsonRPCClient("http://$serveraddress:$port");
//データベース接続
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
ini_set('max_execution_time', 0); //300 seconds = 5 minutes
try {
	$sql = "INSERT INTO パッケージ情報(パッケージカテゴリ, パッケージ名, パッケージバージョン, パッケージの説明)";
	//json-rpcでインストールしたのパッケージゲットメソッドを呼び出して表示する。
	$data=$server->get_all_packages();
	foreach ($data as $value){
		$values=" VALUES('".$value[0]."','".$value[1]."','".$value[2]."',NULL);";
		$sqlcheck = "SELECT * FROM パッケージ情報 WHERE パッケージカテゴリ ='".$value[0]."' AND パッケージ名 ='".$value[1]."' AND パッケージバージョン='".$value[2]."';";
		//パッケージリストからqueryを作ります。
		$query=($sql.$values);
		//データベースに入れます。
		$check = mysqli_query($dbc, $sqlcheck);
		$result = $check->fetch_array(MYSQLI_ASSOC);
		print_r($result);
			if ($result==NULL) {
				print('not present <br>');
				$data = mysqli_query($dbc, $query);
			}else{
				print('is present <br>');
			}
	}
} catch (Exception $e) {
	echo nl2br($e->getMessage()).'<br />'."\n";
}
try {
	$sql = "INSERT INTO インストール済みパッケージ(パッケージカテゴリ, パッケージ名, パッケージバージョン)";
	//json-rpcでインストールしたのパッケージゲットメソッドを呼び出して表示する。
	$data=$server->get_installed_packages();
	foreach ($data as $value){
		$values=" VALUES('".$value[0]."','".$value[1]."','".$value[2]."');";
		$sqlcheck = "SELECT * FROM インストール済みパッケージ WHERE パッケージカテゴリ ='".$value[0]."' AND パッケージ名 ='".$value[1]."' AND パッケージバージョン='".$value[2]."';";
		//パッケージリストからqueryを作ります。
		$query=($sql.$values);
		//データベースに入れます。
		$check = mysqli_query($dbc, $sqlcheck);
		$result = $check->fetch_array(MYSQLI_ASSOC);
		print_r($result);
		if ($result==NULL) {
			print('not present <br>');
			$data = mysqli_query($dbc, $query);
		}else{
			print('is present <br>');
		}
	}
} catch (Exception $e) {
	echo nl2br($e->getMessage()).'<br />'."\n";
}
?>