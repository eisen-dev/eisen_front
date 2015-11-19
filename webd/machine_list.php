<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マシン管理</title>
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
require_once __DIR__ . '/includes/DbAction.php';
$dba = new DbAction();
$dbh = $dba->Connect();
?>
<body>
<!-- TODO better popup menu style -->
<div id="popup" data-name="name" class="dialog">
    <!--<a href="">Hello world!</a>-->
    <p></p>
</div>
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper">
        <main class="contents menu-set">
            <div class="section">
                <h2 class="title">マシンリスト</h2>
                    <div class="list-tools clearfix">
                            <input type="submit" value="適用" class="button button--form">
                        </div>
                        <div class="search-box">
                            <input type="text" placeholder="全てのパッケージを検索">
                            <div class="search-box__button">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="cbox__selectall">
                                <div class="cbox__wrapper">
                                    <input type="checkbox" id="cbox-selectall"><label for="cbox-selectall"></label>
                                </div>
                            </th>
                            <th>IPアドレス</th>
                            <th>ポート</th>
                            <th>module</th>
                            <th>ステータス</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $user_id = $me->get_user_id();
                        $stm = $dbh->prepare("select * from machine_info WHERE user_id=:user_id;");
                        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
                        $stm->execute();
                        $data = $stm->fetchAll();
                        $cnt  = count($data); //in case you need to count all rows
                        //var_dump($data);
                        foreach ($data as $i => $row) {
                            $table = '<tr class="cell-which-triggers-popup"><td><input type="checkbox" id="cbox-' . $i . '"><label for="cbox-' . $i . '"></label></td>';
                            $table .= '<td class="ipaddress">' . $row['ipaddress'] . '</td>';
                            $table .= '<td class="port">' . $row['port'] . '</td>';
                            $table .= '<td class="module">' . $row['module'] . '</td>';
                            $table .= '<td class="status_id">' . $row['status_id'] . '</td></tr>';
                            print_r($table);
                        }
                        ?>
                        </tbody>
                    </table>
            <!--TODO Use modal for this -->
            <div class="setting">
                <form action="includes/machine_registration.php" method="post">
                    <h2 class="title">Agent設定</h2>
                    <div class="setting-container">
                        <div class="setting-item-left">
                            <span>ホスト名</span>
                        </div>
                        <div class="setting-item-right">
                            <input type="text" name="rest_host">
                        </div>
                    </div>
                    <div class="setting-container">
                        <div class="setting-item-left">
                            <span>ポート番号</span>
                        </div>
                        <div class="setting-item-right">
                            <input type="text" name="rest_port">
                        </div>
                    </div>
                    <div class="setting-container">
                        <div class="setting-item-left">
                            <span>ユーザー名</span>
                        </div>
                        <div class="setting-item-right">
                            <input type="text" name="rest_user">
                        </div>
                    </div>
                    <div class="setting-container">
                        <div class="setting-item-left">
                            <span>パスワード</span>
                        </div>
                        <div class="setting-item-right">
                            <input type="text" name="rest_pass">
                        </div>
                    </div>
                    <input type="submit" name="submit" value="設定して次に進む" class="button">
                </form>
            </div>
    </div>
</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
<script>
    $( document ).ready(function() {
        $(document).on("click", ".cell-which-triggers-popup", function(event){
            var cell_value1 = $(event.target).closest('tr').find('.ipaddress').text();
            var cell_value2 = $(event.target).closest('tr').find('.port').text();
            //console.log(cell_value);
            if (cell_value1 && cell_value2) {
                showPopup(cell_value1,cell_value2)
            }
        });

        function showPopup(cell_value1,cell_value2){
            $("#popup").dialog({
                width: 500,
                height: 300,
                open: function(){
                    $(this).find("p").html("<a href=includes/PackageAction.php?ip=" + cell_value1+"&port="+cell_value2+">install "+cell_value1+"</a>");
                }
            });
        }
    });
</script>
</body>
</html>
