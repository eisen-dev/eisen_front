<!DOCTYPE html>
<html lang="ja">
<?php
$title = "Untitled Document";
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
							<span>データベースとJson-RPC設定</span>
						</div>
						<div class="login">
<?php
//issetでpostを全部チェックした方がいい
if(isset($_POST['submit'])){
	$db_host = htmlspecialchars($_POST["db_host"]);
	$db_user = htmlspecialchars($_POST["db_user"]);
	$db_pass = htmlspecialchars($_POST["db_pass"]);
	$db_name = htmlspecialchars($_POST["db_name"]);
	$js_host = htmlspecialchars($_POST["js_host"]);
	$js_port = htmlspecialchars($_POST["js_port"]);
    //Write file.
    $content = '<?php'."\n";
    $content = $content.'  $db_host = "'.$_POST['db_host'].'";'."\n";
    $content = $content.'  $db_name = "'.$_POST['db_name'].'";'."\n";
    $content = $content.'  $db_user = "'.$_POST['db_user'].'";'."\n";
    $content = $content.'  $db_pass = "'.$_POST['db_pass'].'";'."\n";
    $content = $content.'  $js_host = "'.$_POST['js_host'].'";'."\n";
    $content = $content.'  $js_port = "'.$_POST['js_port'].'";'."\n";
    $content = $content.'?>';
	//ファイルへの書き込み
	$file = 'connect.php';
	file_put_contents($file, $content);
	}else{
}
?>
							<form action="dbinstall.php" method="post">
								<span>ホスト名</span>
								<input type="text" name="db_host">
								<span>ユーザー名</span>
								<input type="text" name="db_user">
								<span>パスワード</span>
								<input type="password" name="db_pass">
								<span>データベース名</span>
								<input type="text" name="db_name">
								<span>Json-RPC ホスト</span>
								<input type="text" name="js_host">
								<span>Json ポート</span>
								<input type="text" name="js_port">
								<input type="submit" name="submit" value="設定" class="button">
							</form>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>

</html>
