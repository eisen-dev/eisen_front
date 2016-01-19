<!DOCTYPE html>
<html lang="ja">
<?php
    $lang = "ja_JP";
    $domain = "messages";
    setlocale(LC_ALL, $lang);
    bindtextdomain($domain, "./Locale/");
    textdomain($domain);
    echo _("hello world");
?>
<head>
<?php
// タイトル
$title = "テンプレート";
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
if(isset($_GET['host'])){
    $package = htmlspecialchars($_GET["host"]);
    echo($package);
}
if(isset($_GET['action'])){
    $action = htmlspecialchars($_GET["action"]);
    echo($action);
}
require_once __DIR__ . '/parts/modal.php';
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
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="section">
                <h2 class="title">host list</h2>
                <div class="list-tools clearfix">
                    <div class="list-action">
                        <select name="list-action" class="input-list">
                            <option value="0">packages list</option>
                            <option value="1">settings</option>
                            <option value="2">task list</option>
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
                    <th>ip address</th>
                    <th>port</th>
                    <th>groups</th>
                    <th>os</th>
                    <th>status id<th>
                </tr>
                </thead>
                <tbody>
                <?php
                $user_id = $me->get_user_id();
                $hosts = new TargetHostController();
                $data = $hosts->get_TargetHost($user_id);
                foreach ($data as $i => $row) {
                    $table = '<tr class="cell-which-triggers-popup">
                                <td class="list-data-ctrl">
                                <div class="list-data-cbox">
                                    <input type="checkbox" id="cbox-' . $i . '">
                                    <label for="cbox-' . $i . '">
                                <div class="select"></div></label></div>';
                    $table .= '<div class="list-data-option">
                                <div class="list-data-option-icon">
                                    <i class="fa fa-caret-down"></i>
                                </div>';
                    $table .= '<div class="dropdown-menu" id="dropdown-' . $i . '"><ul>
                    <li>
                        <a href="package_list.php?target='.$row['ipaddress'].'">package list</a>
                    </li>
                    <li>
                        <a href="task_list.php?target='.$row['ipaddress'].'">task list</a>
                    </li>
                    <li>
                        <a href="variable_list.php?target='.$row['ipaddress'].'">settings</a>
                    </li>
                    </ul></div></td>';
                    $table .= '<td class="ipaddress">' . $row['ipaddress'] . '</td>';
                    $table .= '<td class="port">' . $row['port'] . '</td>';
                    $table .= '<td class="groups">' . $row['groups'] . '</td>';
                    $table .= '<td class="os">' . $row['os'] . '</td>';
                    $table .= '<td class="status_id">' . $row['status_id'] . '</td>';
                    echo($table);
                }
                ?>
                </tbody>
            </table>
            <!--data-modal-targetで開くモーダルのIDを指定する-->
            <div class="button" data-modal="open" data-modal-target="target_host_list-setting">open setting</div>
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
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
