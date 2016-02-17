<!--
Eisen Frontend
http://eisen-dev.github.io

Copyright (c) $today.year Alice Ferrazzi <alice.ferrazzi@gmail.com> - Takuma Muramatsu <t.muramatu59@gmail.com>
Dual licensed under the MIT or GPL Version 3 licenses or later.
http://eisen-dev.github.io/License.md
-->
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo _('Package List'); ?></title>
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
require_once __DIR__ . '/locale.php';
$user_id = $me->get_user_id();
?>
<body>
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
                    <!-- content header start-->
            <div class="content-header">
                        <!-- page title -->
                        <h2 class="title content-header-title">
                            <?php
                            echo _('Package List for host: ');
                            echo ($_SESSION['target_host'][0]['ipaddress']);
                            echo ' using manager id: ';
                            echo ($_SESSION['target_host'][0]['machine_id']);
                            ?>
                        </h2>
                        <!-- page general setting button and useful buttons area -->
                        <div class="content-header-buttons">
                            <div class="content-header-button">
                                <!-- header button area, example for add new machine button. -->
                            </div>
                            <!-- setting button, open setting modal. this is optional button. -->
                            <button class="content-header-setting"><i class="fa fa-cog"></i></button>
                        </div>
                    </div>
            <!-- content header end-->
            <!-- new list control tools -->
            <div class="n-list-tools">
                <div class="n-list-toolbar">
                    <div class="n-list-action">
                        <!-- dropdown list and submit button.-->
                        <!-- additional control button is here,use button tag -->
                        <form id="form2">
                            <input type="hidden" name="user_id" id="user_id" value=<?php echo $user_id ;?>>
                            <button class="btn btn-sm" type="submit"><i class="fa fa-refresh"></i><?php echo _('update package List'); ?></button>
                        </form>
                    </div>
                    <form id="form1">
                       <div class="n-searchbox">
                           <select name="list-action-package" class="input-list">
                                <option value="0"><?php echo _('Installed package'); ?></option>
                                <option value="1"><?php echo _('Repository package'); ?></option>
                            </select>
                           <input type="text" name="field1" id="field1" class="n-search-box-input">
                           <!-- search button -->
                           <button type="submit" name="submit" class="n-search-button"><i class="fa fa-search"></i></button>
                           <!-- optional filter button -->
                       </div>
                    </form>
                </div>
                <!-- optional filter area -->
                <!-- optional filter area end -->
            </div>
            <!--  new list control tools end-->
            <div class="form-wrapper">
                <table class="table" name="table" id="resultTable">
                    <thead>
                    <tr>
                        <th class="cbox__selectall">
                            <div class="cbox__wrapper">
                                <input type="checkbox" id="cbox-selectall">
                                <label for="cbox-selectall"></label>
                            </div>
                        </th>
                        <th><?php echo _('ID'); ?></th>
                        <th><?php echo _('package name'); ?></th>
                        <th><?php echo _('package version'); ?></th>
                        <th><?php echo _('package summary'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
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
                <p class="item-2"></p>
                <p class="item-3"></p>
                <p class="item-4"></p>
                <p class="item-5"></p>
                <p class="item-6"></p>
            </div>
            <div class="modal-ctrl"></div>
        </div>
    </div>
    <div class="modal-overlay"  data-modal="close"></div>
</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
<script>
var target_ipaddress = '<?php echo $_SESSION['target_host'][0]['ipaddress'];?>';
var target_os = '<?php echo $_SESSION['target_host'][0]['os'] ;?>';
var machine_id = '<?php echo $_SESSION['target_host'][0]['machine_id'] ;?>';

</script>
<script type="text/javascript" src="ts/async.js"></script>
</body>
</html>
