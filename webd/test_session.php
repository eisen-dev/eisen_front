<?php
require_once "includes/session.php";
$me = new Session();
$me->is_session_started();
$me->set_user_id('test');
print $me->get_user_id();
?>