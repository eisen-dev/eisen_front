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

    require_once __DIR__ . '/../vendor/autoload.php';

    define('KINT_LOG', '/vagrant/webd/logs/kint.log.html');

    /**
     * Logs Kint::dump() to file
     */
    function l()
    {
        if ( !Kint::enabled() ) return;

        $args = func_get_args();
        foreach ($args as $arg) {
            $dump = @Kint::dump($arg);
            $content = sprintf('%s:<br />%s', date('Y-m-d H:i:s'), $dump);
            file_put_contents(KINT_LOG, $content, FILE_APPEND);
        }
    }

    /**
     * Logs Kint::dump() to file
     * [!!!] IMPORTANT: execution will halt after call to this function
     */
    function ld()
    {
        if ( !Kint::enabled() ) return;

        $args = func_get_args();
        call_user_func_array('l', $args);
        die;
    }