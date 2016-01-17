<!DOCTYPE html>
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
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper menu-set">
			<main class="contents">
                <div class="content-header">
                    <h2 class="title content-header-title">リスト</h2>
                </div>
                <div class="n-list-tools">
                    <!-- new list control tools -->
					<form id="example-form">
						<div class="n-list-toolbar">
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
								<button type="button" class="n-filter-button"><i class="fa fa-filter"></i></button>
							</div>
						</div>
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
                    </form>
					<!--  new list control tools end-->
                </div>

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
            </main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
