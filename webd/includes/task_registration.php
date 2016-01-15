<?php
    /**
     * Created by PhpStorm.
     * User: IT College
     * Date: 2015/11/18
     * Time: 23:03
     */
    require_once __DIR__ . '/DbAction.php';
    require_once __DIR__ . "/session.php";
    require_once __DIR__ . "/restclient.php";

    if (isset($_POST['submit'])) {
        $hosts = htmlspecialchars($_POST["hosts"]);
        $command = htmlspecialchars($_POST["command"]);
        # module variable already used for machinelist
        $task_module = htmlspecialchars($_POST["module"]);
    }
    printf($command);
    $me = new Session();
    $me->start_session();
    $me->is_session_started();

    $dba = new DbAction();
    $dbh = $dba->Connect();
    $user_id = $me->get_user_id();

    $machine = $dba->MachineList($user_id, $dbh);
    $machine_id = $machine[0];
    $module = $machine[1];
    $ipaddress = $machine[2];
    $port = $machine[3];
    $username = $machine[4];
    $password = $machine[5];

    $rest = new restclient();
    $rest->task_register($ipaddress, $port, $username, $password, $hosts, $command,
        $task_module);

    header('location:../task_list.php?target='.$hosts.'&os=');