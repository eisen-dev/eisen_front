<?php
/**
 * (c) 2016 , Eisen Team <alice.ferrazzi@gmail.com>
 *
 * This file is part of Eisen
 *
 * Eisen is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Eisen is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Eisen.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

require_once __DIR__ . '/locale.php'; ?>
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
            <div class="content-header">
                <!-- page title -->
                <h2 class="title content-header-title"><?php echo _('Logger'); ?></h2>
                <!-- page general setting button and useful buttons area -->
                <div class="content-header-buttons">
                    <!-- setting button, open setting modal. this is optional button. -->
                    <button class="content-header-setting" data-modal="open" data-modal-target="machine_list-setting"><i class="fa fa-cog"></i></button>
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
                            </select>
                            <button class="btn btn-sm">実行</button>
                            <!-- additional control button is here,use button tag -->
                            <button class="btn btn-sm"><i class="fa fa-refresh"></i>リストを更新</button>
                        </div>
                        <div class="n-searchbox">
                            <input type="text" placeholder="<?php echo _('search all log'); ?>" class="n-search-box-input">
                            <!-- search button -->
                            <button type="submit" name="submit" class="n-search-button"><i class="fa fa-search"></i></button>
                            <!-- optional filter button -->
                        </div>
                    </div>
                    <!-- optional filter area -->
                    <!-- optional filter area end -->
                    <!--  new list control tools end-->
                </div>


               <table class="table">
                   <thead>
                   <tr>
                       <th><?php echo _('channel'); ?></th>
                       <th><?php echo _('level'); ?></th>
                       <th><?php echo _('message'); ?></th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php
                   $user_id = $me->get_user_id();
                   $data = $dba->packageActionResult($dbh);
                   foreach ($data as $i => $row) {
                       $table = '<tr>';
                       $table .= '<td class="result_string">' . $row['result_string'] . '</td>';
                       $table .= '<td class="packageName">' . $row['packageName'] . '</td>';
                       $table .= '<td class="packageVersion">' . $row['packageVersion'] . '</td>';
                       $table .= '</tr>';
                       echo($table);
                   }
                   ?>
                   </tbody>
                </table>
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
