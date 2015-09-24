<?php
    if(isset($_POST['continue'])) {
        //Open/Create file.
        $datei = fopen("connect.php", "w+");
            
        //Write file.
        $content = '<?php'."\n";
        $content = $content.'  $db_host = "'.$_POST['db_host'].'";'."\n";
        $content = $content.'  $db_name = "'.$_POST['db_name'].'";'."\n";
        $content = $content.'  $db_user = "'.$_POST['db_user'].'";'."\n";
        $content = $content.'  $db_pass = "'.$_POST['db_pass'].'";'."\n";
        $content = $content.'?>';
        fwrite($datei, $content);
        fclose($datei);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Install</title>
    </head>
    <body>
        <h1>Install</h1>
        <p>Fill out the fields and press continue:</p>
        <form action="" method="post">
            <p>Database Host</p>
            <input type="text" placeholder="Database Host" name="db_host"><br>
            <p>Database Name</p>
            <input type="text" placeholder="Database Name" name="db_name"><br>
            <p>Database Username</p>
            <input type="text" placeholder="Username" name="db_user"><br>
            <p>Database Password</p>
            <input type="password" placeholder="Password" name="db_pass"><br>
            <br>
            <input type="submit" value="Continue" name="continue"/>
        </form>
        <p>初期データの投入が必要です。</p>
        <p>mysql -u <db_user> -p <password> <db_name> < sql/database.sql</p>
    </body>
</html>