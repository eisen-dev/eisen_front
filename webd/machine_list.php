<!DOCTYPE html>
<html lang="ja">
<?php
//タイトル
$title = "テンプレート";
require_once __DIR__ .'/parts/head.php';
//require_once __DIR__ . '/connect.php';
//$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<body>
	<div class="wrapper">
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper menu-set">
			<main class="contents">
				<div class="machine-list">
					<div class="machine-list-left">

						<div class="manager-list">
							<div class="manager-list-header">
								<span class="manager-list-title">マネージャホスト</span>
							</div>
							<ul>
								<li>
									<a href="#">マシンA</a>
								</li>
								<li>
									<a href="#">マシンB</a>
								</li>
								<li>
									<a href="#">マシンC</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="machine-list-right">
						<div class="targethost-list">
							<div class="targethost-list-header">
								<span class="targethost-list-title">マシンA</span></div>
							<ul>
								<li>
									<a>サーバーマシン</a>
								</li>
								<li>
									<a>個人マシン</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
