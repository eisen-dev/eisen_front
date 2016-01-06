<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/12/04
 * Time: 10:49
 */
include_once(dirname(__FILE__).'/restclient.php');
include_once(dirname(__FILE__).'/DbAction.php');

class dbcontroller
{


# TODO this two class need to be optimize with oop
    function updateInstalledPackage($machine_host,$target_host)
    {
        $me = new Session();
        $me->start_session();
        $me->is_session_started();

        var_dump($machine_host);

        $module=$machine_host["module"];
        $ipaddress=$machine_host["ipaddress"];
        $port=$machine_host["port"];
        $username=$machine_host["username"];
        $password=$machine_host["password"];
        $rest = new restclient();

        $target_module = "shell";
        $target_command = "equery --no-pipe --quiet list '*'";

        $dba = new DbAction();
        $dbh = $dba->Connect();

        $task_id = $rest->task_register($ipaddress, $port, $username, $password, $target_host, $target_command, $target_module);
        $package = $rest->tasks_run($ipaddress, $port, $username, $password, $task_id);
        $rest->tasks_delete($ipaddress, $port, $username, $password, $task_id);
        $dba->DeleteInstalledPackageListFast($dbh);
        echo 'Start time: ' . date("Y-m-d | h:i:sa") . '<br>';
        foreach ($package as $i => $row) {
            //echo($i);
            foreach ($row->contacted as $i => $row) {
                $dba->UpdateInstalledPackageListFast($row, $dbh);
            }
        }
        echo 'Stop Time: ' . date("Y-m-d | h:i:sa") . '<br>';
    }

    function updatePackage($machine_host,$target_host)
    {
        $me = new Session();
        $me->start_session();
        $me->is_session_started();

        $module=$machine_host["module"];
        $ipaddress=$machine_host["ipaddress"];
        $port=$machine_host["port"];
        $username=$machine_host["username"];
        $password=$machine_host["password"];
        $rest = new restclient();

        $target_module = "shell";
        $command = "equery --no-pipe --quiet list -po '*'";

        $dba = new DbAction();
        $dbh = $dba->Connect();

        $task_id = $rest->task_register($ipaddress, $port, $username, $password, $target_host, $command, $target_module);
        $package = $rest->tasks_run($ipaddress, $port, $username, $password, $task_id);
        $rest->tasks_delete($ipaddress, $port, $username, $password, $task_id);
        $dba->DeletePackageListFast($dbh);
        echo 'Start time: ' . date("Y-m-d | h:i:sa") . '<br>';
        foreach ($package as $i => $row) {
            foreach ($row->contacted as $i => $row) {
                $dba->UpdatePackageListFast($row,$dbh);
            }
        }
        echo 'Stop Time: ' . date("Y-m-d | h:i:sa") . '<br>';
    }

    /**
     *
     */
    function md5sumInstalled($machine_host,$target_host)
    {
        $data = array();
        $update = array();

        $me = new Session();
        $me->start_session();
        $me->is_session_started();

        $module=$machine_host["module"];
        $ipaddress=$machine_host["ipaddress"];
        $port=$machine_host["port"];
        $username=$machine_host["username"];
        $password=$machine_host["password"];
        $rest = new restclient();

        $task_module = "shell";
        $command = "equery --no-pipe --quiet list '*' | md5sum";

        $dba = new DbAction();
        $dbh = $dba->Connect();

        $task_id = $rest->task_register(
            $ipaddress,
            $port,
            $username,
            $password,
            $target_host,
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
    function md5sumAll($machine_host,$target_host)
    {
        $data = array();
        $update = array();

        $me = new Session();
        $me->start_session();
        $me->is_session_started();

        $module=$machine_host["module"];
        $ipaddress=$machine_host["ipaddress"];
        $port=$machine_host["port"];
        $username=$machine_host["username"];
        $password=$machine_host["password"];
        $rest = new restclient();

        $task_module = "shell";
        $command = "equery --no-pipe --quiet list -po '*' | md5sum";

        $dba = new DbAction();
        $dbh = $dba->Connect();

        $task_id = $rest->task_register(
            $ipaddress,
            $port,
            $username,
            $password,
            $target_host,
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
/*session_start();
$update =array();
$test = new dbcontroller();
$update['installed'] = $test->md5sumInstalled();
$update['all'] = $test->md5sumAll();
if ($update['installed'] > 0) {
    echo 'installed update<br>';
    echo $update['installed'].'<br>';
}
if ($update['all'] > 0) {
    echo 'all update<br>';
    echo $update['all'];
}


//$test->updateInstalledPackage();
//$test->updatePackage();*/