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

require_once 'includes/session.php';

$me = new Session();
$me->start_session();
$me->is_session_started();

// get language preference
if (isset($_GET['lang'])) {
    $language = $_GET['lang'];
} elseif (isset($_SESSION['lang'])) {
    $language  = $_SESSION['lang'];
} else {
    $language = 'ja_JP.UTF8';
}

//$language = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
// save language preference for future page requests
$_SESSION['Language']  = $language;

$folder = 'locale';
$domain = 'messages';
$encoding = 'UTF-8';

putenv('LANG=' . $language);
setlocale(LC_ALL, $language);

bindtextdomain($domain, $folder);
bind_textdomain_codeset($domain, $encoding);

textdomain($domain);
