<?php

require_once __DIR__ . "/includes/session.php";

$me = new Session();
$me->start_session();
$me->is_session_started();
$me->logoff_user_id();
header('location:login.php');