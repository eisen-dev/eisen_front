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
require_once __DIR__ . '/locale.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<body>
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="section">
                <h2>テンプレート</h2>
            </div>
        </main>
    </div>
</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
