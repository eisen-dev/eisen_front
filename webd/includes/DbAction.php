<?php

/**
 * Class DbAction
 */
class DbAction
{

    /** Check DB connection
     *
     * @return PDO
     */
    public function Check()
    {
        #TODO use ini config file instead of php.
        include dirname(__FILE__) . '/../connect.php';
        if (!empty($db_host)) {
        }
        if (!empty($db_user)) {
            $login = $db_user;
        }
        if (!empty($db_pass)) {
            $password = $db_pass;
        }
        if (!empty($db_name)) {
        }
        $opt = [
            // any occurring errors wil be thrown as PDOException
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // an SQL command to execute when connecting
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ];

        $dsn = "mysql:host=$db_host";
        $pdo = new PDO($dsn, $login, $password, $opt);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dbname = "`".str_replace("`", "``", $db_name)."`";
        $pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
        $pdo->query("use $dbname");
    }

    /** Connect to DataBase
     *
     * Simple function for connecting to DB
     * or testing that DB is working correctly.
     *
     * @return PDO
     */
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
                        $dbh = new PDO(
                            $dsn,
                            $db_user,
                            $db_pass,
                            [
                            PDO::ATTR_EMULATE_PREPARES => false,
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                            ]
                        );
                        ini_set('max_execution_time', 0); //300 seconds = 5 minutes
                    }
                }
            }
        } catch (PDOException $e) {
            // if DB don't exist sending to DB setup page
            echo('データベース接続に失敗しました' . $e->getMessage());
            header('location:init-setup1.php');
        }
        return $dbh;
    }

    /** Create DB Structure
     *
     * called by init-setup1 form
     * Creating DB structure.
     *
     * @param $dbh
     */
    public function TableCreation($dbh)
    {

        $this->CreateDbTable(
            'user_info',
            [
                'unique_id' => 'INT AUTO_INCREMENT',
                'user_id' => 'VARCHAR(75)',
                'password' => 'VARCHAR(40)',
                'mail_address' => 'VARCHAR(60)',
            ],
            $dbh
        );

        $this->CreateDbTable(
            'manager_host',
            [
                'machine_id' => 'INT AUTO_INCREMENT',
                'ipaddress' => 'VARCHAR(20)',
                'port' => 'VARCHAR(60)',
                // module activated in the manager host
                'module' => 'VARCHAR(60)',
                'username' => 'VARCHAR(60)',
                'password' => 'VARCHAR(60)',
                // status of the manager host [online, offline]
                'status_id' => 'VARCHAR(60)',
                // user associated with the manager host
                'user_id' => 'VARCHAR(75)',
                // if we are currently using this manager host [0 = not used, 1 = used]
                'active' => 'INT'
            ],
            $dbh
        );

        $this->CreateDbTable(
            'target_host',
            [
                'host_id' => 'INT AUTO_INCREMENT',
                'ipaddress' => 'VARCHAR(20)',
                'port' => 'VARCHAR(60)',
                // REMEMBER: group is a mysql reserved word.
                'groups' => 'VARCHAR(60)',
                'os' => 'VARCHAR(60)',
                'status_id' => 'VARCHAR(60)',
                'machine_id' => 'INT',
                'user_id' => 'VARCHAR(75)',
                // if we are currently using this target host [0 = not used, 1 = used]
                'active' => 'INT'
            ],
            $dbh
        );

        $this->CreateDbTable(
            'pack_management_system',
            [
                'pack_sys_id' => 'INT AUTO_INCREMENT',
                'pack_sys_name'=> 'VARCHAR(60)',
                'pack_sys_version' => 'VARCHAR(60)',
                'all_sys_pack_hash' => 'VARCHAR(60)',
                'installed_sys_pack_hash' => 'VARCHAR(60)',
                'machine_id'=> 'INT NOT NULL',
                'target_host' => 'VARCHAR(60)'
            ],
            $dbh
        );

        $this->CreateDbTable(
            'installed_package',
            [
                'installed_pack_id' => 'INT AUTO_INCREMENT',
                'installed_pack_category'=> 'VARCHAR(60)',
                'installed_pack_name' => 'VARCHAR(120)',
                'installed_pack_version' => 'VARCHAR(60)',
                'installed_pack_summary' => 'VARCHAR(60)',
                'pack_sys_id' => 'INT NOT NULL',
                'target_host' => 'VARCHAR(60)',
                'manager_host' => 'VARCHAR(60)'
            ],
            $dbh
        );

        $this->CreateDbTable(
            'pack_info',
            [
                'pack_id' => 'INT AUTO_INCREMENT',
                'pack_category'=> 'VARCHAR(60)',
                'pack_name' => 'VARCHAR(120)',
                'pack_version' => 'VARCHAR(60)',
                'pack_summary' => 'VARCHAR(60)',
                'pack_sys_id' => 'INT NOT NULL',
                'target_host' => 'VARCHAR(60)',
                'manager_host' => 'VARCHAR(60)'
            ],
            $dbh
        );

        $this->CreateDbTable(
            'status',
            [
                'status_id' => 'INT AUTO_INCREMENT',
                'status_info'=> 'VARCHAR(60)',
            ],
            $dbh
        );

        // Making constraint for have unique installed package linked to package system id only
        $stm = $dbh->prepare('Alter table installed_package ADD CONSTRAINT installed_package_uc
UNIQUE INDEX (pack_sys_id, installed_pack_name);');
        $stm->execute();
        // same for all the rest of package
        $stm = $dbh->prepare('Alter table pack_info ADD CONSTRAINT pack_info_uc
UNIQUE INDEX (pack_sys_id, pack_name)');
        $stm->execute();
        // also for target host table update checking for duplicates
        $stm = $dbh->prepare('Alter table target_host ADD CONSTRAINT target_host_uc
UNIQUE INDEX (ipaddress, machine_id)');
        $stm->execute();
    }

    public function MachineList($user_id, $dbh) {
        $stm = $dbh->prepare('select * from manager_host WHERE user_id=:user_id;');
        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        $myMachine = array();
        foreach ($data as $i => $row) {
            $myMachine += [
                $row['machine_id'],
                $row['module'],
                $row['ipaddress'],
                $row['port'],
                $row['username'],
                $row['password'],
                $row['active'],
                $row['status_id'],
                $row['user_id']
            ];
        }
        return $myMachine;
    }

    public function TargetList($user_id, $dbh) {
        $stm = $dbh->prepare("select * from target_host WHERE user_id=:user_id;");
        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    /**
     * @param $hosts
     * @param $dbh
     * @param $machine_id Associated manager host id Int
     * @param $status_id
     */
    public function TargetHostRegistration($hosts, $dbh, $machine_id, $user_id) {
        $status_id = 'unknown';
        $os = 'unknown';
        $query = $dbh->prepare('INSERT INTO target_host (ipaddress, port, groups, os, status_id, machine_id, user_id)
        VALUES (:ipaddress, :port, :groups, :os, :status_id, :machine_id, :user_id);');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        foreach ($hosts as $i=>$row) {
            try {
                $query-> bindParam(':ipaddress', $row->host, PDO::PARAM_STR);
                $query-> bindParam(':port', $row->port, PDO::PARAM_STR);
                $query-> bindParam(':groups', $row->groups, PDO::PARAM_STR);
                $query-> bindParam(':os', $os, PDO::PARAM_STR);
                $query-> bindParam(':status_id', $status_id, PDO::PARAM_STR);
                $query-> bindParam(':machine_id', $machine_id, PDO::PARAM_STR);
                $query-> bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $query->execute(); //invalid query!
            } catch(PDOException $ex) {
                //echo "An Error occured!"; //user friendly message
                //$this->some_logging_function($ex->getMessage());
            }
        }
    }

    /**Update Target Host os
     *
     * Checking with witch Operating System system we are dealing
     *
     * Ubuntu
     * Gentoo
     * Debian
     * Arch
     *
     * @param $host to be updated as String
     * @param $dbh DB connection object
     * @param $os os string name
     */
    public function TargetHostUpdateOS($host, $dbh, $os) {
        $query = $dbh->prepare('UPDATE target_host SET os=:os WHERE ipaddress = :ipaddress ;');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
            try {
                $query-> bindParam(':ipaddress', $host, PDO::PARAM_STR);
                $query-> bindParam(':os', $os, PDO::PARAM_INT);
                $query->execute(); //invalid query!
            } catch(PDOException $ex) {
                echo"already present<br>";
                //echo "An Error occured!"; //user friendly message
                //$this->some_logging_function($ex->getMessage());
            }
    }

    /**
     *
     *
     * @param $pack_sys_id
     * @param $dbh
     *
     * @return mixed
     */
    public function installedPackageList($pack_sys_id, $dbh)
    {
        $stm = $dbh->prepare("select * from installed_package WHERE pack_sys_id=:pack_sys_id;");
        $stm-> bindParam(':pack_sys_id', $pack_sys_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    public function PackageList($pack_sys_id, $dbh)
    {
        $stm = $dbh->prepare("select * from pack_info WHERE pack_sys_id=:pack_sys_id;");
        $stm-> bindParam(':pack_sys_id', $pack_sys_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    public function CountPackage($pack_sys_id, $dbh)
    {
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

    /**
     * @param $target_host
     * @param $dbh
     * @param $search
     *
     * @return mixed
     */
    public function installedPackageSearch($target_host, $dbh, $search)
    {
        $search = "%$search%";
        $stm = $dbh->prepare('
select * from installed_package
WHERE target_host=:target_host
AND installed_pack_name
LIKE :search ;');
        $stm-> bindParam(':search', $search, PDO::PARAM_STR);
        $stm-> bindParam(':pack_sys_id', $target_host, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    public function PackageSearch($pack_sys_id, $dbh, $search)
    {
        $search = "%$search%";
        $stm = $dbh->prepare("select * from pack_info WHERE pack_sys_id=:pack_sys_id AND pack_name LIKE :search ;");
        $stm-> bindParam(':search', $search, PDO::PARAM_STR);
        $stm-> bindParam(':pack_sys_id', $pack_sys_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    public function some_logging_function($log)
    {
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
        } catch (PDOException $ex) {
            echo "An Error occured!"; //user friendly message
            some_logging_function($ex->getMessage());
        }
    }
}
