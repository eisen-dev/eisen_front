<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<?php
	require_once "includes/session.php";
	require_once "includes/restclient.php";
	$me = new Session();
	$me->start_session();
	$me->is_session_started();
    /**
     * setting website language with gettext
     */
    $locale = 'en_US';

    if (!defined('LC_MESSAGES') || !setlocale(LC_ALL, $locale)) {
        putenv("LC_ALL=$locale");
    }

    $domain = 'messages';
    $path = "locales/";
    $codeset = 'UTF-8';

    bindtextdomain($domain, $path);
    textdomain($domain);
    bind_textdomain_codeset($domain, $codeset);

    echo gettext("name");
    ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" href="images/favicon.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="includes/normalize.css">
	<link rel="stylesheet" href="includes/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="sass/style.css">
    <script src="includes/charts/Chart.js"></script>
    <script type="text/javascript" src="includes/jquery/jquery-2.1.4.js"></script>
</head>
