<!DOCTYPE html>
<html lang="ja">
	<meta charset="UTF-8">
	<title>パッケージリスト</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="includes/normalize.css">
	<link rel="stylesheet" href="includes/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="sass/style.css">
	<script type="text/javascript" src="includes/jquery/jquery-2.1.4.min.js"></script>
</head>
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
			<main class="contents menu-set">
				<div class="section">
					<h2 class="title">パッケージリスト</h2>
					<form>
						<div class="list-tools clearfix">
							<div class="list-action">
								<select name="list-action" class="input-list">
									<option value="0">一括操作</option>
									<option value="0">更新</option>
								</select>
								<input type="submit" value="適用" class="button button--form">
							</div>
							<div class="search-box">
								<input type="text" placeholder="全てのパッケージを検索">
								<div class="search-box__button">
								<i class="fa fa-search"></i>
								</div>
							</div>
						</div>
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