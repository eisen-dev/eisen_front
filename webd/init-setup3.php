<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>設定完了</title>
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
								<div class="step-disp"><span class="step-disp-text">2</span></div>
								<span class="setup-desc">ユーザー設定</span>
							</div>
							<div class="setup-step-item">
								<div class="step-disp setup-disp-current"><span class="step-disp-text">3</span></div>
								<span class="setup-desc">完了</span>
							</div>
						</div>
					</div>
					<div class="card">
						<form action="login.php" method="post">
								<p>すべての初期設定が完了しました！</p>
							<input type="submit" name="submit" value="ログインに進む" class="button">
						</form>
					</div>
			</main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>

</html>
