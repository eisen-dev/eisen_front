<?php require_once __DIR__ . '/locale.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo _('Task list'); ?></title>
<?php
require_once __DIR__ .'/parts/head.php';
?>
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
    require_once __DIR__ . '/includes/DbAction.php';
    require_once __DIR__ . '/locale.php';
    $dba = new DbAction();
    $dbh = $dba->Connect();
?>
<body>
<!-- TODO better popup menu style -->
<div id="popup" data-name="name" class="dialog">
    <!--<a href="">Hello world!</a>-->
    <p class="item-1"></p>
    <p class="item-2"></p>
</div>
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="section">
                <h2 class="title">タスクリスト</h2>
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
                <table class="table">
                    <thead>
                    <tr>
                        <th class="cbox__selectall">
                            <div class="cbox__wrapper">
                                <input type="checkbox" id="cbox-selectall"><label for="cbox-selectall"></label>
                            </div>
                        </th>
                        <th><?php echo _('ID'); ?></th>
                        <th><?php echo _('manger host'); ?></th>
                        <th><?php echo _('host'); ?></th>
                        <th>モジュール</th>
                        <th>コマンド</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dba = new DbAction();
                    $dbh = $dba->Connect();
                    $user_id = $me->get_user_id();
                    $machine = $dba->hostManagerActiveList($user_id, $dbh);
                    $rest = new restclient();
                    foreach ($machine as $i => $row) {
                        $tasks[] = $rest->tasks_list(
                            $row['ipaddress'],
                            $row['port'],
                            $row['username'],
                            $row['password']
                        );
                        $tasks[$i][0]->manager_host = $row['ipaddress'];
                    }
                    foreach ($tasks as $i => $row) {
                        foreach ($row as $x => $task) {
                            # hack for get task_id
                            $uri = $task->uri;
                            $uri = explode('/', $uri);
                            $task_id = $uri[5];
                            $table = '<tr class="cell-which-triggers-popup"
                            data-modal="open"
                            data-modal-target="test-modal"
                            data-modal-type="test">';
                            $table .= '<td class="task_id">' . ($task_id) . '</td>';
                            $table .= '<td class="manager_host">' . $task->manager_host . '</td>';
                            $table .= '<td class="host">' . $task->hosts . '</td>';
                            $table .= '<td class="module">' . $task->module . '</td>';
                            $table .= '<td class="command">' . $task->command . '</td></tr>';
                            echo($table);
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <div class="button" data-modal="open" data-modal-target="task_list-setting">open setting</div>
            </div>
        </main>
    </div>
</div>
<!-- set modal before body tag -->
<div class="modal" id="task_list-setting">
    <div class="modal-wrapper">
        <div class="modal-window">
            <form action="includes/task_registration.php" method="post">
                <div class="modal-header">
                    <i class="fa fa-times modal-close" data-modal="close"></i>
                    <span class="modal-title"><?php echo _('task settings'); ?></span>
                </div>
                <div class="modal-contents">
                    <div class="compact-form">
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span><?php echo _('manager host'); ?></span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="manager_host">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span><?php echo _('target host or target group'); ?></span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="target_hosts">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span><?php echo _('Module'); ?></span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="module">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span><?php echo _('command'); ?></span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="command">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-ctrl">
                    <input type="submit" name="submit" value="設定して次に進む" class="button">
                </div>
            </form>
        </div>
    </div>
    <div class="modal-overlay" data-modal="close"></div>
</div>
<div class="modal" id="test-modal">
    <div class="modal-wrapper">
        <div class="modal-window">
            <div class="modal-header">
                <i class="fa fa-times modal-close" data-modal="close"></i>
                <span class="modal-title">ここに処理結果を表示</span>
            </div>
            <div class="modal-contents" id="modal-contents">
                <p class="item-1"></p>
                <p class="item-2"></p>
            </div>
            <div class="modal-ctrl"></div>
        </div>
    </div>
    <div class="modal-overlay"  data-modal="close"></div>
</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
<script>
jQuery(document).ready(function () {
    // モーダルウィンドウ関連
    // リサイズ時のモーダル位置を設定
    jQuery(window).resize(function () {
        // リサイズ対象の現在開かれているモーダル
        var resizetarget = "[data-modal-active='true']";
        // モーダルの幅を取得
        var modalw = jQuery(resizetarget + ">" + ".modal-wrapper").outerWidth();
        // 描画エリアの幅を取得(この要素を基準に中央寄せ)
        var areaw = jQuery(resizetarget).width();
        // positionの位置を計算
        var modalcenter = (areaw / 2) - (modalw / 2);
        jQuery(resizetarget + ">" + ".modal-wrapper").css("left", modalcenter + "px");
    });
    // モーダルの開閉
    jQuery("[data-modal='open']").click(function () {
        // 開きたいモーダルのID
        var target = "#" + jQuery(this).attr("data-modal-target");
        // 開きたいモーダルに属性追加
        jQuery(target).attr({"data-modal-active": "true"});
        // モーダルの初期位置を設定
        var modalw = jQuery(target + ">" + ".modal-wrapper").outerWidth();
        var areaw = jQuery(target).width();
        var modalcenter = (areaw / 2) - (modalw / 2);
        jQuery(target + ">" + ".modal-wrapper").css("left", modalcenter + "px");
        // モーダルを開く
        jQuery(target).css("visibility", "visible").hide().fadeIn("0", "easeOutCubic");
    });
    jQuery("[data-modal='close']").click(function () {
        // 開かれているモーダルを閉じる
        jQuery("[data-modal-active='true']").fadeOut("0", "easeOutCubic", function () {
            jQuery("[data-modal-active='true']").css("visibility", "hidden").css("display", "block");
            jQuery("[data-modal-active='true']" + ">" + ".modal-wrapper").css("left", "0px");
            jQuery("[data-modal-active='true']").attr({"data-modal-active": "false"});
        });
    });
    jQuery(document).on("click", '[data-modal-type="test"]', function (event) {
        var task_id = $(event.target).closest('tr').find('.task_id').text();
        var module = $(event.target).closest('tr').find('.module').text();
        var command = $(event.target).closest('tr').find('.command').text();
        if (task_id && module) {
            showPopup(task_id, module, command);
        }
    });

    function showPopup(task_id, module, command) {
        jQuery("#modal-contents").find("p.item-1").html(generateLink(task_id, module, command, 'start'));
        jQuery("#modal-contents").find("p.item-2").html(generateLink(task_id, module, command, 'result'));
    }

    function generateLink(task_id, module, command, taskAction)
    {
        var htmlLink = "<a href=includes/TasksAction.php?id="
            + task_id +
            "\&action="
            + taskAction +
            "\>"
            + taskAction +
            ":"
            + command +
            "</a>";
        return htmlLink;
    }
});
</script>
</body>
</html>
