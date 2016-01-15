<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2016/01/07
 * Time: 10:22
 */
require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";
require_once __DIR__."/restclient.php";

/**
 * Class TargetHostController
 */
class TargetHostController
{
    /**
     * @param $user_id
     * @return array
     */
    public function get_TargetHost($user_id)
    {
        $dba = new DbAction();
        $dbh = $dba->Connect();
        $machine = $dba->MachineList($user_id,$dbh);
        $machine_id=$machine[0];
        $module=$machine[1];
        $ipaddress=$machine[2];
        $port=$machine[3];
        $username=$machine[4];
        $password=$machine[5];
        $status_id=$machine[6];
        $user_id=$machine[7];
        $rest = new restclient();
        $hosts = $rest->host_list($ipaddress, $port, $username, $password);
        $dba->TargetHostRegistration($hosts, $dbh, $machine_id, $user_id);
        $data=$dba->TargetList($user_id, $dbh);
        return $data;
    }
}