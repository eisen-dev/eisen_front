<!DOCTYPE html>
<html lang="ja">
<?php 
$title = "index page";
require_once __DIR__ .'/parts/head.php';
?>
<body>
	<div class="wrapper">
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper">
			<main class="contents  menu-set">
				<div class="section">
					<h1>Welcome in Eisen</h1>
                    <p>
                    <a href="dbcreation.php">db create</a>
                    </p>
					<p>
					<a href="init-setup1.php">install database</a>
					</p>
                    <p>
                    <a href="machine_list.php">add machine</a>
                    </p>
					<p>
					<a href="dbupdate-install.php">update database</a>
					</p>
					<p>
					<a href="list.php">show list</a>
					</p>
                    <!-- TODO グラフを追加 -->
                </div>
			</main>
		</div>
	</div>
    <script src="includes/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>

</html>
