<!DOCTYPE html>
<html lang="ja">
<?php
require_once __DIR__ .'/parts/head.php';
//require_once __DIR__ .'/connect.php';
//$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>
<body>
	<div class="wrapper">
<?php require_once __DIR__ . '/parts/navigation.php'; ?>
		<div class="contentswrapper">
			<main class="contents">
				<div class="section">
					<div class="inner inner-section">
						<div class="login-header">
							<!-- ここにロゴ画像を挿入 -->
							<span>データベース設定</span>
						</div>
						<div class="login">
<?php
//issetでpostを全部チェックした方がいい
if(isset($_POST['submit'])){
	$host = htmlspecialchars($_POST["host"]);
	$user = htmlspecialchars($_POST["user"]);
	$pass = htmlspecialchars($_POST["pass"]);
	$dbname = htmlspecialchars($_POST["dbname"]);
	$connect_str = "<?php\r\n"."\$db_host = "."\"$host\";"."\r\n"."\$db_user = "."\"$user\";"."\r\n"."\$db_pass = "."\"$pass\";"."\r\n"."\$db_name = "."\"$dbname\";"."\r\n";
	//ファイルへの書き込み
	$file = 'connect.php';
	file_put_contents($file, $connect_str);
	}else{
}
?>
							<form action="dbinstall.php" method="post">
								<span>ホスト名</span>
								<input type="text" name="host">
								<span>ユーザー名</span>
								<input type="text" name="user">
								<span>パスワード</span>
								<input type="password" name="pass">
								<span>データベース名</span>
								<input type="text" name="dbname">
								<input type="submit" name="submit" value="設定" class="button">
							</form>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
    <script src="includes/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>

</html>
