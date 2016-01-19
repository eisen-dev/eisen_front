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
        $dba = new DbAction();
        $dbh = $dba->Connect();
        $machine = $dba->hostManagerActiveList($user_id, $dbh);
        foreach ($machine as $i => $manager_host) {
                l($manager_host);
                $rest = new restclient();
                $hosts = $rest->updatePackage(
                    $manager_host['ipaddress'],
                    $manager_host['port'],
                    $manager_host['username'],
                    $manager_host['password']
                );
        }
        return json_encode($user_id);
    }
}

$package_update = new PackageUpdate();
echo $package_update->updatePackage();
