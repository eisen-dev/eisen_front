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
require_once __DIR__.'/connect.php';
require_once __DIR__ . '/parts/modal.php';
$dsn = "mysql:dbname=$db_name;host=$db_host;charset=utf8";
//データベース接続
try {
    $dbh = new PDO($dsn, $db_user, $db_pass,
        array(PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (PDOException $e) {
    exit('データベース接続に失敗しました'.$e->getMessage());
}
?>
<body>
<div id="popup" data-name="name" class="dialog">
    <a href="">Hello world!</a>
    <p></p>
</div>
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper">
        <main class="contents menu-set">
            <div class="setting">
                <form action="includes/account.php" method="post">
                    <h2 class="title">アカウント設定</h2>
                    <div class="section">
                    <?php
                    $user_id=$_SESSION['login_user'];
                    print '<div class="setting-container"><div class="setting-item-left"><span>ユーザー名:</span></div><div class="setting-item-right"><span>'.$user_id.'</span></div>';
                    $stm = $dbh->prepare("select * from user_info WHERE user_id = :user_id ;");
                    $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
                    $stm->execute();
                    $data = $stm->fetchAll();
                    $cnt  = count($data); //in case you need to count all rows
                    foreach ($data as $i => $row)
                        print_r('</div><div class="setting-container"><div class="setting-item-left"><span>メール:</span></div><div class="setting-item-right"><span>'.$row['mail_address'].'</span></div></div>');
                    ?>
                    <div class="setting-container">
                        <div class="setting-item-left">
                            <span>先パスワード</span>
                        </div>
                        <div class="setting-item-right">
                            <input type="password" name="old_pass" required='required'>
                        </div>
                    </div>
                    <div class="setting-container">
                        <div class="setting-item-left">
                            <span>メール[任意]</span>
                        </div>
                        <div class="setting-item-right">
                            <input type="text" name="mail">
                        </div>
                    </div>
                    <div class="setting-container">
                        <div class="setting-item-left">
                            <span>新パスワード[任意]</span>
                        </div>
                        <div class="setting-item-right">
                            <input type="password" name="new_pass">
                        </div>
                    </div>
                    <div class="setting-container">
                        <div class="setting-item-left">
                            <span>パスワード確認[任意]</span>
                        </div>
                        <div class="setting-item-right">
                            <input type="password" name="confirm_pass">
                        </div>
                    </div>
                    <input type="submit" name="submit" value="設定して" class="button">
                </form>
            </div>
    </div>
</div>
<script type="text/javascript" src="includes/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="includes/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="includes/jquery/jquery-ui.min.js"></script>
<script>
    $( document ).ready(function() {
        $(document).on("click", ".cell-which-triggers-popup", function(event){
            var cell_value = $(event.target).text();
            showPopup(cell_value)
        });

        function showPopup(your_variable){
            $("#popup").dialog({
                width: 500,
                height: 300,
                open: function(){
                    $(this).find("p").html("Hello " + your_variable)
                }
            });
        }
    });
</script>
</body>
</html>