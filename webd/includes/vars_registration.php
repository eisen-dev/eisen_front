<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/11/18
 * Time: 23:03
 */
require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";
require_once __DIR__."/restclient.php";

if(isset($_POST['submit'])){
    $target_host = htmlspecialchars($_POST["target_host"]);
    $manager_host = htmlspecialchars($_POST["manager_host"]);
    $v_key = htmlspecialchars($_POST["variable_key"]);
    # module variable already used for machinelist
    $v_value = htmlspecialchars($_POST["variable_value"]);

    $me = new Session();
    $me->start_session();
    $me->is_session_started();

    $dba = new DbAction();
    $dbh = $dba->Connect();
    $user_id = $me->get_user_id();

    $machine = $dba->hostManagerActiveList($user_id, $dbh);
    kint::dump($machine);
    $rest = new restclient();
    $rest->variableRegister(
        $manager_host,
        $machine[0]['port'],
        $machine[0]['username'],
        $machine[0]['password'],
        $target_host,
        $v_key,
        $v_value
    );
    header('location:../variable_list.php?target='.$host.'&os=');
}
else{
    header('location:../index.php');
}