<!DOCTYPE html>
<!-- デザイン開発・テスト用ファイル -->
<html lang="ja">
<?php
//タイトル
$title = "テンプレート";
require_once __DIR__ .'/parts/head.php';
require_once __DIR__ . '/connect.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<body>
	<div class="wrapper">
		<!-- navigation here -->
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<!-- navigation end -->
		<div class="contentswrapper menu-set">
			<main class="contents">
				<div class="section">
					<h2>テンプレート</h2>
					<p>---ajaxとモーダルウィンドウのサンプル---</p>
					<div class="button" id="apache" data-modal="open" data-modal-target="test-modal"　data-modal-type="test">apache</div>
					<div class="button" id="mysql" data-modal="open" data-modal-target="test-modal"　data-modal-type="test">mysql</div>
					<div class="button" id="mysql" data-modal="open" data-modal-target="alert"　data-modal-type="test">mysql</div>
					<p>tesu</p>

					<p>ぼたんです<span class="button button-il">園あAq</span></p>
					<span class="domarea" id="sample1"></span>
					<!--
					<p>---モーダルサンプル---</p>
					<div class="button" data-modal="open">モーダルを開く</div>
					-->

<!--				修正予定
					<div class="list-tools clearfix">
						<div class="list-action">
							<select name="list-action" class="input-list">
								<option value="0">一括操作</option>
								<option value="0">更新</option>
							</select>
							<input type="submit" value="適用" class="button button--form">
						</div>
						<div class="search-box">
							<input type="text" placeholder="全てのパッケージを検索">
							<button type="submit" name="submit" class="search-box__button">
								<i class="fa fa-search"></i>
							</button>
						</div>
					</div>
					-->

					<!-- new list control tools -->
					<form id="example-form">
						<div class="n-list-tools">
							<div class="n-list-action">
								<select name="list-action" class="n-input-list">
									<option value="0">一括操作</option>
									<option value="0">更新</option>
								</select>
								<div class="n-list-action-button">確認</div>
							</div>
							<div class="n-searchbox">
								<input type="text" class="n-search-box-input">
								<button type="submit" class="n-search-button"><i class="fa fa-search"></i></button>
								<div class="n-filter-button"><i class="fa fa-filter"></i></div>
							</div>
						</div>
					</form>

					<div class="list-filter">
						<div class="list-filter-group">
							<div class="list-group-title">フィルター</div>
							<div class="list-filter-item">
								<span class="list-filter-title">インストール状況</span>
								<select name="install-status" class="n-input-list">
									<option value="0">すべて</option>
									<option value="0">未インストール</option>
									<option value="0">インストール済み</option>
								</select>
							</div>
							<div class="list-filter-item">
								<span class="list-filter-title">カテゴリ検索</span>
								<input type="text">
							</div>
							<div class="list-filter-item">
								<span class="list-filter-title">チェックボックス</span>
								<input type="checkbox" id="list-filter-example-checkbox-1">
								<label for="list-filter-example-checkbox-1">
									<div class="select"></div>
									オプション
								</label>
							</div>
						</div>
						<div class="list-filter-group">
							<div class="list-group-title">検索オプション</div>
						<div class="list-filter-item">
								<span class="list-filter-title">正規表現</span>
								<input type="checkbox" id="list-filter-example-checkbox-2">
								<label for="list-filter-example-checkbox-2">
									<div class="select"></div>
									使用する
								</label>
								<span class="list-filter-comment">サンプルです</span>
							</div>
						</div>
					</div>

					<!--  new list control tools end-->

					<div class="table-wrapper">
					<table class="table">
						<thead>
						<tr>
							<th class="list-data-ctrl">
								<div class="list-data-cbox">
									<input type="checkbox" id="cbox-1">
									<label for="cbox-1">
									<div class="select"></div>
								</label>
								</div>
							</th>

							<th>test</th>
							<th>test</th>
							<th>test</th>
							<th>test</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="list-data-ctrl">
									<div class="list-data-cbox">
										<input type="checkbox" id="cbox-1">
										<label for="cbox-1">
											<div class="select"></div>
										</label>
									</div>
									<div class="list-data-option">
										<div class="list-data-option-icon">
											<i class="fa fa-caret-down"></i>
										</div>
										<div class="dropdown-menu">
											<ul>
												<li><a>action1</a></li>
												<li><a>action2</a></li>
												<li><a>action3</a></li>
											</ul>
										</div>
									</div>
								</td>
								<td>1</td>
								<td>192.168.11.1</td>
								<td>testtesttest</td>
								<td>longlonglonglongtexttexttexttextlonglonglonglongtexttexttexttext</td>
							</tr>
							<tr>
								<td class="list-data-ctrl">
									<div class="list-data-cbox">
										<input type="checkbox" id="cbox-1">
										<label for="cbox-1">
											<div class="select"></div>
										</label>
									</div>
									<div class="list-data-option">
										<div class="list-data-option-icon">
											<i class="fa fa-caret-down"></i>
										</div>
										<div class="dropdown-menu">
											<ul>
												<li><a>action1</a></li>
												<li><a>action2</a></li>
												<li><a>action3</a></li>
											</ul>
										</div>
									</div>
								</td>
								<td>1</td>
								<td>192.168.11.1</td>
								<td>testtesttest</td>
								<td>longlonglonglongtexttexttexttextlonglonglonglongtexttexttexttext</td>
							</tr>
						</tbody>

					</table>
					</div>

					<div class="settings">
						<div class="setting-row">
							<div class="setting-left">
								<span class="setting-title">テキストボックス</span>
							</div>
							<div class="setting-right">
								<input type="text" id="textbox">
							</div>
						</div>
						<div class="setting-row">
							<div class="setting-left">
								<span class="setting-title">チェックボックス</span>
							</div>
							<div class="setting-right">
								<input type="checkbox" id="cbox1">
								<label for="cbox1">
									<div class="select"></div>
									チェックボックスにチェックをいれる
								</label>
							</div>
						</div>
						<div class="setting-row">
							<div class="setting-left">
								<span class="setting-title">トグルスイッチ</span>
							</div>
							<div class="setting-right">
								<input type="checkbox" class="cbox_switch" id="switch1">
								<label for="switch1">
									<div class="select"></div>
									スイッチをオンにする
								</label>
							</div>
						</div>

						<div class="setting-row">
							<div class="setting-left">
								<span class="setting-title">ラジオボタン</span>
							</div>
							<div class="setting-right">
								<input type="radio" name="rad" id="rad3"><label for="rad3">
									<div class="select"></div>
								する</label>
								<input type="radio" name="rad" id="rad4"><label for="rad4">
									<div class="select"></div>
								しない</label>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>

	<div class="modal" id="test-modal">
		<div class="modal-wrapper">
			<div class="modal-window">
				<div class="modal-header">
				<i class="fa fa-times modal-close" data-modal="close"></i>
				<span class="modal-title">ここに処理結果を表示</span>
				</div>
				<div class="modal-contents">
					<p>これはモーダルウィンドウのサンプルです。</p>
				</div>
				<div class="modal-ctrl"></div>
			</div>
		</div>
		<div class="modal-overlay"  data-modal="close"></div>
	</div>
	<div class="modal" id="alert">
		<div class="modal-wrapper">
			<div class="modal-window">
				<div class="modal-header">
				<i class="fa fa-times modal-close" data-modal="close"></i>
				<span class="modal-title">このXXを削除しますか？</span>
				</div>
				<div class="modal-contents">
					<p>これはモーダルウィンドウのサンプルです。</p>
				</div>
				<div class="modal-ctrl"><div class="button">はい</div><div class="button">いいえ</div></div>
			</div>
		</div>
		<div class="modal-overlay"  data-modal="close"></div>
	</div>


<?php require_once __DIR__ .'/parts/scripts.php'; ?>
	<script>
		$('[data-modal-type="test"]').click (function () {
			$.ajax({
				url: 'ajaxtest2.php',
				type: 'post',
				dataType: 'json',
				data: {
					pack_id: $(this).attr("id"),
				}
			})
			.done(function (response) {
				$('.modal-header > .modal-title').text(response.return);
			})
			.fail(function () {
				alert("失敗しました");
			});
		});
	</script>
</body>
</html>
