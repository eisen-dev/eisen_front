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

$dba = new DbAction();
$dbh = $dba->Connect();
$packageResult = $dba->packageCheckNotRead($dbh);
$dba->packageSetRead($dbh);
echo $packageResult[0]['COUNT(*)'];
