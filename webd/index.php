<!DOCTYPE html>
<html lang="ja">
<?php 
$title = "index page";
require_once __DIR__ .'/parts/head.php';
require_once __DIR__ .'/connect.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>
<body>
	<div class="wrapper">
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper">
			<main class="contents  menu-set">
				<div class="section">
					<h1>Hello</h1> Untitled Document!
					<p>
					<a href="/install.php">install database</a>
					</p>
					<p>
					<a href="/dbupdate.php">update database</a>
					</p>
					<p>
					<a href="/list.php">show list</a>
					</p>
					<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
						Basic Modals
					</button>
					<!-- <?php require_once __DIR__ . '/parts/modal.php'; ?> -->
					<!-- モーダルウィンドウここから -->
					<div id="myModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">タイトル</h4>
								</div>
								<div class="modal-body">
									モーダルのbody部分
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
									<button type="button" class="btn btn-primary">保存</button>
								</div>
							</div>
						</div>
					</div>
					<!-- モーダルウィンドウここまで -->
				</div>
			</main>
		</div>
	</div>
    <script src="includes/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>

</html>
