<!DOCTYPE html>
<html lang="ja">
<?php
//タイトル
$title = "テンプレート";
require_once __DIR__ .'/parts/head.php';
require_once __DIR__ . '/connect.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<body>
	<div class="wrapper">
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper menu-set">
			<main class="contents">
                <div class="content-header">
                    <h2 class="title content-header-title">ダッシュボード</h2>
                </div>
                <div class="widgets-wrapper">
                    <div class="widget widget-large">
                        <div class="widget-base">
                            <div class="widget-header">
                                <span class="widget-title">ようこそ</span>
                            </div>
                            <div class="widget-contents">
                                <div class="wgt-welcome">
                                    <span>eisenへようこそ！<br>まずは<a href="target_list.php">ターゲットホスト</a>を追加してみましょう。<br>分からないことは<a href="#">ヘルプ</a>をご覧ください。</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="widget widget-medium">
                        <div class="widget-base">
                            <div class="widget-header">
                                <span class="widget-title">マシンステータス</span>
                            </div>
                            <div class="widget-contents">
                                <div class="wgt-mstat">
                                    <ul>
                                        <li class="wgt-mstat-li-thost">
                                            <span class="wgt-mstat-li-thost-title"><i class="fa fa-caret-down wgt-mstat-diric"></i><span>targethost01</span></span>
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
                                                        <li class="wgt-mstat-li-mnghost">managerhost01</li>
                                                        <li class="wgt-mstat-li-mnghost">managerhost02</li>
                                                        <li class="wgt-mstat-li-mnghost">managerhost03</li>
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
                                                        <li class="wgt-mstat-li-mnghost">managerhost01</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="wgt-mstat-li-thost">
                                            <span class="wgt-mstat-li-thost-title"><i class="fa fa-caret-right wgt-mstat-diric"></i><span>targethost02</span></span>

                                        </li>
                                        <li class="wgt-mstat-li-thost">
                                            <span class="wgt-mstat-li-thost-title"><i class="fa fa-caret-right wgt-mstat-diric"></i><span>targethost03</span></span>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget widget-medium">
                        <div class="widget-base">
                            <div class="widget-header">
                                 <span class="widget-title">最近のアクティビティ</span>
                            </div>
                            <div class="widget-contents">

                            </div>
                        </div>
                    </div>
                    <div class="widget widget-medium">
                        <div class="widget-base">
                            <div class="widget-header">
                                 <span class="widget-title">ログイン履歴</span>
                            </div>
                            <div class="widget-contents">

                            </div>
                        </div>
                    </div>
                   <div class="widget widget-medium">
                        <div class="widget-base">
                            <div class="widget-header">
                                <span class="widget-title">ニュースフィード</span>
                            </div>
                            <div class="widget-contents">
                                <div class="wgt-news">
                                    <span class="wgt-news-title">eisenのニュース</span>
                                    <ul>
                                        <li><span class="wgt-news-date">20160101</span><span class="wgt-news-title">あけましておめでとう</span></li>
                                        <li><span class="wgt-news-date">20151225</span><span class="wgt-news-title">メリークリスマス</span></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

				<div class="section">

                </div>
			</main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
