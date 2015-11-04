<?php
$user_id=$_SESSION['login_user'];
print 'user name: '.$user_id;
$stm = $dbh->prepare("select * from machine_information WHERE user_id = :user_id ;");
$stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
$stm->execute();
$data = $stm->fetchAll();
$cnt  = count($data); //in case you need to count all rows
foreach ($data as $i => $row)
    $ipaddress = $row['ipaddress'];
    $port = $row['port'];
    print ('ip: '.$ipaddress.'<br>port: '.$port);