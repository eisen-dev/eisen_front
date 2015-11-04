<?php echo '<p>Hello World</p>';
require_once "/includes/jsonRPCClient.php";
require_once "/connect.php";

function some_logging_function($log){
	echo 'LOG : ' . $log . '<br />';
}

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
$test=1;
$data=$server->get_installed_packages();
foreach ($data as $value){
	try {
		$sqlcheck = $dbh->prepare("SELECT COUNT(*) FROM installed_package WHERE installed_pack_category = :installed_pack_cat AND installed_pack_name = :installed_pack_name AND installed_pack_version = :installed_pack_version AND pack_sys_id = :pack_sys_id ;");
		//connect as appropriate as above
		$sqlcheck-> bindParam(':installed_pack_cat', $value[0], PDO::PARAM_STR);
		$sqlcheck-> bindParam(':installed_pack_name', $value[1], PDO::PARAM_STR);
		$sqlcheck-> bindParam(':installed_pack_version', $value[2], PDO::PARAM_STR);
		$sqlcheck-> bindParam(':pack_sys_id', $test, PDO::PARAM_INT);
		$sqlcheck->execute();
		$result = $sqlcheck->fetchAll(PDO::FETCH_NUM);
		if (in_array(0,$result[0]))
		{
			try {
				$query = $dbh->prepare('INSERT INTO installed_package (installed_pack_category, installed_pack_name, installed_pack_version, installed_pack_summary, pack_sys_id) VALUES (:installed_pack_cat, :installed_pack_name, :installed_pack_version, NULL, :pack_sys_id)');
				$query-> bindParam(':installed_pack_cat', $value[0], PDO::PARAM_STR);
				$query-> bindParam(':installed_pack_name', $value[1], PDO::PARAM_STR);
				$query-> bindParam(':installed_pack_version', $value[2], PDO::PARAM_STR);
				$query-> bindParam(':pack_sys_id', $test, PDO::PARAM_INT);
				//$query-> bindParam(':pack_expl', NULL, PDO::PARAM_STR);
				$query->execute();
			} catch(PDOException $ex) {
				echo "An Error occured!"; //user friendly message
				//some_logging_function($ex->getMessage());
			}
		}
	} catch(PDOException $ex) {
		echo "An Error occured!"; //user friendly message
		//some_logging_function($ex->getMessage());
	}
}

//$data=$server->get_all_packages();
//print_r($data);
//phpinfo();
