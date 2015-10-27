<?php
require_once __DIR__ .'/../connect.php';

$user_name = trim($_POST['user_name']);
$mail_address = trim($_POST['mail_address']);
$password_1 = trim(sha1($_POST['password_1']));
$password_2 = trim(sha1($_POST['password_2']));
print($user_name);
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
if ($password_1 == $password_2){
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$query = $dbh->prepare("select * from user_info where user_name = ? ;");
	$query->bindParam(1, $user_name);
	$query->execute();
	print($query->rowCount());
	if ($query->rowCount() == 0){
		print_r($user_name.'<br>');
		print_r($password_1.'<br>');
		//header('location:/index.html');
		
		//�f�[�^�x�[�X�ɐڑ����邽�߂ɕK�v�ȏ��(PDO)
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$query = $dbh->prepare("INSERT INTO user_info (user_name, password, mail_address) VALUES(?,?,?);");
		$query->bindParam(1, $user_name);
		$query->bindParam(2, $password_1);
		$query->bindParam(3, $mail_address);
		$query->execute();
	}
	else{
		echo 'User already registered.';
	}
}
else{
	print("password dosen't match");
}
?>