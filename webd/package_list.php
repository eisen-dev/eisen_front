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
            <div class="section">
                <h2 class="title">
                <?php
                echo _('Package List for host: ');
                echo ($_SESSION['target_host'][0]['ipaddress']);
                echo ' using manager id: ';
                echo ($_SESSION['target_host'][0]['machine_id']);
                ?>
                </h2>
                <div class="list-tools clearfix">
                    <form id="form2">
                        <input type="hidden" name="user_id" id="user_id" value=<?php echo $user_id ;?>>
                    <button class="btn btn-primary" type="submit">
                        package update
                        <i class="fa fa-refresh"></i>
                    </button>
                    </form>
                <form id="form1">
                    <div class="list-action">
                        <select name="list-action-package" class="input-list">
                            <option value="0"><?php echo _('Installed package'); ?></option>
                            <option value="1"><?php echo _('Repository package'); ?></option>
                        </select>
                    </div>
                    <div class="search-box">
                        <input type="text" name="field1" id="field1">
                        <button type="submit" name="submit" class="search-box__button">
                        <i class="fa fa-search"></i>
                    </div>
                </form>
                </div>
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