<?php
require_once __DIR__."/includes/restclient.php";
require_once __DIR__ . '/includes/DbAction.php';
require_once __DIR__."/includes/session.php";

$me = new Session();
$me->start_session();
$me->is_session_started();

$dba = new DbAction();
$dbh = $dba->Connect();
$user_id = $me->get_user_id();

$machine = $dba->MachineList($user_id,$dbh);
$module=$machine[0];
$ipaddress=$machine[1];
$port=$machine[2];
$username=$machine[3];
$password=$machine[4];
$rest = new restclient();
//$rest->restconnect($ipaddress,$port,$username,$password);
$hosts = $rest->tasks_list($ipaddress,$port,$username,$password);

var_dump($hosts);
foreach ($hosts as $i=>$row) {
    var_dump($i);
    var_dump($row->command);
}
//$response = \Httpful\Request::post($uri2)                  // Build a PUT request...
//->sendsJson()                               // tell it we're sending (Content-Type) JSON...
//->authenticateWith('ansible', 'default')  // authenticate with basic auth...
//->body('{"hosts":"vmware","command":"uptime","module":"shell"}')             // attach a body/payload...
//->send();                                   // and finally, fire that thing off!
