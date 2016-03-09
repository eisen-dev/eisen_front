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

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/monologLogger.php';
require_once __DIR__ . '/../kintlog.php';
use Monolog\Logger;


/**
 * Class DbAction
 */
class DbAction
{
    /**
     * @return Logger
     */
    public function logger()
    {
        $log = new LoggerAtOnce();
        $log = $log->loggerInject();

        return $log;
    }

    /**
     * @param $error
     */
    public function errorHandler($error)
    {
        $log = $this->logger();
        $log->addError($error);
    }

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
        $pdo->query("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8;");
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
            $this->errorHandler($e->getMessage());
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
            'task_result',
            [
                'unique_id' => 'INT AUTO_INCREMENT',
                'task_id' => 'VARCHAR(75)',
                'task_result' => 'VARCHAR(200)',
                'target_host' => 'VARCHAR(20)',
            ],
            $dbh
        );

        $this->CreateDbTable(
            'package_result',
            [
                'unique_id' => 'INT AUTO_INCREMENT',
                'result_string' => 'VARCHAR(75)',
                'packageName' => 'VARCHAR(200)',
                'packageVersion' => 'VARCHAR(20)',
                'targetOS' => 'VARCHAR(516)',
                'targetHost' => 'VARCHAR(516)',
                'task_id' => 'VARCHAR(516)',
                'packageAction' => 'VARCHAR(256)',
                'result_short' => 'VARCHAR(256)',
                'isRead' => 'INT',
            ],
            $dbh
        );

        $this->CreateDbTable(
            'monolog',
            [
                'channel' => 'VARCHAR(255)',
                'level' => 'INTEGER',
                'message' => 'LONGTEXT',
                'time' => 'INTEGER UNSIGNED',
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
        $stm = $dbh->prepare('ALTER TABLE package_result ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL;');
        $stm->execute();
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

    public function hostManagerActiveList($user_id, $dbh) {
        $stm = $dbh->prepare('select * from manager_host WHERE user_id=:user_id AND active= 1;');
        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        $myMachine = array();
        foreach ($data as $i => $row) {
            $myMachine[$i] = [
                'machine_id' => $row['machine_id'],
                'module' => $row['module'],
                'ipaddress' => $row['ipaddress'],
                'port' => $row['port'],
                'username' => $row['username'],
                'password' => $row['password'],
                'active' => $row['active'],
                'status_id' => $row['status_id'],
                'user_id' => $row['user_id']
            ];
        }
        return $myMachine;
    }

    public function hostManagerActiveListFind($user_id, $dbh, $host_manager) {
        $stm = $dbh->prepare('select * from manager_host WHERE user_id=:user_id AND active= 1 AND ipaddress=:host_manager;');
        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stm-> bindParam(':host_manager', $host_manager, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        $myMachine = array();
        foreach ($data as $i => $row) {
            $myMachine[$i] = [
                'machine_id' => $row['machine_id'],
                'module' => $row['module'],
                'ipaddress' => $row['ipaddress'],
                'port' => $row['port'],
                'username' => $row['username'],
                'password' => $row['password'],
                'active' => $row['active'],
                'status_id' => $row['status_id'],
                'user_id' => $row['user_id']
            ];
        }
        return $myMachine;
    }

    public function TargetList($user_id, $machine_id, $dbh) {
        $stm = $dbh->prepare("select * from target_host WHERE user_id=:user_id AND machine_id=:machine_id;");
        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stm-> bindParam(':machine_id', $machine_id, PDO::PARAM_INT);
        $stm->execute();
        $data = $stm->fetchAll();
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
        if (is_array($hosts) || is_object($hosts)) {
            foreach ($hosts as $i => $row) {
                try {
                    $query->bindParam(':ipaddress', $row->host, PDO::PARAM_STR);
                    $query->bindParam(':port', $row->port, PDO::PARAM_STR);
                    $query->bindParam(':groups', $row->groups, PDO::PARAM_STR);
                    $query->bindParam(':os', $os, PDO::PARAM_STR);
                    $query->bindParam(':status_id', $status_id, PDO::PARAM_STR);
                    $query->bindParam(':machine_id', $machine_id, PDO::PARAM_STR);
                    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $query->execute(); //invalid query!
                } catch (PDOException $ex) {
                    // this error just say that the item is already present.
                    //SQLSTATE[23000]: Integrity constraint violation:
                    //non blocking error, do nothing.
                }
            }
        }
    }

    public function taskList($dbh, $task_id)
    {
        $query = $dbh->prepare('SELECT * FROM task_result WHERE task_id = :task_id ;');
        try {
            $query->bindParam(':task_id', $task_id, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetchAll();
            foreach ($data as $i => $row) {
                $myMachine[$i] = [
                    'task_id' => $row['task_id'],
                    'task_result' => $row['task_result'],
                    'target_host' => $row['target_host'],
                ];
            }
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());

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
    public function TargetHostUpdateOS($host, $dbh, $os)
    {
        $query = $dbh->prepare('UPDATE target_host SET os=:os WHERE ipaddress = :ipaddress ;');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
            try {
                $query-> bindParam(':ipaddress', $host, PDO::PARAM_STR);
                $query-> bindParam(':os', $os, PDO::PARAM_INT);
                $query->execute(); //invalid query!
            } catch (PDOException $ex) {
                $this->errorHandler($ex->getMessage());
            }
    }

    /**
     * @param $dbh
     * @param $active set to 1 if activated 0 if deactivated
     * @param $machine_id
     */
    public function hostManagerActive($dbh, $active, $machine_id)
    {
        $query = $dbh->prepare('UPDATE manager_host SET active=:active WHERE machine_id = :machine_id ;');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        try {
            $query-> bindParam(':machine_id', $machine_id, PDO::PARAM_STR);
            $query-> bindParam(':active', $active, PDO::PARAM_INT);
            $query->execute(); //invalid query!
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());
        }
    }

    /**
     * @param $dbh
     * @param $active set to 1 if activated 0 if deactivated
     * @param $machine_id
     */
    public function hostManagerDelete($dbh, $machine_id)
    {
        $query = $dbh->prepare('DELETE FROM manager_host WHERE machine_id = :machine_id ;');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        try {
            $query-> bindParam(':machine_id', $machine_id, PDO::PARAM_STR);
            $query->execute(); //invalid query!
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());
        }
    }

    public function hostActiveList($dbh)
    {
        $query = $dbh->prepare('SELECT * FROM manager_host WHERE active = 1 ;');
        try {
            $query->execute(); //invalid query!
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());

        }
    }

    public function monologList($dbh)
    {
        $query = $dbh->prepare('SELECT * FROM monolog ORDER BY time DESC ;');
        try {
            $query->execute(); //invalid query!
            $data = $query->fetchAll();
            $cnt  = count($data); //in case you need to count all rows
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());

        }
    }

    public function packageActionResult($dbh)
    {
        $query = $dbh->prepare('SELECT * FROM package_result ORDER BY created_at DESC;');
        try {
            $query->execute(); //invalid query!
            $data = $query->fetchAll();
            $cnt  = count($data); //in case you need to count all rows
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());

        }
    }

    public function packageGetResult($dbh)
    {
        $query = $dbh->prepare('SELECT * FROM package_result ORDER BY created_at DESC LIMIT 3;');
        try {
            $query->execute(); //invalid query!
            $data = $query->fetchAll();
            $cnt  = count($data); //in case you need to count all rows
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());

        }
    }

    public function packageCheckNotRead($dbh)
    {
        $query = $dbh->prepare('SELECT COUNT(*) FROM package_result WHERE isRead = 0;');
        try {
            $query->execute(); //invalid query!
            $data = $query->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());

        }
    }
    
    public function packageSetRead($dbh)
    {
        $query = $dbh->prepare('UPDATE package_result SET isRead = 1;');
        try {
            $query->execute(); //invalid query!
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());

        }
    }

    /**
     * @param $dbh
     * @param $user_id
     *
     * @return mixed
     */
    public function hostManagerList($dbh, $user_id)
    {
        $query = $dbh->prepare('SELECT * FROM manager_host WHERE user_id = :user_id ;');
        try {
            $query-> bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->execute(); //invalid query!
            $data = $query->fetchAll();
            $cnt  = count($data); //in case you need to count all rows
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());
        }
    }

    /**
     * @param $dbh
     * @param $machine_id
     * @param $status
     */
    public function hostManagerStatus($dbh, $manager_host_ipaddress, $status)
    {
        $query = $dbh->prepare('UPDATE manager_host SET status_id=:status_id WHERE ipaddress = :ipaddress ;');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        try {
            $query-> bindParam(':ipaddress', $manager_host_ipaddress, PDO::PARAM_STR);
            $query-> bindParam(':status_id', $status, PDO::PARAM_INT);
            $query->execute(); //invalid query!
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());
        }
    }

    /**
     * @param $dbh
     * @param $machine_id
     * @param $status
     */
    public function hostManagerip2id($dbh, $manager_host_ipaddress)
    {
        $query = $dbh->prepare('SELECT * FROM manager_host WHERE ipaddress = :ipaddress ;');
        try {
            $query-> bindParam(':ipaddress', $manager_host_ipaddress, PDO::PARAM_INT);
            $query->execute(); //invalid query!
            $data = $query->fetchAll();
            $cnt  = count($data); //in case you need to count all rows
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());
        }
    }

    /**
     * @param $dbh
     * @param $machine_id
     * @param $status
     */
    public function hostManagerid2ip($dbh, $manager_host_id)
    {
        $query = $dbh->prepare('SELECT * FROM manager_host WHERE machine_id = :machine_id ;');
        try {
            $query-> bindParam(':machine_id', $manager_host_id, PDO::PARAM_INT);
            $query->execute(); //invalid query!
            $data = $query->fetchAll();
            $cnt  = count($data); //in case you need to count all rows
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());
        }
    }

    /**
     * @param $dbh
     * @param $active set to 1 if activated 0 if deactivated
     * @param $machine_id
     */
    public function targetHostActive($dbh, $active, $machine_id)
    {
        $query = $dbh->prepare('UPDATE manager_host SET active=:active WHERE machine_id = :machine_id ;');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        try {
            $query-> bindParam(':machine_id', $machine_id, PDO::PARAM_STR);
            $query-> bindParam(':active', $active, PDO::PARAM_INT);
            $query->execute(); //invalid query!
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());
        }
    }

    /**
     * @param $dbh
     * @param $target_host
     * @param $machine_id
     */
    public function targetHostInf($dbh, $target_host, $machine_id)
    {
        $query = $dbh->prepare('
SELECT * FROM target_host
WHERE ipaddress = :target_host
AND machine_id = :machine_id;');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        try {
            $query-> bindParam(':machine_id', $machine_id, PDO::PARAM_STR);
            $query-> bindParam(':target_host', $target_host, PDO::PARAM_INT);
            $query->execute(); //invalid query!
            $data = $query->fetchAll();
            $cnt  = count($data); //in case you need to count all rows
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());
        }
    }

    /**
     * @param $dbh
     * @param $target_host
     * @param $machine_id
     */
    public function targetHostIdInf($dbh, $targetHostId)
    {
        $query = $dbh->prepare('
SELECT * FROM target_host
WHERE host_id = :host_id');
        # TODO: it have problem finding duplicate NULL value
        # FIX: cutted value if using to short VARCHAR so never matched
        try {
            $query-> bindParam(':host_id', $targetHostId, PDO::PARAM_INT);
            $query->execute(); //invalid query!
            $data = $query->fetchAll();
            $cnt  = count($data); //in case you need to count all rows
            return $data;
        } catch (PDOException $ex) {
            $this->errorHandler($ex->getMessage());
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
    public function installedPackageList($target_host, $dbh)
    {
        $stm = $dbh->prepare("select * from installed_package WHERE target_host=:target_host;");
        $stm-> bindParam(':target_host', $target_host, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    public function PackageList($target_host, $dbh, $start_row, $row_in_table)
    {
        $stm = $dbh->prepare("select * from pack_info WHERE target_host=:target_host LIMIT :start_row, :row_in_table;");
        $stm-> bindParam(':target_host', $target_host, PDO::PARAM_STR);
        $stm-> bindParam(':start_row', $start_row, PDO::PARAM_STR);
        $stm-> bindParam(':row_in_table', $row_in_table, PDO::PARAM_STR);
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
        $stm-> bindParam(':target_host', $target_host, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        return $data;
    }

    public function PackageSearch($target_host, $dbh, $search)
    {
        $search = "%$search%";
        $stm = $dbh->prepare("select * from pack_info WHERE target_host=:target_host AND pack_name LIKE :search ;");
        $stm-> bindParam(':search', $search, PDO::PARAM_STR);
        $stm-> bindParam(':target_host', $target_host, PDO::PARAM_STR);
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
            $this->errorHandler($ex->getMessage());
        }
    }
}
