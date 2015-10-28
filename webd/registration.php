<!DOCTYPE html>
<html lang="ja">
<?php
$title = "Untitled Document";
require_once __DIR__ .'/parts/head.php';
?>
	<div class="wrapper">
		<div class="contentwrapper-nonav">
			<main class="contents">
				<div class="inner inner-login">
					<div class="login-header">
						<!-- ここにロゴ画像を挿入 -->
						<span>ユーザー登録</span>
					</div>
					<div class="login">
						<form name="main-form" method="post" action="includes/user_registration.php">
							<label>ユーザー名:</label> <input type="text" name="user_name" placeholder="ローマ字を入れてください"/><br/>
							<label>Eメール:</label> <input type="text" name="mail_address" placeholder="kmx.?x?.@.gmail"/><br/>
							<label>パスワード:</label> <input type="password" name="password_1" placeholder="８桁を入れてください"/><br/>
							<label>パスワード確認:</label> <input type="password" name="password_2" placeholder="もう一度入れてください"/><br/>
							<input type="Submit" value="OK"/>
					    </form>
					</div>
				</div>
			</main>
		</div>
	</div>
</html>
