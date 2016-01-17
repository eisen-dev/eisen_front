<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Host Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="includes/normalize.css">
    <link rel="stylesheet" type="text/css"
          href="includes/font-awesome-4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="sass/style.css">
    <link rel="stylesheet" type="text/css" href="includes/jquery-ui.css"/>
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
    $title = "Untitled Document";
    require_once __DIR__ . '/parts/head.php';
    require_once __DIR__ . '/parts/modal.php';
    require_once __DIR__ . '/includes/DbAction.php';
    require_once __DIR__ . '/locale.php';
    $dba = new DbAction();
    $dbh = $dba->Connect();
?>
<body>
<div class="wrapper">
    <?php require_once __DIR__ . '/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="section">
                <h2 class="title"><?php echo _('Host Manager'); ?></h2>
                <form action="includes/manager_host_checkbox.php" method="post">
                    <div class="list-tools clearfix">
                        <div class="list-action">
                            <label>
                                <select name="list-action" class="input-list">
                                    <option value="1"><?php echo _('activate'); ?></option>
                                    <option value="0"><?php echo _('deactivate'); ?></option>
                                </select>
                            </label>
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
                            <th class="list-data-ctrl">
                                <div class="list-data-cbox">
                                    <input type="checkbox" id="cbox" name="check[]"
                                           value="all">
                                    <label for="cbox">
                                        <div class="select"></div>
                                    </label>
                                </div>
                            </th>
                            <th><?php echo _('machine id'); ?></th>
                            <th><?php echo _('ip address'); ?></th>
                            <th><?php echo _('port'); ?></th>
                            <th><?php echo _('module'); ?></th>
                            <th><?php echo _('active'); ?></th>
                            <th><?php echo _('status'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $user_id = $me->get_user_id();
                        $data = $dba->hostManagerList($dbh, $user_id);
                        foreach ($data as $i => $row) {
                            $table = '<tr class="cell-which-triggers-popup">
                            <td class="list-data-ctrl">
                            <div class="list-data-cbox">
                                <input type="checkbox" id="cbox-' . $row['machine_id'] .
                                '" value="' . $row['machine_id'] . '" name="check[]">
                                <label for="cbox-' . $row['machine_id'] . '">
                            <div class="select"></div></label></div></td>';
                            $table .= '<td class="ipaddress">' . $row['machine_id'] . '</td>';
                            $table .= '<td class="ipaddress">' . $row['ipaddress'] . '</td>';
                            $table .= '<td class="port">' . $row['port'] . '</td>';
                            $table .= '<td class="module">' . $row['module'] . '</td>';
                            $table .= '<td class="active">' . $row['active'] . '</td>';
                            $table .= '<td class="status_id">' . $row['status_id'] . '</td></tr>';
                            echo($table);
                        }
                        ?>
                        </tbody>
                    </table>
                </form>
                <!--TODO Use modal for this -->

                <!--data-modal-targetで開くモーダルのIDを指定する-->
                <div class="button" data-modal="open" data-modal-target="machine_list-setting">
                    open setting
                </div>
            </div>
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