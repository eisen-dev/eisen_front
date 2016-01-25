<?php require_once __DIR__ . '/locale.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo _('Logger'); ?></title>
<?php
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
    require_once __DIR__ . '/includes/DbAction.php';
    $dba = new DbAction();
    $dbh = $dba->Connect();
?>
<body>
<div class="wrapper">
    <?php require_once __DIR__ . '/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <!-- content header start-->
                <div class="content-header">
                    <!-- page title -->
                    <h2 class="title content-header-title"><?php echo _('Host Manager'); ?></h2>
                    <!-- page general setting button and useful buttons area -->
                    <div class="content-header-buttons">
                        <div class="content-header-button">
                            <!-- header button area, for add new machine buttons etc -->
                        </div>
                         <!-- setting button, open setting modal. this is optional button. -->
                        <button class="content-header-setting" data-modal="open" data-modal-target="machine_list-setting"><i class="fa fa-cog"></i></button>
                    </div>
                </div>
                <!-- content header end-->
                <form action="includes/manager_host_checkbox.php" method="post">

                                    <div class="n-list-tools">
                    <!-- new list control tools -->
					<form id="example-form">
						<div class="n-list-toolbar">
							<div class="n-list-action">
                                <!-- dropdown list and submit button.-->
                                <label>
                                    <select name="list-action" class="input-list">
                                        <option value="1"><?php echo _('activate'); ?></option>
                                        <option value="0"><?php echo _('deactivate'); ?></option>
                                    </select>
                                </label>
								<button type="submit" value="適用" class="btn btn-sm">実行</button>
                                <button class="btn btn-sm"><i class="fa fa-refresh"></i>リストを更新</button>
							</div>
							<div class="n-searchbox">
								<input type="text" placeholder="全てのパッケージを検索">
								<button type="submit" name="submit" class="n-search-button"><i class="fa fa-search"></i></button>
                                <!-- optional filter button -->
							</div>
						</div>
                        <!-- optional filter area -->
                        <!-- optional filter area end -->
                    </form>
					<!--  new list control tools end-->
                </div>
                    <div class="table-wrapper table-fullwindow">
                        <table class="table">
                        <thead>
                        <tr>
                            <th><?php echo _('channel'); ?></th>
                            <th><?php echo _('level'); ?></th>
                            <th><?php echo _('message'); ?></th>
                            <th><?php echo _('time'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $user_id = $me->get_user_id();
                        $data = $dba->monologList($dbh);
                        foreach ($data as $i => $row) {
                            $table = '<td class="ipaddress">' . $row['channel'] . '</td>';
                            $table .= '<td class="ipaddress">' . $row['level'] . '</td>';
                            $table .= '<td class="port">' . $row['message'] . '</td>';
                            $table .= '<td class="module">' . $row['time'] . '</td></tr>';
                            echo($table);
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
<div class="modal" id="machine_list-setting">
    <div class="modal-wrapper">
        <div class="modal-window">
            <form action="includes/machine_registration.php" method="post">
                <div class="modal-header">
                    <i class="fa fa-times modal-close" data-modal="close"></i>
                    <span class="modal-title"><?php echo _('Manager Host settings'); ?></span>
                </div>
                <div class="modal-contents">
                    <div class="compact-form">
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span><?php echo _('module'); ?></span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="rest_module">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span><?php echo _('ipaddress'); ?></span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="rest_host">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span><?php echo _('port'); ?></span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="rest_port">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span><?php echo _('username'); ?></span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="rest_user">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span><?php echo _('password'); ?></span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="rest_pass">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-ctrl">
                    <input type="submit" name="submit" value=<?php echo _('submit'); ?> class="button">
                </div>
            </form>
        </div>
    </div>
    <div class="modal-overlay" data-modal="close"></div>
</div>
<?php require_once __DIR__ . '/parts/scripts.php'; ?>
</body>
</html>
