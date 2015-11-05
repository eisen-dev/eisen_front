<?php echo '<p>Hello World</p>';
require_once __DIR__ . '/includes/DbAction.php';
require_once __DIR__."/includes/session.php";
require_once __DIR__."/includes/JsAction.php";

$me = new Session();
$me->start_session();
$me->is_session_started();

$dba = new DbAction();
$dbh = $dba->Connect();

function some_logging_function($log){
	echo 'LOG : ' . $log . '<br />';
}

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
$data=$server->get_all_packages();
foreach ($data as $value){
	try {
		$sqlcheck = $dbh->prepare("SELECT COUNT(*) FROM pack_info WHERE pack_category = :pack_cat AND pack_name = :pack_name AND pack_version = :pack_version AND pack_sys_id = :pack_sys_id;");
		//connect as appropriate as above
		$sqlcheck-> bindParam(':pack_cat', $value[0], PDO::PARAM_STR);
		$sqlcheck-> bindParam(':pack_name', $value[1], PDO::PARAM_STR);
		$sqlcheck-> bindParam(':pack_version', $value[2], PDO::PARAM_STR);
		$sqlcheck-> bindParam(':pack_sys_id', $test, PDO::PARAM_INT);
		$sqlcheck->execute();
		$result = $sqlcheck->fetchAll(PDO::FETCH_NUM);
		if (in_array(0,$result[0]))		
		{
			try {
				$query = $dbh->prepare('INSERT INTO pack_info (pack_category, pack_name, pack_version, pack_summary, pack_sys_id) VALUES (:pack_cat, :pack_name, :pack_version, NULL, :pack_sys_id);');
				$query-> bindParam(':pack_cat', $value[0], PDO::PARAM_STR);
				$query-> bindParam(':pack_name', $value[1], PDO::PARAM_STR);
				$query-> bindParam(':pack_version', $value[2], PDO::PARAM_STR);
				$query-> bindParam(':pack_sys_id', $test, PDO::PARAM_INT);
				//$query-> bindParam(':pack_expl', NULL, PDO::PARAM_STR);
				echo var_dump($query);
				$query->execute(); //invalid query!
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
