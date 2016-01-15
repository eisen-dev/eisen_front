<?php
require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";
require_once __DIR__."/restclient.php";

if(isset($_POST['submit'])){
    $rest_module = htmlspecialchars($_POST["rest_module"]);
    $rest_host = htmlspecialchars($_POST["rest_host"]);
    $rest_port = htmlspecialchars($_POST["rest_port"]);
    $rest_user = htmlspecialchars($_POST["rest_user"]);
    $rest_pass = htmlspecialchars($_POST["rest_pass"]);
}
var_dump($rest_host.$rest_port.$rest_user.$rest_pass);
$me = new Session();
$me->start_session();
$me->is_session_started();

$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

$rest = new restclient();
$status_id = $rest->restconnect($rest_host,$rest_port,$rest_user,$rest_pass);

try {
    $query = $dbh->prepare('INSERT INTO manager_host (ipaddress, port, module, username, password, status_id ,user_id) VALUES ( :ipaddress, :port, :module, :username, :password, :status_id, :user_id );');
    $query-> bindParam(':ipaddress', $rest_host, PDO::PARAM_STR);
    $query-> bindParam(':port', $rest_port, PDO::PARAM_STR);
    $query-> bindParam(':username', $rest_user, PDO::PARAM_STR);
    $query-> bindParam(':password', $rest_pass, PDO::PARAM_STR);
    $query-> bindParam(':module', $rest_module, PDO::PARAM_STR);
    $query-> bindParam(':status_id', $status_id, PDO::PARAM_INT);
    $query-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
    var_dump($dbh);
    $query->execute(); //invalid query!
} catch(PDOException $ex) {
    //echo "An Error occured!"; //user friendly message
    var_dump($ex->getMessage());
}
    header('location:../host_manager.php');
