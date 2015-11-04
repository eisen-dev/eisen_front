<?php echo '<p>Hello World</p>';
require_once __DIR__ . '/includes/DbAction.php';

$dba = new DbAction();
$dbh = $dba->Connect();

$dba->CreateDbTable(
		'user_info', 
		array(
        'unique_id' => 'INT AUTO_INCREMENT',
        'user_id' => 'VARCHAR(75)',
        'password' => 'VARCHAR(40)',
		'mail_address' => 'VARCHAR(60)',
		),$dbh);

$dba->CreateDbTable(
		'machine_information',
		array(
		'machine_id' => 'INT AUTO_INCREMENT',
		'machine_name'=> 'VARCHAR(20)',
		'ipaddress' => 'VARCHAR(20)',
		'port' => 'VARCHAR(60)',
		'os' => 'VARCHAR(60)',
		'status_id' => 'VARCHAR(60)',
        'user_id' => 'VARCHAR(75)'
		),$dbh);

$dba->CreateDbTable(
		'pack_management_system',
		array(
		'pack_sys_id' => 'INT AUTO_INCREMENT',
		'pack_sys_name'=> 'VARCHAR(20)',
		'pack_sys_version' => 'VARCHAR(20)',
		'all_sys_pack_hash' => 'VARCHAR(60)',
		'installed_sys_pack_hash' => 'VARCHAR(60)',
        'machine_id'=> 'INT NOT NULL'
		),$dbh);

$dba->CreateDbTable(
		'installed_package',
		array(
		'installed_pack_id' => 'INT AUTO_INCREMENT',
		'installed_pack_category'=> 'VARCHAR(20)',
		'installed_pack_name' => 'VARCHAR(20)',
		'installed_pack_version' => 'VARCHAR(60)',
		'installed_pack_summary' => 'VARCHAR(60)',
		'pack_sys_id' => 'INT NOT NULL'
		),$dbh);

$dba->CreateDbTable(
		'pack_info',
		array(
		'pack_id' => 'INT AUTO_INCREMENT',
		'pack_category'=> 'VARCHAR(20)',
		'pack_name' => 'VARCHAR(20)',
		'pack_version' => 'VARCHAR(60)',
		'pack_summary' => 'VARCHAR(60)',
        'pack_sys_id' => 'INT NOT NULL'
		),$dbh);

$dba->CreateDbTable(
		'status',
		array(
		'status_id' => 'INT AUTO_INCREMENT',
		'status_info'=> 'VARCHAR(20)',
		),$dbh);
