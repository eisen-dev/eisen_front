<?php


class DbAction {
    # connect to database
    /**
     * @return PDO
     */
    public function Connect()
    {
        //set static directory
        #TODO use ini config file instead of php.
        include dirname(__FILE__).'/../connect.php';

        if (!empty($db_name)) {
            var_dump($db_name);
        }
        if (!empty($db_host)) {
            var_dump($db_host);
        }

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
        $stm = $dbh->prepare("select * from machine_info WHERE user_id=:user_id;");
        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        //var_dump($data);
        $myMachine = array();
        foreach ($data as $i => $row) {
            $myMachine += array($row['module'],
                $row['ipaddress'],
                $row['port'],
                $row['username'],
                $row['password'],
                $row['status_id'],
                $row['user_id']);
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
    public function UpdateInstalledPackageList($data,$dbh){
        $test= none;
        foreach ($data as $value){
            try {
                $sqlcheck = $dbh->prepare("SELECT COUNT(*) FROM pack_info WHERE pack_category = :pack_cat AND pack_name = :pack_name AND pack_version = :pack_version AND pack_sys_id = :pack_sys_id;");
                //connect as appropriate as above
                $sqlcheck-> bindParam(':pack_cat', $value[0], PDO::PARAM_STR);
                $sqlcheck-> bindParam(':pack_name', $value[1], PDO::PARAM_STR);
                $sqlcheck-> bindParam(':pack_version', $value[2], PDO::PARAM_STR);
                $sqlcheck-> bindParam(':pack_sys_id', $test, PDO::PARAM_INT);
                $sqlcheck->execute();
                $result = $sqlcheck->fetchAll(PDO::FETCH_NUM);
                if (in_array(0,$result[0]))
                {
                    try {
                        $query = $dbh->prepare('INSERT INTO pack_info (pack_category, pack_name, pack_version, pack_summary, pack_sys_id) VALUES (:pack_cat, :pack_name, :pack_version, NULL, :pack_sys_id);');
                        $query-> bindParam(':pack_cat', $value[0], PDO::PARAM_STR);
                        $query-> bindParam(':pack_name', $value[1], PDO::PARAM_STR);
                        $query-> bindParam(':pack_version', $value[2], PDO::PARAM_STR);
                        $query-> bindParam(':pack_sys_id', $test, PDO::PARAM_INT);
                        //$query-> bindParam(':pack_expl', NULL, PDO::PARAM_STR);
                        echo var_dump($query);
                        $query->execute(); //invalid query!
                    } catch(PDOException $ex) {
                        echo "An Error occured!"; //user friendly message
                        this.some_logging_function($ex->getMessage());
                    }
                }
            } catch(PDOException $ex) {
                echo "An Error occured!"; //user friendly message
                this.some_logging_function($ex->getMessage());
            }
        }
    }
    public function UpdateRepositoryPackageList($data,$dbh){
        $test= none;
        foreach ($data as $value) {
            try {
                $sqlcheck = $dbh->prepare("SELECT COUNT(*) FROM pack_info WHERE pack_category = :pack_cat AND pack_name = :pack_name AND pack_version = :pack_version AND pack_sys_id = :pack_sys_id;");
                //connect as appropriate as above
                $sqlcheck->bindParam(':pack_cat', $value[0], PDO::PARAM_STR);
                $sqlcheck->bindParam(':pack_name', $value[1], PDO::PARAM_STR);
                $sqlcheck->bindParam(':pack_version', $value[2], PDO::PARAM_STR);
                $sqlcheck->bindParam(':pack_sys_id', $test, PDO::PARAM_INT);
                $sqlcheck->execute();
                $result = $sqlcheck->fetchAll(PDO::FETCH_NUM);
                if (in_array(0, $result[0])) {
                    try {
                        $query = $dbh->prepare('INSERT INTO pack_info (pack_category, pack_name, pack_version, pack_summary, pack_sys_id) VALUES (:pack_cat, :pack_name, :pack_version, NULL, :pack_sys_id);');
                        $query->bindParam(':pack_cat', $value[0], PDO::PARAM_STR);
                        $query->bindParam(':pack_name', $value[1], PDO::PARAM_STR);
                        $query->bindParam(':pack_version', $value[2], PDO::PARAM_STR);
                        $query->bindParam(':pack_sys_id', $test, PDO::PARAM_INT);
                        //$query-> bindParam(':pack_expl', NULL, PDO::PARAM_STR);
                        echo var_dump($query);
                        $query->execute(); //invalid query!
                    } catch (PDOException $ex) {
                        echo "An Error occured!"; //user friendly message
                        //some_logging_function($ex->getMessage());
                    }
                }
            } catch (PDOException $ex) {
                echo "An Error occured!"; //user friendly message
                //some_logging_function($ex->getMessage());
            }
        }
    }
}