<!DOCTYPE html>
<html lang="ja">
<?php 
require_once __DIR__ . '/parts/head.php'; 
require_once __DIR__.'/includes/connectvars.php';
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>
<body>
	<div class="wrapper">
<?php require_once __DIR__ . '/parts/navigation.php'; ?>
		<div class="contentswrapper">
			<main class="contents">
				<div class="section">
					<div class="inner inner-section">
						<h1>Hello</h1> Untitled Document!
                        <div class="panel panel-default">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>パッケージ名</th>
                                    <th>パッケージバーション</th>
                                    <th>パッケージ説明</th>
                                </tr>
                            </thead>
                            <tbody>
	                            <?php
								try {
									$query = "SELECT * FROM パッケージ情報";
									//json-rpcでインストールしたのパッケージゲットメソッドを呼び出して表示する。
									$data = mysqli_query($dbc, $query);
									foreach ($data as $value){
										print_r('<tr><td>'.$value['パッケージ名'].'</td><td>'.$value['パッケージバージョン'].'</td><td></td></tr>');
									}
								} catch (Exception $e) {
									echo nl2br($e->getMessage()).'<br />'."\n";
								}
								?>
                            </tbody>
                        </table>
                        </div>
					</div>
				</div>
			</main>
		</div>
	</div>
    <script src="includes/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>

</html>
