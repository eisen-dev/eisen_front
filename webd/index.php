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
    <title><?php echo _('Dashboard'); ?></title>
    <?php
        require_once __DIR__ .'/parts/head.php';
    ?>
</head>
<?php
    require_once __DIR__ . '/connect.php';
    require_once __DIR__ . '/includes/DbAction.php';
    $dba = new DbAction();
    $dbh = $dba->Connect();
?>

<body>
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="content-header">
                <h2 class="title content-header-title"><?php echo _('Dashboard'); ?></h2>
            </div>
            <div class="widgets-wrapper">
                <div class="widget widget-large">
                    <div class="widget-base">
                        <div class="widget-header">
                            <span class="widget-title"><?php echo _('Welcome'); ?></span>
                        </div>
                        <div class="widget-contents">
                            <div class="wgt-welcome">
                                    <span>
                                    <?php echo _('Welcome to Eisen'); ?><br>
                                    <li>
                                        <?php echo _("Let's add a <a href='host_manager.php'>Host manager</a>"); ?>
                                    </li>
                                    <br>
                                        <?php echo _("For any problem please check the <a href='https://github.com/eisen-dev/eisen_docs/blob/master/README.md' target='_blank'>documentation</a>"); ?>
                                    </br>
                                    </span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="widget widget-medium">
                    <div class="widget-base">
                        <div class="widget-header">
                            <span class="widget-title"><?php echo _('Machine Status'); ?></span>
                        </div>
                        <div class="widget-contents">
                            <div class="wgt-mstat">
                                <ul>
                                    <li class="wgt-mstat-li-thost">
                                        <span class="wgt-mstat-li-thost-title"><i class="fa fa-caret-right wgt-mstat-open-mnghosts"></i><span>managerhost01</span></span>
                                        <div class="wgt-mstat-mnghosts">
                                            <div class="wgt-mstat-li-group">
                                                <div class="wgt-mstat-group-title-online">
                                                    <span class="wgt-mstat-group-title">Online</span>
                                                        <span class="wgt-mstat-group-title-info">
                                                            <span class="wgt-mstat-info-status"><i class="fa fa-power-off"></i>3</span>
                                                            <span class="wgt-mstat-info-alart"><i class="fa fa-exclamation-triangle"></i>1</span>
                                                        </span>
                                                </div>
                                                <ul>
                                                    <li class="wgt-mstat-li-mnghost">
                                                        <span class="wgt-mstat-li-mnghost-title">targethost01</span>
                                                            <span class="wgt-mstat-group-title-info">
                                                                <span class="wgt-mstat-info-status-lamp-online"><i class="fa fa-circle"></i></span>
                                                            </span>
                                                    </li>
                                                    <li class="wgt-mstat-li-mnghost">
                                                        <span class="wgt-mstat-li-mnghost-title">targethost02</span>
                                                            <span class="wgt-mstat-group-title-info">
                                                                <span class="wgt-mstat-info-status-lamp-online"><i class="fa fa-circle"></i></span>
                                                            </span>
                                                    </li>
                                                    <li class="wgt-mstat-li-mnghost">
                                                        <span class="wgt-mstat-li-mnghost-title">targethost03</span>
                                                            <span class="wgt-mstat-group-title-info">
                                                                <span class="wgt-mstat-info-status-lamp-online"><i class="fa fa-circle"></i></span>
                                                            </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="wgt-mstat-li-group">
                                                <div class="wgt-mstat-group-title-offline">
                                                    <span class="wgt-mstat-group-title">Offline</span>
                                                        <span class="wgt-mstat-group-title-info">
                                                            <span class="wgt-mstat-info-status"><i class="fa fa-power-off"></i>1</span>
                                                        </span>
                                                </div>
                                                <ul>
                                                    <li class="wgt-mstat-li-mnghost">
                                                        <span class="wgt-mstat-li-mnghost-title">targethost04</span>
                                                            <span class="wgt-mstat-group-title-info">
                                                                <span class="wgt-mstat-info-status-lamp-offline"><i class="fa fa-circle"></i></span>
                                                            </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="wgt-mstat-li-thost">
                                        <span class="wgt-mstat-li-thost-title"><i class="fa fa-caret-right wgt-mstat-open-mnghosts"></i><span>managerhost02</span></span>
                                        <div class="wgt-mstat-mnghosts">
                                            <div class="wgt-mstat-li-group">
                                                <div class="wgt-mstat-group-title-online">
                                                    <span class="wgt-mstat-group-title">Online</span>
                                                        <span class="wgt-mstat-group-title-info">
                                                            <span class="wgt-mstat-info-status"><i class="fa fa-power-off"></i>3</span>
                                                            <span class="wgt-mstat-info-alart"><i class="fa fa-exclamation-triangle"></i>1</span>
                                                        </span>
                                                </div>
                                                <ul>
                                                    <li class="wgt-mstat-li-mnghost">
                                                        <span class="wgt-mstat-li-mnghost-title">targethost01</span>
                                                            <span class="wgt-mstat-group-title-info">
                                                                <span class="wgt-mstat-info-status-lamp-online"><i class="fa fa-circle"></i></span>
                                                            </span>
                                                    </li>
                                                    <li class="wgt-mstat-li-mnghost">
                                                        <span class="wgt-mstat-li-mnghost-title">targethost02</span>
                                                            <span class="wgt-mstat-group-title-info">
                                                                <span class="wgt-mstat-info-status-lamp-online"><i class="fa fa-circle"></i></span>
                                                            </span>
                                                    </li>
                                                    <li class="wgt-mstat-li-mnghost">
                                                        <span class="wgt-mstat-li-mnghost-title">targethost03</span>
                                                            <span class="wgt-mstat-group-title-info">
                                                                <span class="wgt-mstat-info-status-lamp-online"><i class="fa fa-circle"></i></span>
                                                            </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="wgt-mstat-li-group">
                                                <div class="wgt-mstat-group-title-offline">
                                                    <span class="wgt-mstat-group-title">Offline</span>
                                                        <span class="wgt-mstat-group-title-info">
                                                            <span class="wgt-mstat-info-status"><i class="fa fa-power-off"></i>1</span>
                                                        </span>
                                                </div>
                                                <ul>
                                                    <li class="wgt-mstat-li-mnghost">
                                                        <span class="wgt-mstat-li-mnghost-title">targethost04</span>
                                                            <span class="wgt-mstat-group-title-info">
                                                                <span class="wgt-mstat-info-status-lamp-offline"><i class="fa fa-circle"></i></span>
                                                            </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="wgt-mstat-li-thost">
                                        <span class="wgt-mstat-li-thost-title"><i class="fa fa-caret-right wgt-mstat-open-mnghosts"></i><span>managerhost03</span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget widget-medium">
                    <div class="widget-base">
                        <div class="widget-header">
                            <span class="widget-title"><?php echo _('Recent activity'); ?></span>
                        </div>
                        <div class="widget-contents">
                            <div class="wgt-activity">
                                <table class="table wgt-compact-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            時刻
                                        </th>
                                        <th>
                                            ターゲットホスト
                                        </th>
                                        <th>
                                            操作
                                        </th>
                                        <th>
                                            対象
                                        </th>
                                        <th>
                                            結果
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            201601011:11:11
                                        </td>
                                        <td>
                                            managerhost01
                                        </td>
                                        <td>
                                            アップデート
                                        </td>
                                        <td>
                                            Apache xxx
                                        </td>
                                        <td>
                                            成功
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            201601011:11:11
                                        </td>
                                        <td>
                                            managerhost01
                                        </td>
                                        <td>
                                            アップデート
                                        </td>
                                        <td>
                                            Apache xxx
                                        </td>
                                        <td>
                                            成功
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <span>直近の5件を表示しています - <a href="packageResult.php">すべてのログを見る</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget widget-medium">
                    <div class="widget-base">
                        <div class="widget-header">
                            <span class="widget-title"><?php echo _('Login history'); ?></span>
                        </div>
                        <div class="widget-contents">
                            <div class="wgt-activity">
                                <table class="table wgt-compact-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            時刻
                                        </th>
                                        <th>
                                            ユーザー
                                        </th>
                                        <th>
                                            状況
                                        </th>
                                        <th>
                                            アクセス元
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            201601011:11:11
                                        </td>
                                        <td>
                                            depra95
                                        </td>
                                        <td>
                                            失敗
                                        </td>
                                        <td>
                                            192.168.11.2
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            201601011:11:11
                                        </td>
                                        <td>
                                            alice
                                        </td>
                                        <td>
                                            成功
                                        </td>
                                        <td>
                                            192.168.11.3
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <span>直近の5件を表示しています - <a href="#">すべてのログを見る</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget widget-medium">
                    <div class="widget-base">
                        <div class="widget-header">
                            <span class="widget-title"><?php echo _('News feed'); ?></span>
                        </div>
                        <div class="widget-contents">
                            <div class="wgt-news">
                                <span class="wgt-news-title">eisenのニュース</span>
                                <ul>
                                    <div id="divRss"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
<script type="text/javascript" src="includes/feedEK/FeedEk.js"></script>
<script>
    $(document).ready(function(){

        $('#divRss').FeedEk({
            FeedUrl : 'http://eisen-dev.github.io/update/feed.xml'
        });

        var r = Math.floor(Math.random()*256);
        var g = Math.floor(Math.random()*256);
        var b = Math.floor(Math.random()*256);

        $('#example, .itemTitle a').css("color", getHex(r,g,b));

        $('#example').click(function() {

            $('.itemTitle a').css("color", getHex(r,g,b));

        });

        function intToHex(n){
            n = n.toString(16);
            if( n.length < 2)
                n = "0"+n;
            return n;
        }

        function getHex(r, g, b){
            return '#'+intToHex(r)+intToHex(g)+intToHex(b);
        }

    });
</script>
</body>
</html>
