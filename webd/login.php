<!DOCTYPE html>
<html lang="ja">
<?php
require_once __DIR__ .'/parts/head.php';
require_once __DIR__ .'/connect.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>
<body>
	<div class="wrapper">
		<div class="contentwrapper-nonav">
			<main class="contents">
				<div class="inner inner-login">
					<div class="login-header">
						<!-- ここにロゴ画像を挿入 -->
						<span>ログイン</span>
					</div>
					<div class="login">
						<form>
							<span>ユーザーID</span>
							<input type="text" name="userid">
							<span>パスワード</span>
							<input type="password" name="password">
						</form>
						<a href="#" class="button">ログイン</a>
					</div>
				</div>
			</main>
		</div>
	</div>
	<script type="text/javascript" src="js/script.js"></script>
</body>

</html>
