<!DOCTYPE html>
<html lang="ja">
<?php
//タイトル
$title = "テンプレート";
require_once __DIR__ .'/parts/head.php';
require_once __DIR__ .'/connect.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<body>
	<div class="wrapper">
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper">
			<main class="contents menu-set">
				<div class="section">
					<h2>テンプレート</h2>
				</div>
			</main>
		</div>
	</div>
    <script src="includes/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
