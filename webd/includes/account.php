<?php
//issetでpostを全部チェックした方がいい
if(isset($_POST['submit'])){
    $old_pass = htmlspecialchars(sha1($_POST["old_pass"]));
    $mail = htmlspecialchars($_POST["mail"]);
    $new_pass = htmlspecialchars(sha1($_POST["new_pass"]));
    $confirm_pass = htmlspecialchars(sha1($_POST["confirm_pass"]));
}
require_once "../connect.php";

session_start();

print $old_pass.'<br>';
print $mail.'<br>';
print $confirm_pass.'<br>';
print $new_pass.'<br>';

if(!isset($_SESSION['login_user'])) {
    print "logged off";
} else {
        if ($new_pass == $confirm_pass) {
            $user_id = $_SESSION['login_user'];

        function some_logging_function($log)
        {
            echo 'LOG : ' . $log . '<br />';
        }

        //データベースに接続するために必要な情報(PDO)
        $dsn = "mysql:dbname=$db_name;host=$db_host;charset=utf8";

        //データベース接続
        try {
            $dbh = new PDO($dsn, $db_user, $db_pass,
                array(PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            exit('データベース接続に失敗しました' . $e->getMessage());
        }
        try {
            $query = $dbh->prepare('UPDATE user_info SET mail_address = :mail, password = :new_password WHERE user_id=:user_id;');
            $query->bindParam(':mail', $mail, PDO::PARAM_STR);
            $query->bindParam(':new_password', $password, PDO::PARAM_STR);
            $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            echo var_dump($query);
            $query->execute(); //invalid query!
        } catch (PDOException $ex) {
            //echo "An Error occured!"; //user friendly message
            some_logging_function($ex->getMessage());
        }
        }else{
            print "password is wrong!";
        }
}
?>