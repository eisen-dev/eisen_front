<?php

class DBaction {
    # start session if is not already started
    # always needed for use session
    public function Connect()
    {
        require_once '/connect.php';

        $dsn = "mysql:dbname=$db_name;host=$db_host;charset=utf8";
        //データベース接続
        try {
                $dbh = new PDO($dsn, $db_user, $db_pass,
                array(PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            exit('データベース接続に失敗しました' . $e->getMessage());
        }
        return $dbh;
    }
}