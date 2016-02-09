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
     * Date: 2016/01/17
     * Time: 22:36
     */
if (!empty($_POST)) {
    //echo("post: ");
    //echo("<br>");
    //var_dump($_POST);
    $targetHost = $_POST['targetHost'];
    $managerHost = $_POST['managerHost'];
    $packageName = $_POST['packageName'];
    $packageVersion = $_POST['packageVersion'];
    $packageAction = $_POST['Action'];
    //echo("<br>");
}
require_once __DIR__ . '/../includes/DbAction.php';
require_once __DIR__ . "/../includes/session.php";
require_once __DIR__ . "/../includes/restclient.php";

# get needed class
$me = new Session();
$rest = new restclient();
$dba = new DbAction();
$dbh = $dba->Connect();
$me->start_session();
$me->is_session_started();

$target = [];
//echo '<br>------------------------<br>';

$manager_data = $dba->hostManagerid2ip($dbh, $managerHost);
$manager_id = $manager_data[0]['machine_id'];
$target_data = $dba->targetHostInf($dbh, $targetHost, $manager_id);

try {
    $response = $rest->package_Action(
        $manager_data[0]['ipaddress'],
        $manager_data[0]['port'],
        $manager_data[0]['username'],
        $manager_data[0]['password'],
        $target_data[0]['ipaddress'],
        $target_data[0]['os'],
        $packageName,
        $packageVersion,
        $packageAction
    );
} catch(Exception $e) {
    echo($e);
}
if (isset($response->body->agent->Result)) {
    echo($response->body->agent->Result);
} else {
    kint::dump($response);
}