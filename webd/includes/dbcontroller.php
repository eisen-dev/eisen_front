<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/12/04
 * Time: 10:49
 */
include(dirname(__FILE__).'/restclient.php');
include(dirname(__FILE__).'/DbAction.php');

class dbcontroller
{

# TODO this two class need to be uptimize with oop
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
        echo 'Start time: ' . date("Y-m-d | h:i:sa") . '<br>';
        foreach ($package as $i => $row) {
            //echo($i);
            foreach ($row->contacted as $i => $row) {
                $dba->UpdateInstalledPackageListFast($row, $dbh);
            }
        }
        $rest->tasks_delete($ipaddress, $port, $username, $password, $task_id);
        echo 'Stop Time: ' . date("Y-m-d | h:i:sa") . '<br>';
    }

    function updatePackage()
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
        $command = "equery --no-pipe --quiet list -po '*'";

        $dba = new DbAction();
        $dbh = $dba->Connect();

        $task_id = $rest->task_register($ipaddress, $port, $username, $password, $hosts, $command, $task_module);
        $package = $rest->tasks_run($ipaddress, $port, $username, $password, $task_id);
        echo 'Start time: ' . date("Y-m-d | h:i:sa") . '<br>';
        foreach ($package as $i => $row) {
            foreach ($row->contacted as $i => $row) {
                $dba->UpdatePackageListFast($row,$dbh);
/*                foreach (explode("\n", $row->stdout) as $item) {
                    var_dump($item);
                }*/
            }
        }
        $rest->tasks_delete($ipaddress, $port, $username, $password, $task_id);
        echo 'Stop Time: ' . date("Y-m-d | h:i:sa") . '<br>';
    }

    /**
     *
     */
    function md5sumInstalled()
    {
        /*
        $me = new Session();
        $me->start_session();
        $me->is_session_started();


        $user_id = $me->get_user_id();
        */

        $data = array();
        $update = array();
        $module = "Ansible";
        $ipaddress = "192.168.233.130";
        $port = "5000";
        $username = "ansible";
        $password = "default";
        $rest = new restclient();

        $task_module = "shell";
        $hosts = "192.168.233.129";
        $command = "equery --no-pipe --quiet list '*' | md5sum";

        $dba = new DbAction();
        $dbh = $dba->Connect();

        $task_id = $rest->task_register(
            $ipaddress,
            $port,
            $username,
            $password,
            $hosts,
            $command,
            $task_module
        );
        $data['md5sumInstalled'] = $rest->tasks_run(
            $ipaddress,
            $port,
            $username,
            $password,
            $task_id
        );
        $rest->tasks_delete($ipaddress, $port, $username, $password, $task_id);
        foreach ($data as $i => $row) {
            foreach ($row as $row) {
                foreach ($row as $row) {
                    foreach ($row as $row) {
                        //var_dump($row->stdout);
                        $update['installed'] = (
                        $dba->md5sumInstallPackage(
                            $row->stdout, $dbh
                        )
                        );
                    }
                }
            }
        }
        return $update['installed'];
    }
    /**
     *
     */
    function md5sumAll()
    {
        /*
        $me = new Session();
        $me->start_session();
        $me->is_session_started();


        $user_id = $me->get_user_id();
        */

        $data = array();
        $update = array();
        $module = "Ansible";
        $ipaddress = "192.168.233.130";
        $port = "5000";
        $username = "ansible";
        $password = "default";
        $rest = new restclient();

        $task_module = "shell";
        $hosts = "192.168.233.129";
        $command = "equery --no-pipe --quiet list -po '*' | md5sum";

        $dba = new DbAction();
        $dbh = $dba->Connect();

        $task_id = $rest->task_register(
            $ipaddress,
            $port,
            $username,
            $password,
            $hosts,
            $command,
            $task_module
        );
        $data['md5sumAll'] = $rest->tasks_run(
            $ipaddress,
            $port,
            $username,
            $password,
            $task_id
        );
        $rest->tasks_delete($ipaddress, $port, $username, $password, $task_id);
        foreach ($data as $i => $row) {
            foreach ($row as $row) {
                foreach ($row as $row) {
                    foreach ($row as $row) {
                        //var_dump($row->stdout);
                        $update['all'] = (
                        $dba->md5sumAllPackage(
                            $row->stdout, $dbh
                        )
                        );
                    }
                }
            }
        }
        return $update['all'];
    }
}

/*$update =array();
$test = new dbcontroller();
$update['installed'] = $test->md5sumInstalled();
$update['all'] = $test->md5sumAll();
if ($update['installed'] > 0) {
    echo 'installed update<br>';
    echo $update['installed'].'<br>';
}
if ($update['all'] > 0) {
    echo 'all update<br>';
    echo $update['all'];*/