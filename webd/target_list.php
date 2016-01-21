<?php require_once __DIR__ . '/locale.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php
// タイトル
$title = "テンプレート";
require_once __DIR__ .'/parts/head.php';
?>
    <style>
        #popup {
            display: none;
            border: 1px solid black;
        }

        .cell-which-triggers-popup {
            cursor: pointer;
        }

        .cell-which-triggers-popup:hover {
            background-color: yellow;
        }
    </style>
</head>
<?php
if(isset($_GET['host'])){
    $package = htmlspecialchars($_GET["host"]);
    echo($package);
}
if(isset($_GET['action'])){
    $action = htmlspecialchars($_GET["action"]);
    echo($action);
}
require_once __DIR__ . '/includes/DbAction.php';
require_once __DIR__ . '/includes/target_host_controller.php';
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
    <?php require_once __DIR__ . '/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="section">
                <h2 class="title"><?php echo _('target host list'); ?></h2>
                <form action="includes/target_host_checkbox.php" method="post">
                    <div class="list-tools clearfix">
                        <div class="list-action">
                            <select name="list-action" class="input-list">
                                <option value="0"><?php echo _('package list'); ?></option>
                                <option value="1"><?php echo _('task list'); ?></option>
                                <option value="2"><?php echo _('settings'); ?></option>
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
                                    <input type="checkbox" id="cbox-selectall">
                                    <label for="cbox-selectall"></label>
                                </div>
                            </th>
                            <th><?php echo _('ip address'); ?></th>
                            <th>port</th>
                            <th>groups</th>
                            <th>os</th>
                            <th>machine id</th>
                            <th>status id
                            <th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $user_id = $me->get_user_id();
                        $hosts = new TargetHostController();
                        $data = $hosts->get_TargetHost($user_id);
                        foreach ($data as $i => $manager) {
                            foreach ($manager as $x => $row) {
                                $table = '<tr class="cell-which-triggers-popup">
                            <td class="list-data-ctrl">
                            <div class="list-data-cbox">
                                <input type="checkbox" id="cbox-' . $row['host_id'] .
                                    '" value="' . $row['host_id'] . '" name="check[]">
                                <label for="cbox-' . $row['host_id'] . '">
                            <div class="select"></div></label></div>';
                                $table .= '</td>';
                                $table .= '<td class="ipaddress">' . $row['ipaddress'] . '</td>';
                                $table .= '<td class="port">' . $row['port'] . '</td>';
                                $table .= '<td class="groups">' . $row['groups'] . '</td>';
                                $table .= '<td class="os">' . $row['os'] . '</td>';
                                $table .= '<td class="machine_id">' . $row['machine_id'] . '</td>';
                                $table .= '<td class="status_id">' . $row['status_id'] . '</td>';
                                echo($table);
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </form>
                <!--data-modal-targetで開くモーダルのIDを指定する-->
                <div class="button" data-modal="open"
                     data-modal-target="target_host_list-setting">open setting
                </div>
            </div>
        </main>
    </div>
</div>
<!-- set modal before body tag -->
<div class="modal" id="target_host_list-setting">
    <div class="modal-wrapper">
        <div class="modal-window">
            <form action="includes/hosts_registration.php" method="post">
                <div class="modal-header">
                    <i class="fa fa-times modal-close" data-modal="close"></i>
                    <span class="modal-title">ホスト設定</span>
                </div>
                <div class="modal-contents">
                    <div class="compact-form">
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span>ホスト名</span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="host">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span>グループリスト</span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="groups">
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
</div>
</div>
<?php require_once __DIR__ . '/parts/scripts.php'; ?>
</body>
</html>
