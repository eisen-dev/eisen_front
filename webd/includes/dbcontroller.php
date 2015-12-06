<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/12/04
 * Time: 10:49
 */
include(dirname(__FILE__).'/restclient.php');
include(dirname(__FILE__).'/DbAction.php');

class dbcontroller {

    function updateInstalledPackage()
    {
        /*
        $me = new Session();
        $me->start_session();
        $me->is_session_started();


        $user_id = $me->get_user_id();
        */

        $module = "Ansible";
        $ipaddress = "192.168.233.130";
        $port = "5000";
        $username = "ansible";
        $password = "default";
        $rest = new restclient();

        $task_module = "shell";
        $hosts = "192.168.233.129";
        $command = "equery --no-pipe --quiet list '*'";

        $dba = new DbAction();
        $dbh = $dba->Connect();

        $task_id = $rest->task_register($ipaddress, $port, $username, $password, $hosts, $command, $task_module);
        $package = $rest->tasks_run($ipaddress, $port, $username, $password, $task_id);
        foreach ($package as $i => $row) {
            //echo($i);
            foreach ($row->contacted as $i => $row) {
                    $dba->UpdateInstalledPackageList($row,$dbh);

            }
        }
        $rest->tasks_delete($ipaddress,$port,$username,$password,$task_id);
    }
}