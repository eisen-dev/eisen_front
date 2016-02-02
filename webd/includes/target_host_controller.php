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
        $machine = $dba->hostManagerActiveList($user_id, $dbh);
        $rest = new restclient();
        foreach ($machine as $i => $row){
            try {
                $hosts = $rest->host_list($row['ipaddress'], $row['port'], $row['username'],
                    $row['password']);
                $dba->TargetHostRegistration($hosts, $dbh, $row['machine_id'], $user_id);
                $rest->check_os($row['ipaddress'], $row['port'], $row['username'],
                    $row['password']);
                $data[] = $dba->TargetList($user_id, $row['machine_id'], $dbh);
                foreach ($data as $y => $manager) {
                    foreach ($manager as $x => $targetHost) {
                        $table = '<tr class="cell-which-triggers-popup">
                        <td class="list-data-ctrl">
                        <div class="list-data-cbox">
                            <input type="checkbox" id="cbox-' . $targetHost['host_id'] .
                            '" value="' . $targetHost['host_id'] . '" name="check[]">
                            <label for="cbox-' . $targetHost['host_id'] . '">
                        <div class="select"></div></label></div>';
                        $table .= '</td>';
                        $table .= '<td class="ipaddress"><input type="hidden" id="test"' .
                            ' value="' . $targetHost['ipaddress'] . '" name="targetHostIp[]">' .
                            $targetHost['ipaddress'] . '</td>';
                        $table .= '<td class="port">' . $targetHost['port'] . '</td>';
                        $table .= '<td class="groups">' . $targetHost['groups'] . '</td>';
                        $table .= '<td class="os">' . $targetHost['os'] . '</td>';
                        $table .= '<td class="ipaddress"><input type="hidden" id="test"' .
                            ' value="' . $targetHost['machine_id'] . '" name="managerHostId[]">' .
                            $targetHost['machine_id'] . '</td>';
                        $table .= '<td class="status_id">' . $targetHost['status_id'] . '</td>';
                    }
                }
            } catch (PDOException $ex) {
                echo 'failed';
            }
        }
        echo json_encode($table);
    }

    public function onlineCheck()
    {
    print 'check';
    }
}
$me = new Session();
$me->start_session();
$me->is_session_started();
$user_id = $me->get_user_id();
$hosts = new TargetHostController();
$data = $hosts->get_TargetHost($user_id);