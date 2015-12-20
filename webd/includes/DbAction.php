<?php


class DbAction {
    # connect to database
    /**
     * @return PDO
     */
    public function Check(){
        #TODO use ini config file instead of php.
        include dirname(__FILE__) . '/../connect.php';
        if (!empty($db_host)) {
        }
        if (!empty($db_user)) {
            $login = ($db_user);
        }
        if (!empty($db_pass)) {
            $password = ($db_pass);
        }
        if (!empty($db_name)) {
        }
        $opt = array(
            // any occurring errors wil be thrown as PDOException
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // an SQL command to execute when connecting
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        );

        $dsn = "mysql:host=$db_host";
        $pdo = new PDO($dsn, $login, $password,$opt);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dbname = "`".str_replace("`","``",$db_name)."`";
        $pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
        $pdo->query("use $dbname");
    }

    public function Connect()
    {
        //set static directory
        #TODO use ini config file instead of php.
        include dirname(__FILE__) . '/../connect.php';

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
                        ini_set('max_execution_time', 0); //300 seconds = 5 minutes
                    }
                }
            }
        } catch (PDOException $e) {
            exit('データベース接続に失敗しました' . $e->getMessage());
        }
        return $dbh;
    }

    public function TableCreation($dbh) {

        $this->CreateDbTable(
            'user_info',
            array(
                'unique_id' => 'INT AUTO_INCREMENT',
                'user_id' => 'VARCHAR(75)',
                'password' => 'VARCHAR(40)',
                'mail_address' => 'VARCHAR(60)',
            ),$dbh);

        $this->CreateDbTable(
            'manager_host',
            array(
                'machine_id' => 'INT AUTO_INCREMENT',
                'ipaddress' => 'VARCHAR(20)',
                'port' => 'VARCHAR(60)',
                'module' => 'VARCHAR(60)',
                'username' => 'VARCHAR(60)',
                'password' => 'VARCHAR(60)',
                'status_id' => 'VARCHAR(60)',
                'user_id' => 'VARCHAR(75)'
            ),$dbh);

        $this->CreateDbTable(
            'target_host',
            array(
                'host_id' => 'INT AUTO_INCREMENT',
                'ipaddress' => 'VARCHAR(20)',
                'port' => 'VARCHAR(60)',
                'group' => 'VARCHAR(60)',
                'os' => 'VARCHAR(60)',
                'status_id' => 'VARCHAR(60)',
                'machine_id' => 'INT'
            ),$dbh);

        $this->CreateDbTable(
            'pack_management_system',
            array(
                'pack_sys_id' => 'INT AUTO_INCREMENT',
                'pack_sys_name'=> 'VARCHAR(60)',
                'pack_sys_version' => 'VARCHAR(60)',
                'all_sys_pack_hash' => 'VARCHAR(60)',
                'installed_sys_pack_hash' => 'VARCHAR(60)',
                'machine_id'=> 'INT NOT NULL'
            ),$dbh);
#TODO  Alter table installed_package ADD CONSTRAINT installed_package_uc    UNIQUE INDEX (pack_sys_id, installed_pack_name);
# CREATE UNIQUE INDEX installed_package_uc ON installed_package (pack_sys_id ASC, installed_pack_name ASC);
        $this->CreateDbTable(
            'installed_package',
            array(
                'installed_pack_id' => 'INT AUTO_INCREMENT',
                'installed_pack_category'=> 'VARCHAR(60)',
                'installed_pack_name' => 'VARCHAR(120)',
                'installed_pack_version' => 'VARCHAR(60)',
                'installed_pack_summary' => 'VARCHAR(60)',
                'pack_sys_id' => 'INT NOT NULL'
            ),$dbh);
#TODO  Alter table pack_info ADD CONSTRAINT pack_info_uc    UNIQUE INDEX (pack_sys_id, pack_name);
        $this->CreateDbTable(
            'pack_info',
            array(
                'pack_id' => 'INT AUTO_INCREMENT',
                'pack_category'=> 'VARCHAR(60)',
                'pack_name' => 'VARCHAR(120)',
                'pack_version' => 'VARCHAR(60)',
                'pack_summary' => 'VARCHAR(60)',
                'pack_sys_id' => 'INT NOT NULL'
            ),$dbh);

        $this->CreateDbTable(
            'status',
            array(
                'status_id' => 'INT AUTO_INCREMENT',
                'status_info'=> 'VARCHAR(60)',
            ),$dbh);
    }

    public function MachineList($user_id, $dbh) {
        $stm = $dbh->prepare("select * from manager_host WHERE user_id=:user_id;");
        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
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

    public function installedPackageList($pack_sys_id, $dbh) {
        $stm = $dbh->prepare("select * from installed_package WHERE pack_sys_id=:pack_sys_id;");
        $stm-> bindParam(':pack_sys_id', $pack_sys_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    public function PackageList($pack_sys_id, $dbh) {
        $stm = $dbh->prepare("select * from pack_info WHERE pack_sys_id=:pack_sys_id;");
        $stm-> bindParam(':pack_sys_id', $pack_sys_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    public function CountPackage($pack_sys_id, $dbh) {
        $cnt=array();
        $stm = $dbh->prepare("select * from installed_package WHERE pack_sys_id=:pack_sys_id;");
        $stm-> bindParam(':pack_sys_id', $pack_sys_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt['installed_package']  = count($data); //in case you need to count all rows
        $stm = $dbh->prepare("select * from pack_info WHERE pack_sys_id=:pack_sys_id;");
        $stm-> bindParam(':pack_sys_id', $pack_sys_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt['pack_info']  = count($data); //in case you need to count all rows
        return $cnt;
    }

    public function installedPackageSearch($pack_sys_id, $dbh, $search) {
        $search = "%$search%";
        $stm = $dbh->prepare("select * from installed_package WHERE pack_sys_id=:pack_sys_id AND installed_pack_name LIKE :search ;");
        $stm-> bindParam(':search', $search, PDO::PARAM_STR);
        $stm-> bindParam(':pack_sys_id', $pack_sys_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    public function PackageSearch($pack_sys_id, $dbh, $search) {
        $search = "%$search%";
        $stm = $dbh->prepare("select * from pack_info WHERE pack_sys_id=:pack_sys_id AND pack_name LIKE :search ;");
        $stm-> bindParam(':search', $search, PDO::PARAM_STR);
        $stm-> bindParam(':pack_sys_id', $pack_sys_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
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

    public function UpdateInstalledPackageListFast($data,$dbh){
        $test2 = 'test';
        $test3=1;
        $query = $dbh->prepare('INSERT INTO installed_package (installed_pack_category, installed_pack_name, installed_pack_version, installed_pack_summary, pack_sys_id) VALUES (:pack_cat, :pack_name, :pack_version, :pack_sum, :pack_sys_id);');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        foreach (explode("\n", $data->stdout) as $item) {
            try {
                $query-> bindParam(':pack_cat', $test2, PDO::PARAM_STR);
                $query-> bindParam(':pack_name', $item, PDO::PARAM_STR);
                $query-> bindParam(':pack_version', $test2, PDO::PARAM_STR);
                $query-> bindParam(':pack_sys_id', $test3, PDO::PARAM_INT);
                $query-> bindParam(':pack_sum', $test2, PDO::PARAM_STR);
                $query->execute(); //invalid query!
            } catch(PDOException $ex) {
                echo"already present<br>";
                //echo "An Error occured!"; //user friendly message
                //$this->some_logging_function($ex->getMessage());
            }
        }
    }

    public function DeleteInstalledPackageListFast($dbh){
        $test2 = 'test';
        $test3=1;
        $query = $dbh->prepare('DELETE FROM installed_package WHERE pack_sys_id = :pack_sys_id ;');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        try {
            $query-> bindParam(':pack_sys_id', $test3, PDO::PARAM_INT);
            $query->execute(); //invalid query!
        } catch(PDOException $ex) {
            echo"already present<br>";
            //echo "An Error occured!"; //user friendly message
            //$this->some_logging_function($ex->getMessage());
        }
    }

    public function UpdatePackageListFast($data,$dbh){
        $test2 = 'test';
        $test3=1;
        $query = $dbh->prepare('INSERT INTO pack_info (pack_category, pack_name, pack_version, pack_summary, pack_sys_id) VALUES (:pack_cat, :pack_name, :pack_version, :pack_sum, :pack_sys_id);');
        foreach (explode("\n", $data->stdout) as $item) {
            try {
                $query-> bindParam(':pack_cat', $test2, PDO::PARAM_STR);
                $query-> bindParam(':pack_name', $item, PDO::PARAM_STR);
                $query-> bindParam(':pack_version', $test2, PDO::PARAM_STR);
                $query-> bindParam(':pack_sys_id', $test3, PDO::PARAM_INT);
                $query-> bindParam(':pack_sum', $test2, PDO::PARAM_STR);
                $query->execute(); //invalid query!
            } catch (PDOException $ex) {
                echo "An Error occured!1"; //user friendly message
                $this->some_logging_function($ex->getMessage());
            }
        }
    }

    public function DeletePackageListFast($dbh){
        $test2 = 'test';
        $test3=1;
        $query = $dbh->prepare('DELETE FROM pack_info WHERE pack_sys_id = :pack_sys_id ;');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        try {
            $query-> bindParam(':pack_sys_id', $test3, PDO::PARAM_INT);
            $query->execute(); //invalid query!
        } catch(PDOException $ex) {
            echo"already present<br>";
            //echo "An Error occured!"; //user friendly message
            //$this->some_logging_function($ex->getMessage());
        }
    }

    public function md5sumInstallPackage($data,$dbh){
        $test2 = 'test';
        $test3=1;
        $query = $dbh->prepare('INSERT INTO pack_management_system
            (pack_sys_id, pack_sys_name, pack_sys_version, installed_sys_pack_hash, machine_id)
            VALUES (:pack_sys_id, :pack_sys_name, :pack_sys_version, :installed_sys_pack_hash, :machine_id)
            ON DUPLICATE KEY UPDATE installed_sys_pack_hash = VALUES (installed_sys_pack_hash) ;');
        try {
            $query-> bindParam(':pack_sys_id', $test3, PDO::PARAM_INT);
            $query-> bindParam(':pack_sys_name', $test2, PDO::PARAM_STR);
            $query-> bindParam(':pack_sys_version', $test2, PDO::PARAM_STR);
            $query-> bindParam(':installed_sys_pack_hash', $data, PDO::PARAM_STR);
            $query-> bindParam(':machine_id', $test3, PDO::PARAM_INT);
            $query->execute(); //invalid query!
            return ($query->rowCount());
        } catch (PDOException $ex) {
            echo "An Error occured! (md5sumInstallPackage)"; //user friendly message
            $this->some_logging_function($ex->getMessage());
        }
        return 'error';
        //}
    }

    public function md5sumAllPackage($data,$dbh){
        $test2 = 'test';
        $test3=1;
        $query = $dbh->prepare('INSERT INTO pack_management_system
            (pack_sys_id, pack_sys_name, pack_sys_version, all_sys_pack_hash, machine_id)
            VALUES (:pack_sys_id, :pack_sys_name, :pack_sys_version, :all_sys_pack_hash, :machine_id)
            ON DUPLICATE KEY UPDATE all_sys_pack_hash = VALUES (all_sys_pack_hash) ;');
        try {
            $query-> bindParam(':pack_sys_id', $test3, PDO::PARAM_INT);
            $query-> bindParam(':pack_sys_name', $test2, PDO::PARAM_STR);
            $query-> bindParam(':pack_sys_version', $test2, PDO::PARAM_STR);
            $query-> bindParam(':all_sys_pack_hash', $data, PDO::PARAM_STR);
            $query-> bindParam(':machine_id', $test3, PDO::PARAM_INT);
            $query->execute(); //invalid query!
            return ($query->rowCount());
        } catch (PDOException $ex) {
            echo "An Error occured! (md5sumInstallPackage)"; //user friendly message
            $this->some_logging_function($ex->getMessage());
        }
        //}
    }
}