<?php
/**
 * Eisen Frontend
 * http://eisen-dev.github.io
 *
 * Copyright (c) 2016 Alice Ferrazzi <alice.ferrazzi@gmail.com> - Takuma Muramatsu <t.muramatu59@gmail.com>
 * Dual licensed under the MIT or GPL Version 3 licenses or later.
 * http://eisen-dev.github.io/License.md
 *
 */

require_once __DIR__ . '/locale.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo _('Host Manager'); ?></title>
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
                <div class="content-header">
                    <!-- page title -->
                    <h2 class="title content-header-title"><?php echo _('Host Manager'); ?></h2>
                    <!-- page general setting button and useful buttons area -->
                    <div class="content-header-buttons">
                        <div class="content-header-button">
                            <!-- header button area, example for add new machine button. -->
                            <button class="btn btn-sm" data-modal="open" data-modal-target="machine_list-setting"><i class="fa fa-plus"></i><?php echo _('add new machine'); ?></button>
                        </div>
                         <!-- setting button, open setting modal. this is optional button. -->
                    </div>
                </div>



                <form action="includes/manager_host_checkbox.php" method="post">

                    <div class="n-list-tools">
                    <!-- new list control tools -->
						<div class="n-list-toolbar">
							<div class="n-list-action">
                                <!-- dropdown list and submit button.-->
                                <select name="list-action" class="n-input-list">
                                    <option value="1"><?php echo _('activate'); ?></option>
                                    <option value="0"><?php echo _('deactivate'); ?></option>
                                    <option value="2"><?php echo _('delete'); ?></option>
                                </select>
								<button type="submit" value="適用" class="btn btn-sm"><?php echo _('execute'); ?></button>
                                <!-- additional control button is here,use button tag -->
                                <button class="btn btn-sm"><i class="fa fa-refresh"></i><?php echo _('reflesh list'); ?></button>
							</div>
							<div class="n-searchbox">
								<input type="text" placeholder="<?php echo _('search all packages'); ?>" class="n-search-box-input">
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
                            $table .= '<td class="machine_id">' . $row['machine_id'] . '</td>';
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
                </div>

                </form>
                <!--TODO Use modal for this -->
                <!--data-modal-targetで開くモーダルのIDを指定する-->
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
