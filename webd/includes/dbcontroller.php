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

    /** Search installed packages
     * @param $os
     *
     * @return string
     */
    public function osInstalledPackage($os)
    {
        if (strcmp('Gentoo', $os)===0) {
            $target_command =  "equery --no-pipe --quiet list '*'";
        } elseif (strcmp('Ubuntu', $os)===0) {
            // use HTML code in the command
            $target_command = "dpkg -l | awk 'NR>5{print $2&quot;=&quot;$3}'";
        } else {
            $target_command = 'unknown';
        }
        return $target_command;
    }

    public function GetOs($user_id, $target_host)
    {
        $dba = new DbAction();
        $dbh = $dba->Connect();
        $data = $dba->TargetList($user_id, $dbh);
        foreach ($data as $row => $col_item) {
            if (strcmp($col_item['ipaddress'], $target_host)==0) {
                $os = $col_item['os'];
            }
        }
        return $os;
    }

    //TODO(alice): need to be optimize
    /** Updating DataBase package list
     *
     * Getting package list from rest and updating the package list
     * in the database. This action can take time so is better to start
     * forked.
     *
     * @param $machine_host
     * @param $target_host
     * @param $action 'install' or 'all' package
     */
    public function updatePackage($machine_host, $target_host, $action)
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

        $user_id = $me->get_user_id();
        $os = $this->GetOs($user_id, $target_host);

        if (strcmp($action, 'install')===0) {
            $oscmd = $this->osInstalledPackage($os);
        } else {
            $oscmd = $this->osAllPackage($os);
        }

        $target_module = "shell";
        $target_command = $oscmd;


        $dba = new DbAction();
        $dbh = $dba->Connect();

        $task_id = $rest->task_register(
            $ipaddress,
            $port,
            $username,
            $password,
            $target_host,
            $target_command,
            $target_module
        );
        $rest->tasks_run($ipaddress, $port, $username, $password, $task_id);
        $package = $rest->tasks_result($ipaddress, $port, $username, $password, $task_id);
        Kint::dump($package);
        // wait for get the array result
        while (is_string($package['task'])) {
            sleep(1);
            $package = $rest->tasks_result($ipaddress, $port, $username, $password, $task_id);
        }
        Kint::dump($package);
        $rest->tasks_delete($ipaddress, $port, $username, $password, $task_id);
        $dba->DeleteInstalledPackageListFast($dbh);
        echo 'Start time: ' . date("Y-m-d | h:i:sa") . '<br>';
        foreach ($package as $i => $body) {
            Kint::dump($body);
            foreach ($body['contacted'] as $y => $contacted) {
                Kint::dump($contacted);
                $dba->UpdatePackageListFast($contacted, $dbh, $action, $ipaddress);
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