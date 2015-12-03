<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>パッケージリスト</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="includes/normalize.css">
	<link rel="stylesheet" type="text/css" href="includes/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="sass/style.css">
    <link rel="stylesheet" type="text/css" href="includes/jquery-ui.css"/>
    <style>
        #popup{
            display: none;
            border: 1px solid black;
        }
        .cell-which-triggers-popup{
            cursor: pointer;
        }
        .cell-which-triggers-popup:hover{
            background-color: yellow;
        }
    </style>
</head>
<?php
$title = "Untitled Document";
require_once __DIR__ .'/parts/head.php';
require_once __DIR__ . '/parts/modal.php';
?>
<body>
    <div id="popup" data-name="name" class="dialog">
        <p class="item-1"></p>
        <p class="item-2"></p>
        <p class="item-3"></p>
    </div>
	<div class="wrapper">
	<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper">
			<main class="contents menu-set">
				<div class="section">
					<h2 class="title">パッケージリスト</h2>
						<div class="list-tools clearfix">
                            <div class="list-action">
                                <select name="list-action" class="input-list">
                                    <option value="0">一括操作</option>
                                    <option value="0">更新</option>
                                </select>
                                <input type="submit" value="適用" class="button button--form">
                            </div>
                            <div class="search-box">
                                <form id="form1">
                                    <input type="text" name="field1" id="field1">
                                    <input type="submit" name="submit" id="submit" value="Submit Form">
                                </form>
                            </div>
                        </div>
						<table class="table" name="table" id="resultTable">
							<thead>
								<tr>
									<th class="cbox__selectall">
										<div class="cbox__wrapper">
										<input type="checkbox" id="cbox-selectall"><label for="cbox-selectall"></label>
										</div>
									</th>
									<th>パッケージ名</th>
								</tr>
							</thead>
							<tbody>
                            </tbody>
                        </table>
                </div>
			</main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
