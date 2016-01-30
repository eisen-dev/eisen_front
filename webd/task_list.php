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
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="content-header">
                <!-- page title -->
                <h2 class="title content-header-title"><?php echo _('Task list'); ?></h2>
                    <!-- page general setting button and useful buttons area -->
                <div class="content-header-buttons">
                    <div class="content-header-button">
                        <!-- header button area, example for add new machine button. -->
                        <button class="btn btn-sm"><i class="fa fa-plus"></i><?php echo _('add new task'); ?></button>
                    </div>
                    <!-- setting button, open setting modal. this is optional button. -->
                    <button data-modal="open" data-modal-target="task_list-setting" class="content-header-setting"><i class="fa fa-cog"></i></button>
                </div>
            </div>
            <form action="includes/task_checkbox.php" method="post">
                <div class="n-list-tools">
                    <!-- new list control tools -->
                    <div class="n-list-toolbar">
                        <div class="n-list-action">
                            <!-- dropdown list and submit button.-->
                    <select name="list-action" class="input-list">
                        <option value="0"><?php echo _('select action'); ?></option>
                        <option value="1"><?php echo _('run'); ?></option>
                    </select>
                            <button type="submit" value="適用" class="btn btn-sm"><?php echo _('execute'); ?></button>
                            <!-- additional control button is here,use button tag -->
                            <button class="btn btn-sm"><i class="fa fa-refresh"></i><?php echo _('reflesh list'); ?></button>
                        </div>
                        <div class="n-searchbox">
                            <input type="text" class="n-search-box-input" placeholder="<?php echo _('search all log'); ?>">
                            <!-- search button -->
                            <button type="submit" name="submit" class="n-search-button"><i class="fa fa-search"></i></button>
                            <!-- optional filter button -->
                        </div>
                    </div>
                    <!-- optional filter area -->
                    <!-- optional filter area end -->
                    <!--  new list control tools end-->
                </div>
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="cbox__selectall">
                                    <div class="cbox__wrapper">
                                        <input type="checkbox" id="cbox-selectall">
                                        <label for="cbox-selectall"></label>
                                    </div>
                                </th>
                                <th><?php echo _('task id'); ?></th>
                                <th><?php echo _('target host'); ?></th>
                                <th><?php echo _('host'); ?></th>
                                <th><?php echo _('module'); ?></th>
                                <th><?php echo _('command'); ?></th>
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
                                $data[] = $rest->tasks_list(
                                    $row['ipaddress'],
                                    $row['port'],
                                    $row['username'],
                                    $row['password']
                                );
                                if (is_array($data[$i])) {
                                    $data[$i][0]->manager_host = $row['ipaddress'];
                                }
                            }
                            if (is_array($data[$i])) {
                                foreach ($data as $i => $array) {
                                    foreach ($array as $x => $task) {
                                        # hack for get task_id
                                        $uri = $task->uri;
                                        $uri = explode('/', $uri);
                                        $task_id = $uri[5];
                                        if (!isset($task->manager_host)) {
                                            $task->manager_host = $row['ipaddress'];
                                        }
                                        $table = '<tr
                                        class="cell-which-triggers-popup"
                                        data-modal-target="test-modal"
                                        data-modal="open"
                                        data-modal-type="test"
                                        >';
                                        $table .= '<td class="list-data-ctrl">
                                        <div class="list-data-cbox">
                                        <input type="checkbox" id="cbox-' . $task_id .
                                            '" value="' . $task_id . '" name="managerHostId[]">
                                            <label for="cbox-' . $task_id . '">
                                            <div class="select"></div></label></div>';
                                        $table .= '</td>';
                                        $table .= '<td class="task_id">' . $task_id . '</td>';
                                        $table .= '<td class="host">' . $task->hosts . '</td>';
                                        $table .= '<td class="managerHost"><input type="hidden" id="managerHost"' .
                                            ' value="' . $task->manager_host . '" name="managerHostAddress['.$task_id.']">' .
                                            $task->manager_host . '</td>';
                                        $table .= '<td class="module">' . $task->module . '</td>';
                                        $table .= '<td class="command">' . $task->command . '</td></tr>';
                                        echo($table);
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
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
                <span class="modal-title"><?php echo _('Title'); ?></span>
            </div>
            <div class="modal-contents" id="modal-contents">
                <p class="item-1"></p>
            </div>
            <div class="modal-ctrl"></div>
        </div>
    </div>
    <div class="modal-overlay"  data-modal="close"></div>
</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
<script>
jQuery(document).ready(function () {
    jQuery('.list-data-cbox').bind('click',function(e){
        e.stopPropagation();
    });
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
        if (task_id) {
            showPopup(task_id);
        }
    });

    function showPopup(task_id) {
        $.ajax({
                url: 'taskResultModal.php',
                dataType: 'text json',
                type: 'POST',
                data: {task_id: task_id},
                dataType: 'json'
            })
            .done(function (response) {
                $('.modal-header > .modal-title').text(response.return[0]);
                $('p.item-1').text(response.return[1]);
            })
            .fail(function () {
                alert('失敗しました');
            });
    }
});
</script>
</body>
</html>
