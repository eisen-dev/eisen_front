<?php
require_once __DIR__ .'/../connect.php';
require_once __DIR__ . '/DbAction.php';

$user_name = trim($_POST['user_name']);
$mail_address = trim($_POST['mail_address']);
$password_1 = trim(sha1($_POST['password_1']));
$password_2 = trim(sha1($_POST['password_2']));
print($user_name.'<br>');

$dba = new DbAction();
$dbh = $dba->Connect();

function isValidEmail($value)
{
	if (!preg_match('~^[a-z0-9-!#\$%&\'*+/=?^_`{|}\~]+(?:[.][a-z0-9-!#\$%&\'*+/=?^_`{|}\~]+)*@(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?[.])+[a-z]{2,6}$~iu', (string) $value)) {
		return false;
	}
	return true;
}

if (isValidEmail($mail_address)){
	if ($password_1 == $password_2){
        #TODO check password length
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$query = $dbh->prepare("select * from user_info where user_id = ? ;");
		$query->bindParam(1, $user_name);
		$query->execute();
		print($query->rowCount());
		if ($query->rowCount() == 0){
			print_r($user_name.'<br>');
			print_r($password_1.'<br>');
			header('location:../init-setup3.php');
			
			//データベースに接続するために必要な情報(PDO)
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$query = $dbh->prepare("INSERT INTO user_info (user_id, password, mail_address) VALUES(?,?,?);");
			$query->bindParam(1, $user_name);
			$query->bindParam(2, $password_1);
			$query->bindParam(3, $mail_address);
			$query->execute();
		}
		else{
			echo 'User already registered.<br>';
		}
	}
	else{
		print("password dosen't match<br>");
	}
}
else{
	print('email is invalid<br>');
}