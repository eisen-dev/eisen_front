<?php echo '<p>Hello World</p>';
require_once "/includes/jsonRPCClient.php";
require_once "/connect.php";
//データベースに接続するために必要な情報(PDO)
$dsn = "mysql:dbname=$db_name;host=$db_host;charset=utf8";
global $dbh;

//データベース接続
try {
$dbh = new PDO($dsn, $db_user, $db_pass,
array(PDO::ATTR_EMULATE_PREPARES => false,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
 exit('データベース接続に失敗しました'.$e->getMessage());
}

function some_logging_function($log){
    echo 'LOG : ' . $log . '<br />';
}
//クライアントに接続
$server= new jsonRPCClient("http://$js_host:$js_port");
ini_set('max_execution_time', 0); //300 seconds = 5 mi.12

function createdbtable($table,$fields,$dbh)
{

	$sql = "CREATE TABLE IF NOT EXISTS `$table` (";
	$pk  = '';

	foreach($fields as $field => $type)
	{
		$sql.= "`$field` $type,";

		if (preg_match('/AUTO_INCREMENT/i', $type))
		{
			$pk = $field;
		}
	}

	$sql = rtrim($sql,',') . ', PRIMARY KEY (`'.$pk.'`)';

	$sql .= ") CHARACTER SET utf8 COLLATE utf8_general_ci"; 
	try {
		$dbh->query($sql); //invalid query!
	} catch(PDOException $ex) {
		echo "An Error occured!"; //user friendly message
		some_logging_function($ex->getMessage());
	}
}

createdbtable(
		'user_info', 
		array(
        'unique_id' => 'INT AUTO_INCREMENT',
        'user_id' => 'VARCHAR(75)',
        'password' => 'VARCHAR(40)',
		'mail_address' => 'VARCHAR(60)',
		),$dbh);

createdbtable(
		'machine_information',
		array(
		'machine_id' => 'INT AUTO_INCREMENT',
		'machine_name'=> 'VARCHAR(20)',
		'ipaddress' => 'VARCHAR(20)',
		'port' => 'VARCHAR(60)',
		'os' => 'VARCHAR(60)',
		'status_id' => 'VARCHAR(60)',
        'user_id' => 'VARCHAR(75)'
		),$dbh);

createdbtable(
		'pack_management_system',
		array(
		'pack_sys_id' => 'INT AUTO_INCREMENT',
		'pack_sys_name'=> 'VARCHAR(20)',
		'pack_sys_version' => 'VARCHAR(20)',
		'all_sys_pack_hash' => 'VARCHAR(60)',
		'installed_sys_pack_hash' => 'VARCHAR(60)',
        'machine_id'=> 'INT NOT NULL'
		),$dbh);

createdbtable(
		'installed_package',
		array(
		'installed_pack_id' => 'INT AUTO_INCREMENT',
		'installed_pack_category'=> 'VARCHAR(20)',
		'installed_pack_name' => 'VARCHAR(20)',
		'installed_pack_version' => 'VARCHAR(60)',
		'installed_pack_summary' => 'VARCHAR(60)',
		'pack_sys_id' => 'INT NOT NULL'
		),$dbh);
createdbtable(
		'pack_info',
		array(
		'pack_id' => 'INT AUTO_INCREMENT',
		'pack_category'=> 'VARCHAR(20)',
		'pack_name' => 'VARCHAR(20)',
		'pack_version' => 'VARCHAR(60)',
		'pack_summary' => 'VARCHAR(60)',
        'pack_sys_id' => 'INT NOT NULL'
		),$dbh);
createdbtable(
		'status',
		array(
		'status_id' => 'INT AUTO_INCREMENT',
		'status_info'=> 'VARCHAR(20)',
		),$dbh);
?>
