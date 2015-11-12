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
					<p>---ajaxとモーダルウィンドウのサンプル---</p>
					<div class="button button-il action" id="apache" data-modal="open">apache</div>
					<div class="button button-il action" id="mysql" data-modal="open">mysql</div>
					<span class="domarea" id="sample1"></span>
					<!--
					<p>---モーダルサンプル---</p>
					<div class="button" data-modal="open">モーダルを開く</div>
					-->
				</div>
			</main>
		</div>
	</div>
	<div class="modal" id="modal">
		<div class="modal-wrapper">
			<div class="modal-window">
				<div class="modal-header">
				<i class="fa fa-times modal-close" data-modal="close"></i>
				<span class="modal-title">ここに処理結果を表示</span>
				</div>
				<div class="modal-contents"><p>これはモーダルウィンドウのサンプルです。</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>
				<div class="modal-ctrl"></div>
			</div>
		</div>
		<div class="modal-overlay"  data-modal="close"></div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
	<script>
		$(".action").click (function () {

			$.ajax({
				url: 'ajaxtest2.php',
				type: 'post',
				dataType: 'json',
				data: {
					pack_id: $(this).attr("id"),
				}
			})
			// ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
			//通信に成功したとき
			.done(function (response) {
				$('.modal-header > .modal-title').text(response.return);
			})
			// ・サーバからステータスコード400以上が返ってきたとき
			// ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
			// ・通信に失敗したとき
			.fail(function () {
				alert("失敗しました");
			});
		});
	</script>
</body>
</html>
