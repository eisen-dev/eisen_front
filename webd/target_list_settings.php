<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マシン管理</title>
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
if(isset($_GET['host'])){
    $package = htmlspecialchars($_GET["host"]);
    var_dump($package);
}
if(isset($_GET['action'])){
    $action = htmlspecialchars($_GET["action"]);
    var_dump($action);
}
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
                <h2 class="title">ホストリスト</h2>
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
                            <input type="checkbox" id="cbox-selectall">
                            <label for="cbox-selectall"></label>
                        </div>
                    </th>
                    <th>IPアドレス</th>
                    <th>グループ</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $dba = new DbAction();
                $dbh = $dba->Connect();
                $user_id = $me->get_user_id();
                $machine = $dba->MachineList($user_id,$dbh);
                $module=$machine[0];
                $ipaddress=$machine[1];
                $port=$machine[2];
                $username=$machine[3];
                $password=$machine[4];
                $rest = new restclient();
                //$rest->restconnect($ipaddress,$port,$username,$password);
                $hosts = $rest->host_list($ipaddress,$port,$username,$password);
                foreach ($hosts as $i=>$row) {
                    $table = '<tr class="cell-which-triggers-popup">
                                <td class="list-data-ctrl">
                                <div class="list-data-cbox">
                                    <input type="checkbox" id="cbox-' . $i . '">
                                    <label for="cbox-' . $i . '">
                                <div class="select"></div></label></div>';
                    $table .= '<div class="list-data-option"><div class="list-data-option-icon"><i class="fa fa-caret-down"></i></div>';
                    $table .= '<div class="dropdown-menu" id="dropdown-' . $i . '"><ul><li><a>action1</a></li><li><a>action2</a></li><li><a>action3</a></li></ul></div></td>';
                    $table .= '<td class="ipaddress">' . $row->host . '</td>';
                    $table .= '<td class="groups">' . $row->groups . '</td></tr>';
                    print_r($table);
                }
                ?>
                </tbody>
            </table>
            <!--TODO Use modal for this -->

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
