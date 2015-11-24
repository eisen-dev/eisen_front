<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/11/24
 * Time: 0:58
 */
require_once __DIR__."/restclient.php";
require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";

if(isset($_POST['package'])){
    $search_package = htmlspecialchars($_POST["package"]);
}

$me = new Session();
$me->start_session();
$me->is_session_started();

$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

$machine = $dba->MachineList($user_id,$dbh);
$module=$machine[0];
$ipaddress=$machine[1];
$port=$machine[2];
$username=$machine[3];
$password=$machine[4];
$rest = new restclient();

$task_module="shell";
$hosts="192.168.233.129";
$command= "equery --no-pipe --quiet list $search_package";

$task_id=$rest->task_register($ipaddress,$port,$username,$password,$hosts,$command,$task_module);
$package = $rest->tasks_run($ipaddress,$port,$username,$password,$task_id);
//var_dump($package);

foreach ($package as $i=>$row) {
    //var_dump($i);
    foreach ($row->contacted as $i=>$row){
        foreach ( explode("\n",$row->stdout) as $item) {
            echo "<tr>";
            echo ("<td></td>");
            echo ("<td>".$item."</td>");
            echo "</tr>";
        }
    }
}


$return = "search.phpからの返り値です";

echo json_encode([
	'result' => $return
]);

