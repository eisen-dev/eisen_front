<?php

class DbAction {
    # connect to database
    public function Connect()
    {
        require_once '/connect.php';

        if (!empty($db_name)) {
            if (!empty($db_host)) {
                $dsn = "mysql:dbname=$db_name;host=$db_host;charset=utf8";
            }
        }
        //データベース接続
        try {
            if (!empty($db_user)) {
                if (!empty($db_pass)) {
                    if (!empty($dsn)) {
                        $dbh = new PDO($dsn, $db_user, $db_pass,
                        array(PDO::ATTR_EMULATE_PREPARES => false,
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }
                }
            }
        } catch (PDOException $e) {
            exit('データベース接続に失敗しました' . $e->getMessage());
        }
        return $dbh;
    }

    public function MachineList($user_id, $dbh) {
        $stm = $dbh->prepare("select * from machine_information WHERE user_id=:user_id;");
        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        //var_dump($data);
        $myMachine = array();
        foreach ($data as $i => $row) {
            $myMachine += array($row['machine_name'],
            $row['ipaddress'],
            $row['port'],
            $row['os'],
            $row['status_id']);
            }
        return $myMachine;
    }

    public function some_logging_function($log){
        echo 'LOG : ' . $log . '<br />';
    }

    public function CreateDbTable($table,$fields,$dbh)
    {

        $sql = "CREATE TABLE IF NOT EXISTS `$table` (";
        $pk  = '';

        foreach($fields as $field => $type)
        {
            $sql.= "`$field` $type,";

            if (preg_match('/AUTO_INCREMENT/i', $type))
            {
                $pk = $field;
            }
        }

        $sql = rtrim($sql,',') . ', PRIMARY KEY (`'.$pk.'`)';

        $sql .= ") CHARACTER SET utf8 COLLATE utf8_general_ci";
        try {
            $dbh->query($sql); //invalid query!
        } catch(PDOException $ex) {
            echo "An Error occured!"; //user friendly message
            some_logging_function($ex->getMessage());
        }
    }
}