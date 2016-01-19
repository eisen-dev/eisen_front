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
        $machine = $dba->hostManagerActiveList($user_id,$dbh);
        $rest = new restclient();
        foreach ($machine as $i => $row){
            try {
                $hosts = $rest->host_list($row['ipaddress'], $row['port'], $row['username'],
                    $row['password']);
                $dba->TargetHostRegistration($hosts, $dbh, $row['machine_id'], $user_id);
                $rest->check_os($row['ipaddress'], $row['port'], $row['username'],
                    $row['password']);
                $data[] = $dba->TargetList($user_id, $row['machine_id'], $dbh);
            } catch (PDOException $ex) {
                echo 'failed';
            }
        }

        return $data;
    }
}