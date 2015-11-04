<?php
//isset��post��S���`�F�b�N������������
if(isset($_POST['submit'])){
    $js_host = htmlspecialchars($_POST["js_host"]);
    $js_port = htmlspecialchars($_POST["js_port"]);
}
require_once "../connect.php";

function some_logging_function($log){
    echo 'LOG : ' . $log . '<br />';
}
//�f�[�^�x�[�X�ɐڑ����邽�߂ɕK�v�ȏ��(PDO)
$dsn = "mysql:dbname=$db_name;host=$db_host;charset=utf8";

//�f�[�^�x�[�X�ڑ�
try {
    $dbh = new PDO($dsn, $db_user, $db_pass,
        array(PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    exit('�f�[�^�x�[�X�ڑ��Ɏ��s���܂���'.$e->getMessage());
}
print('jason rpc address= '.$js_host.'<br>json rpc port= '.$js_port);
$machine_name='test';
$os='Gentoo';
$status_id=1;
$user_id='test';
try {
    $query = $dbh->prepare('INSERT INTO machine_information (machine_name, ipaddress, port, os, status_id, user_id) VALUES (:machine_name, :ipaddress, :port, :os, :status_id, :user_id);');
    $query-> bindParam(':machine_name', $machine_name, PDO::PARAM_STR);
    $query-> bindParam(':ipaddress', $js_host, PDO::PARAM_STR);
    $query-> bindParam(':port', $js_port, PDO::PARAM_STR);
    $query-> bindParam(':os', $os, PDO::PARAM_STR);
    $query-> bindParam(':status_id', $status_id, PDO::PARAM_INT);
    $query-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
    echo var_dump($query);
    $query->execute(); //invalid query!
} catch(PDOException $ex) {
    //echo "An Error occured!"; //user friendly message
    some_logging_function($ex->getMessage());
}