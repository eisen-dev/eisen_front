﻿<?php
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
<head>
	<meta charset="UTF-8">
	<title>ユーザー設定</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="includes/normalize.css">
	<link rel="stylesheet" href="includes/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="includes/bootstrap-custom/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="sass/style.css">
	<script type="text/javascript" src="includes/jquery/jquery-2.1.4.min.js"></script>
</head>

<body>
	<div class="wrapper">
		<div class="contentwrapper-nonav">
			<main class="contents">
					<h1 class="title-c">初期設定</h1>
					<div class="setup-step">
						<div class="setup-step-container">
							<div class="setup-step-item">
								<div class="step-disp"><span class="step-disp-text">1</span></div>
								<span class="setup-desc">接続設定</span>
							</div>
							<div class="setup-step-item">
								<div class="step-disp setup-disp-current"><span class="step-disp-text">2</span></div>
								<span class="setup-desc">ユーザー設定</span>
							</div>
							<div class="setup-step-item">
								<div class="step-disp"><span class="step-disp-text">3</span></div>
								<span class="setup-desc">完了</span>
							</div>
						</div>
					</div>
					<div class="setting">
						<form action="init-setup3.php" method="post">
							<h2 class="title">ユーザー設定</h2>
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
									<span>メールアドレス</span>
								</div>
								<div class="setting-item-right">
									<input type="text" name="db_pass">
								</div>
							</div>
							<div class="setting-container">
								<div class="setting-item-left">
									<span>パスワード</span>
								</div>
								<div class="setting-item-right">
									<input type="password" name="db_name">
								</div>
							</div>
							<div class="setting-container">
								<div class="setting-item-left">
									<span>パスワード(確認)</span>
								</div>
								<div class="setting-item-right">
									<input type="password" name="db_name">
								</div>
							</div>
							<input type="submit" name="submit" value="設定して次に進む" class="button">
						</form>
					</div>
			</main>
		</div>
	</div>
    <script src="../../../../Users/IT%20College/Google%20ドライブ/卒業制作/10_27%20プレゼンテーション/発表用デザイン見本/includes/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../../../Users/IT%20College/Google%20ドライブ/卒業制作/10_27%20プレゼンテーション/発表用デザイン見本/js/script.js"></script>
</body>

</html>