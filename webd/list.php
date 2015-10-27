<!DOCTYPE html>
<html lang="ja">
<?php
$title = "Untitled Document";
require_once __DIR__ .'/parts/head.php';
require_once __DIR__.'/connect.php';
$dsn = "mysql:dbname=$db_name;host=$db_host;charset=utf8";
//データベース接続
try {
	$dbh = new PDO($dsn, $db_user, $db_pass,
			array(PDO::ATTR_EMULATE_PREPARES => false,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} 
catch (PDOException $e) {
	exit('データベース接続に失敗しました'.$e->getMessage());
}
?>
<body>
	<div class="wrapper">
	<?php require_once __DIR__ .'/parts/navigation.php'; ?>
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
	                            $stm = $dbh->prepare("select * from pack_info");
	                            $stm->execute();
	                            $data = $stm->fetchAll();
	                            $cnt  = count($data); //in case you need to count all rows
								foreach ($data as $i => $row)
									print_r('<tr><td>'.$row['pack_name'].'</td><td>'.$row['pack_version'].'</td><td></td></tr>');
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