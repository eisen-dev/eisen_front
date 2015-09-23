<!DOCTYPE html>
<html lang="ja">
<?php
require_once __DIR__ .'/parts/head.php';
require_once __DIR__ .'/connect.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
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
						<form>
							<span>ホスト名</span>
							<input type="text" name="hostname">
							<span>ユーザー名</span>
							<input type="text" name="userid">
							<span>パスワード</span>
							<input type="password" name="password">
							<span>データベース名</span>
							<input type="password" name="dbname">
						</form>
						<a href="#" class="button">設定する</a>
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
