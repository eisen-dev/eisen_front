<?php
/**
 * (c) 2016 , Eisen Team <alice.ferrazzi@gmail.com>
 *
 * This file is part of Eisen
 *
 * Eisen is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Eisen is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Eisen.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2016/01/07
 * Time: 9:19
 */

require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/restclient.php";
require_once __DIR__."/session.php";

$me = new Session();
$me->start_session();
$me->is_session_started();
$rest = new restclient();
$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

if (isset($_POST['list-action']) )
{
    $action = ($_POST['list-action']);
    echo $action;
}
if (isset($_POST['managerHostAddress'])) {
    $managerHostAddress = ($_POST['managerHostAddress']);
}

$check = $_POST['managerHostId'];
if (empty($check)) {
    echo('You didnt select any checks.');
    //header('location:../target_list.php');
}
else
{
    $N = count($check);

    echo('You selected $N check(s): ');
    for ($i=0; $i < $N; $i++) {
        echo($check[$i] . ' ');
        foreach ($managerHostAddress as $host) {
            $machine = $dba->hostManagerActiveListFind(
                $user_id,
                $dbh,
                $host
            );
            $rest->tasks_run(
                $machine[0]['ipaddress'],
                $machine[0]['port'],
                $machine[0]['username'],
                $machine[0]['password'],
                $check[$i]
            );
            echo $host;
        }
        //$dba->hostManagerActive($dbh, $action, $check[$i]);
    }
}
