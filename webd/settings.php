<!DOCTYPE html>
<html lang="ja">
<?php
//タイトル
$title = "テンプレート";
require_once __DIR__ .'/parts/head.php';
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/locale.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<body>
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="section">
                <h2 class="title">全般設定</h2>
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
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
