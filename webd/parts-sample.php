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
<?php
// タイトル
$title = "テンプレート";
require_once __DIR__ .'/parts/head.php';
?>
</head>
<?php
require_once __DIR__ . '/connect.php';
$dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<body>
	<div class="wrapper">
		<!-- navigation here -->
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<!-- navigation end -->
		<div class="contentswrapper menu-set">
			<main class="contents">
				<div class="section">
					<h2>テンプレート</h2>
                    <h3 class="title">ボタンのサンプル</h3>
                    <p>
                        ・a要素<br>
                        テキスト上の通常リンクはa要素を使います。<a href="#">a要素のリンク</a><br>
                        a要素にbtnクラスを追加することでボタンにできます。<a href="#" class="btn">a要素+btnクラス</a>
                    </p>

                    <p>
                        ・button要素<br>
                        button要素のボタンは一般的なform用のボタンです。<br>
                        button要素にbtnクラスを追加することで利用できます。<br>
                        <button class="btn">button要素+btnクラス</button>
                    </p>

                    <h4 class="title">その他のオプション</h4>
                    <p>
                        ・幅いっぱいのボタン<br>
                        ボタンを要素幅いっぱいに表示したい場合はbtn-blcクラスを指定してください
                        <button class="btn btn-blc">btnクラス+btn-blcクラスのボタン</button>
                    </p>

                    <p>
                        ・高さを指定したボタン<br>
                        ボタンに厳密な高さを設定したい場合はheightを指定してください。<br>
                        <button class="btn" style="height:40px;">高さ40pxのボタン</button>
                    </p>
                    <p>
                        ・色付きのボタン<br>
                        ボタンの色を変更したい場合は以下の色が選べます。<br>
                        <button class="btn">green(default)</button>
                        <button class="btn btn-yellow">btn-yellow</button>
                        <button class="btn btn-red">btn-red</button>
                        <button class="btn btn-blue">btn-blue</button>
                        <button class="btn btn-gray">btn-gray</button>
                    </p>
                    <p>
                        ・大きさを指定したボタン<br>
                        ボタンの大きさを変更したい場合は以下のサイズが選べます。<br>
                        <button class="btn btn-sm">btn-sm</button>
                        <button class="btn">not set</button>
                        <button class="btn btn-lg">btn-lg</button>
                    </p>

                    <h3 class="title">モーダルのサンプル</h3>
					<button class="button"
                            data-modal="open"
                            data-modal-target="modal-example">
                        モーダルを開く
                    </button>
                    <p>class: モーダルには関係無く見た目のクラスを指定できます<br>
                    data-modal: モーダルをどうするのか指定します<br>
                    data-modal-target: data-modalで指定した操作をどのモーダルに対して実行するか指定します
                    </p>
				</div>

			</main>
		</div>
	</div>

    <!--example modals -->
    <div class="modal" id="modal-example">
		<div class="modal-wrapper">
			<div class="modal-window">
				<div class="modal-header">
				<i class="fa fa-times modal-close" data-modal="close"></i>
				<span class="modal-title">モーダルのサンプルです</span>
				</div>
				<div class="modal-contents">
                    <p>ボタンのdata-modal-targetを見て、同一IDのモーダルを開きます。</p>
                    <p>
                        モーダルをすでに開いている状態から、他のモーダルへ移動する場合は２つの開き方が選べます。<br>
                        data-modal="open"は開いているモーダルに重ねる形で新しいモーダルを開きます。<br>警告や確認ダイアログに使えます。<br>
                    </p>
                    <p>
                        data-modal="trans"はモーダルを一旦閉じてから対象のモーダルを開きます。<br>
                        移動に警告はありません
                    </p>
				</div>
				<div class="modal-ctrl">
                    <button class="button" data-modal="open" data-modal-target="modal-example2">open modal モーダルを開く</button>
                    <button class="button" data-modal="trans" data-modal-target="modal-example2">trans modal モーダルへ移動する</button>
                </div>
			</div>
		</div>
		<div class="modal-overlay"  data-modal="close"></div>
	</div>

    <div class="modal" id="modal-example2">
		<div class="modal-wrapper">
			<div class="modal-window">
				<div class="modal-header">
				<i class="fa fa-times modal-close" data-modal="close"></i>
				<span class="modal-title">モーダルのサンプルです</span>
				</div>
                <div class="modal-contents">
					<p>モーダルからモーダルを呼べます！</p>
                <button class="button" data-modal="close">close modal このモーダルを閉じる</button>
				</div>
			</div>
		</div>
		<div class="modal-overlay"  data-modal="close"></div>
	</div>

        <div class="modal" id="modal-package">
		<div class="modal-wrapper">
			<div class="modal-window">
				<div class="modal-header">
				<i class="fa fa-times modal-close" data-modal="close"></i>
				<span class="modal-title">ここにパッケージの名前</span>
				</div>
                <div class="modal-contents">
					<button class="button">インストール</button>
                    <button class="button">アップデート</button>
                    <button class="button">削除</button>
                <button class="button" data-modal="close">閉じる</button>
				</div>
			</div>
		</div>
		<div class="modal-overlay"  data-modal="close"></div>
	</div>
     <!--exmple modals -->

    <!--empty modal template start-->
    <div class="modal" id="modal-template">
		<div class="modal-wrapper">
			<div class="modal-window">
				<div class="modal-header">
				<i class="fa fa-times modal-close" data-modal="close"></i>
				<span class="modal-title">modal title here</span>
				</div>
				<div class="modal-contents">
                    <p>content text here</p>
				</div>
				<div class="modal-ctrl">
                    <button class="button">modal controll buttons here</button>
                </div>
			</div>
		</div>
		<div class="modal-overlay"  data-modal="close"></div>
	</div>
    <!--empty modal template end -->
<?php require_once __DIR__ .'/parts/scripts.php'; ?>

</body>
</html>
