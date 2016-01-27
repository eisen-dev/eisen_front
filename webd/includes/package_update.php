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
    public function updatePackage()
    {
        $user_id = @$_POST['user_id'];
        $target_ipaddress = @$_POST['target_ipaddress'];
        $target_os = @$_POST['target_os'];
        $manager_id = @$_POST['machine_id'];
        $command = 'all';
        $dba = new DbAction();
        $dbh = $dba->Connect();
        //ld($user_id);
        $manager = $dba->hostManagerid2ip($dbh, $manager_id);
        $rest = new restclient();
        $rest->updatePackage(
            $manager[0]['ipaddress'],
            $manager[0]['port'],
            $manager[0]['username'],
            $manager[0]['password'],
            $target_ipaddress,
            $target_os,
            $command
        );
        return json_encode($user_id);
    }
}

$package_update = new PackageUpdate();
echo $package_update->updatePackage();
