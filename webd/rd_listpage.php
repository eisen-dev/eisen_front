<!DOCTYPE html>
<html lang="ja">
<head>
<?php
// タイトル
$title = "テンプレート";
require_once __DIR__ .'/parts/head.php';
?>
</head>
<?php
require_once __DIR__ . '/connect.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<body>
	<div class="wrapper">
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper menu-set">
			<main class="contents">
                <!-- content header start-->
                <div class="content-header">
                    <!-- page title -->
                    <h2 class="title content-header-title">リスト</h2>
                    <!-- page general setting button and useful buttons area -->
                    <div class="content-header-buttons">
                        <div class="content-header-button">
                            <!-- header button area, example for add new machine button. -->
                            <button class="btn btn-sm"><i class="fa fa-plus"></i>新規マシン追加</button>
                        </div>
                         <!-- setting button, open setting modal. this is optional button. -->
                        <button class="content-header-setting"><i class="fa fa-cog"></i></button>
                    </div>
                </div>
                <!-- content header end-->
                <div class="n-list-tools">
                    <!-- new list control tools -->
					<form id="example-form">
						<div class="n-list-toolbar">
							<div class="n-list-action">
                                <!-- dropdown list and submit button.-->
								<select name="list-action" class="n-input-list">
									<option value="0">一括操作</option>
									<option value="0">更新</option>
								</select>
								<button class="btn btn-sm">実行</button>
                                <!-- additional control button is here,use button tag -->
                                <button class="btn btn-sm"><i class="fa fa-refresh"></i>リストを更新</button>
							</div>
							<div class="n-searchbox">
								<input type="text" class="n-search-box-input">
                                <!-- search button -->
								<button type="submit" class="n-search-button"><i class="fa fa-search"></i></button>
                                <!-- optional filter button -->
								<button type="button" class="n-filter-button"><i class="fa fa-filter"></i></button>
							</div>
						</div>
                        <!-- optional filter area -->
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
                        <!-- optional filter area end -->
                    </form>
					<!--  new list control tools end-->
                </div>

                <div class="table-wrapper table-fullwindow">
                    <!-- insert <table></table>tag here -->
                    <!-- example table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>thead</th>
                            <th>thead</th>
                            <th>thead</th>
                            <th>thead</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>tdata</td>
                                <td>tdata</td>
                                <td>tdata</td>
                                <td>tdata</td>
                            </tr>
                            <tr>
                                <td>tdata</td>
                                <td>tdata</td>
                                <td>tdata</td>
                                <td>tdata</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- example table end -->
                </div>
            </main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
