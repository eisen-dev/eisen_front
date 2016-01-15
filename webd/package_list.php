<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>パッケージリスト</title>
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="includes/normalize.css">
    <link rel="stylesheet" type="text/css"
          href="includes/font-awesome-4.3.0/css/font-awesome.min.css">
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
// target host to be used for get package list
$target = array();
if(isset($_GET['target'])){
    $target["ipaddress"] = htmlspecialchars($_GET["target"]);
}
// we need the os for decide which package manager to use
// probably port is not needed as setted from the target host settings
if(isset($_GET['os'])){
    $target["os"] = htmlspecialchars($_GET["os"]);
}
    $user_id = $me->get_user_id();
?>
<body>
<div id="popup" data-name="name" class="dialog">
    <p class="item-1"></p>
    <p class="item-2"></p>
    <p class="item-3"></p>
</div>
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="section">
                <h2 class="title">パッケージリスト</h2>
                <div class="list-tools clearfix">
                    <form id="form2">
                        <input type="hidden" name="user_id" id="user_id" value=<?php echo $user_id ;?>>
                    <button class="btn btn-primary" type="submit">
                        package update
                        <i class="fa fa-refresh"></i>
                    </button>
                    </form>
                <form id="form1">
                    <div class="list-action">
                        <select name="list-action-general" class="input-list">
                            <option value="0">一括操作</option>
                            <option value="1">更新</option>
                        </select>
                        <select name="list-action-package" class="input-list">
                            <option value="0">表示パッケージ</option>
                            <option value="1">インストール済み</option>
                            <option value="2">すべてのパッケージ</option>
                        </select>
                    </div>
                    <div class="search-box">
                        <input type="text" name="field1" id="field1">
                        <button type="submit" name="submit" class="search-box__button">
                        <i class="fa fa-search"></i>
                    </div>
                </form>
                </div>
                <table class="table" name="table" id="resultTable">
                    <thead>
                    <tr>
                        <th class="cbox__selectall">
                            <div class="cbox__wrapper">
                                <input type="checkbox" id="cbox-selectall">
                                <label for="cbox-selectall"></label>
                            </div>
                        </th>
                        <th>ID</th>
                        <th>package name</th>
                        <th>package version</th>
                        <th>package summary</th>
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
<script>
var target_ipaddress = '<?php echo $target["ipaddress"] ;?>';
//    var target_os = '<?php //echo $target["os"] ;?>//';*/
</script>
<script type="text/javascript" src="ts/async.js"></script>
</body>
</html>
