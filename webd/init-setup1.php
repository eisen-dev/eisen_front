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
	//ファイル書き込み後ユーザー設定ページに遷移
	//header('Location:./registration.php') ;
}
?>

<!DOCTYPE html>
<html lang="ja">
<?php
$title = "初期設定";
require_once __DIR__ .'/parts/head.php';
/*require_once __DIR__ .'/connect.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);*/
?>

<body>
	<div class="wrapper">
<!--<?php require_once __DIR__ .'/parts/navigation.php'; ?>-->
		<div class="contentwrapper-nonav">
			<main class="contents">
				<div class="section">
					<h1 class="title-c">初期設定</h1>
					<div class="setup-step">
						<div class="setup-step-container">
							<div class="setup-step-item">
								<div class="step-disp setup-disp-current"><span class="step-disp-text">1</span></div>
								<span class="setup-desc">接続設定</span>
							</div>
							<div class="setup-step-item">
								<div class="step-disp"><span class="step-disp-text">2</span></div>
								<span class="setup-desc">ユーザー設定</span>
							</div>
							<div class="setup-step-item">
								<div class="step-disp"><span class="step-disp-text">3</span></div>
								<span class="setup-desc">完了</span>
							</div>
						</div>
					</div>
					<form action="init-setup.php" method="post">
						<div class="setting">
							<h2 class="title">データベース設定</h2>
							<div class="setting-container">
								<div class="setting-item-left">
									<span>ホスト名</span>
								</div>
								<div class="setting-item-right">
									<input type="text" name="db_host">
								</div>
							</div>
							<div class="setting-container">
								<div class="setting-item-left">
									<span>ユーザー名</span>
								</div>
								<div class="setting-item-right">
									<input type="text" name="db_user">
								</div>
							</div>
							<div class="setting-container">
								<div class="setting-item-left">
									<span>パスワード</span>
								</div>
								<div class="setting-item-right">
									<input type="password" name="db_pass">
								</div>
							</div>
							<div class="setting-container">
								<div class="setting-item-left">
									<span>データベース名</span>
								</div>
								<div class="setting-item-right">
									<input type="text" name="db_name">
								</div>
							</div>

								<h2 class="title">json RPC設定</h2>
							<div class="setting-container">
								<div class="setting-item-left">
									<span>ホスト名</span>
								</div>
								<div class="setting-item-right">
									<input type="text" name="js_host">
								</div>
							</div>
							<div class="setting-container">
								<div class="setting-item-left">
									<span>ポート番号</span>
								</div>
								<div class="setting-item-right">
									<input type="text" name="js_port">
								</div>
							</div>
							<input type="submit" name="submit" value="設定して次に進む" class="button">
						</div>
					</form>
			</main>
		</div>
	</div>
    <script src="includes/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>

</html>
