<?php
require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";
require_once __DIR__."/JsAction.php";

if(isset($_POST['submit'])){
    $js_host = htmlspecialchars($_POST["js_host"]);
    $js_port = htmlspecialchars($_POST["js_port"]);
}
$me = new Session();
$me->start_session();
$me->is_session_started();

$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

try {
    $query = $dbh->prepare('INSERT INTO machine_information (machine_name, ipaddress, port, os, status_id, user_id) VALUES (:machine_name, :ipaddress, :port, :os, :status_id, :user_id);');
    $query-> bindParam(':machine_name', $machine_name, PDO::PARAM_STR);
    $query-> bindParam(':ipaddress', $js_host, PDO::PARAM_STR);
    $query-> bindParam(':port', $js_port, PDO::PARAM_STR);
    $query-> bindParam(':os', $os, PDO::PARAM_STR);
    $query-> bindParam(':status_id', $status_id, PDO::PARAM_INT);
    $query-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
    echo var_dump($query);
    $query->execute(); //invalid query!
} catch(PDOException $ex) {
    //echo "An Error occured!"; //user friendly message
    some_logging_function($ex->getMessage());
}