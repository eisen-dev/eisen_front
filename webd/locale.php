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

define('SESSION_LOCALE_KEY', 'eisen_locale');
define('DEFAULT_LOCALE', 'en_US');
define('LOCALE_REQUEST_PARAM', 'lang');
define('WEBSITE_DOMAIN', 'messages');

if (array_key_exists(LOCALE_REQUEST_PARAM, $_REQUEST)) {
    $current_locale = $_REQUEST[LOCALE_REQUEST_PARAM];
    $_SESSION[SESSION_LOCALE_KEY] = $current_locale;
} elseif (array_key_exists(SESSION_LOCALE_KEY, $_SESSION)) {
    $current_locale = $_SESSION[SESSION_LOCALE_KEY];
} else {
    $current_locale = DEFAULT_LOCALE;
}

$folder = 'locale';
$encoding = 'UTF-8';

putenv("LC_ALL=$current_locale");
setlocale(LC_ALL, $current_locale);

bindtextdomain(WEBSITE_DOMAIN, $folder);
bind_textdomain_codeset(WEBSITE_DOMAIN, $encoding);

textdomain(WEBSITE_DOMAIN);
