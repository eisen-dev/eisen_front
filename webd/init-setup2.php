<?php
//issetでpostを全部チェックした方がいい
if(isset($_POST['submit'])){
	if (!empty($_POST["db_host"])) {
		$db_host = htmlspecialchars($_POST["db_host"]);
	}
	if (!empty($_POST["db_user"])) {
		$db_user = htmlspecialchars($_POST["db_user"]);
	}
	if (!empty($_POST["db_pass"])) {
		$db_pass = htmlspecialchars($_POST["db_pass"]);
	}
	if (!empty($_POST["db_name"])) {
		$db_name = htmlspecialchars($_POST["db_name"]);
	}
    //Write file.
	if(!empty($db_host)) {
        $content = '<?php' . "\n";
        $content = $content . '  $db_host = "' . $_POST['db_host'] . '";' . "\n";
        $content = $content . '  $db_name = "' . $_POST['db_name'] . '";' . "\n";
        $content = $content . '  $db_user = "' . $_POST['db_user'] . '";' . "\n";
        $content = $content . '  $db_pass = "' . $_POST['db_pass'] . '";' . "\n";
        $content = $content . '?>';

        //ファイルへの書き込み
        $file = 'connect.php';
        file_put_contents($file, $content);
    }
    require_once __DIR__ . '/connect.php';
    require_once __DIR__ . '/includes/DbAction.php';
    $dba = new DbAction();
    $dba->Check();
    $dbh = $dba->Connect();
	$dba->TableCreation($dbh);
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
				<div class="card">
					<form action="includes/user_registration.php" method="post">
						<h2 class="title">ユーザー設定</h2>
						<div class="compact-form">
							<div class="compact-form-row">
								<div class="compact-form-item-left">
									<span>ユーザー名</span>
								</div>
								<div class="compact-form-item-right">
									<input type="text" name="user_name">
								</div>
							</div>
							<div class="compact-form-row">
								<div class="compact-form-item-left">
									<span>メールアドレス</span>
								</div>
								<div class="compact-form-item-right">
									<input type="text" name="mail_address">
								</div>
							</div>
							<div class="compact-form-row">
								<div class="compact-form-item-left">
									<span>パスワード</span>
								</div>
								<div class="compact-form-item-right">
									<input type="password" name="password_1">
								</div>
							</div>
							<div class="compact-form-row">
								<div class="compact-form-item-left">
									<span>パスワード(確認)</span>
								</div>
								<div class="compact-form-item-right">
									<input type="password" name="password_2">
								</div>
							</div>
						</div>
						<input type="submit" name="submit" value="設定して次に進む" class="button">
					</form>
				</div>
			</main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>

</html>
