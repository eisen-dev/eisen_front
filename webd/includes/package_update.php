<?php
    require_once __DIR__ . '/DbAction.php';
    require_once __DIR__."/restclient.php";


    /**
 * Test
 * @return string
 */
class PackageUpdate
{
    /**
     * Test
     * @return string
     */
    public function UpdatePackage()
    {
        $user_id = @$_POST['user_id'];
        $dba = new DbAction();
        $dbh = $dba->Connect();
        $machine = $dba->MachineList($user_id,$dbh);
        $rest = new restclient();
        //$hosts = $rest->update_package($ipaddress, $port, $username, $password);
        //return json_encode($user_id);
    }
}

$package_update = new PackageUpdate();
echo $package_update->UpdatePackage();