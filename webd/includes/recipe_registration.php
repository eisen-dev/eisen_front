<?php
/**
 * Eisen Frontend
 * http://eisen-dev.github.io
 *
 * Copyright (c) 2016 Alice Ferrazzi <alice.ferrazzi@gmail.com> - Takuma Muramatsu <t.muramatu59@gmail.com>
 * Dual licensed under the MIT or GPL Version 3 licenses or later.
 * http://eisen-dev.github.io/License.md
 *
 */

    require_once __DIR__ . '/DbAction.php';
    require_once __DIR__ . "/session.php";
    require_once __DIR__ . "/restclient.php";

    if (isset($_POST['submit'])) {
        $manager_host = htmlspecialchars($_POST["manager_host"]);
        $target_host = htmlspecialchars($_POST["target_hosts"]);
        $package = htmlspecialchars($_POST["package"]);
        # module variable already used for machinelist
        $file = htmlspecialchars($_POST["file"]);
    }
    printf($command);
    $me = new Session();
    $me->start_session();
    $me->is_session_started();

    $dba = new DbAction();
    $dbh = $dba->Connect();
    $user_id = $me->get_user_id();

    $machine = $dba->hostManagerActiveList($user_id, $dbh);
    $rest = new restclient();
    $rest->recipe_register(
        $manager_host,
        $machine[0]['port'],
        $machine[0]['username'],
        $machine[0]['password'],
        $target_host,
        $package,
        $file
    );

    header('location:../recipe_list.php?target='.$target_host.'&os=');