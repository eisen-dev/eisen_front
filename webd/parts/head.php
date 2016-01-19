<meta charset="UTF-8">
<title><?php echo $title; ?></title>
<?php
    require_once "includes/session.php";
    require_once "includes/restclient.php";
    $me = new Session();
    $me->start_session();
    $me->is_session_started();
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="icon" href="images/favicon.png" type="image/png">
<link rel="stylesheet" type="text/css" href="includes/normalize.css">
<link rel="stylesheet" href="includes/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="sass/style.css">
<script src="includes/charts/Chart.js"></script>
<script type="text/javascript" src="includes/jquery/jquery-2.1.4.js"></script>
