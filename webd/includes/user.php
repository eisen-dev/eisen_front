<?php
require_once __DIR__ .'/../connect.php';

$user_name = trim($_POST['user_name']);
$password = trim(sha1($_POST['password']));

//データベースに接続するために必要な情報(PDO)
$dsn = "mysql:dbname=$db_name;host=$db_host;charset=utf8";

//データベース接続
try {
$dbh = new PDO($dsn, $db_user, $db_pass,
array(PDO::ATTR_EMULATE_PREPARES => false,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
 exit('データベース接続に失敗しました'.$e->getMessage());
}

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$query = $dbh->prepare("SELECT * FROM user_info WHERE user_name = ? AND password = ? ");
$query->bindParam(1, $user_name);
$query->bindParam(2, $password);
$query->execute();
if ($query->rowCount() > 0){
	print_r($user_name.'<br>');
	print_r($password.'<br>');
	//header('location:/index.html');
} else{
	echo 'Error login.';
}
?>