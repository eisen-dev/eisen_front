<?php echo '<p>Hello World</p>';
require_once "/includes/jsonRPCClient.php";
require_once "/includes/connectvars.php";
$serveraddress = "192.168.233.130";
$port = "8080";
$server= new jsonRPCClient("http://$serveraddress:$port");
//データベース接続
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$sql = "INSERT INTO パッケージ情報(パッケージカテゴリ, パッケージ名, パッケージバージョン, パッケージの説明)";
try {
	//json-rpcでインストールしたのパッケージゲットメソッドを呼び出して表示する。
	$data=$server->get_installed_packages();
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
echo "<br></br>-----------------------------------------------------------------------------------------------------------------------------------------<br></br>";
echo "<br></br>";
?>