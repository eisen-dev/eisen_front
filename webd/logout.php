<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/12/04
 * Time: 9:47
 */
require_once __DIR__ . "/includes/session.php";

$me = new Session();
$me->start_session();
$me->is_session_started();
$me->logoff_user_id();
header('location:login.php');