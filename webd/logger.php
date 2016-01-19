<?php
/**
 * (c) $.year. , Eisen Team <alice.ferrazzi@gmail.com>
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
    require_once __DIR__ . '/parts/modal.php';
    require_once __DIR__ . '/includes/DbAction.php';
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
