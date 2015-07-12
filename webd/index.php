<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>Untitled Document</title>
	<link rel="stylesheet" href="includes/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="sass/style.css">
</head>

<body>
	<div class="wrapper">
		<nav class="navigation">
			<div class="inner inner--navigation">
				<i class="fa fa-bars navigation__toggle"></i>
				<div class="navigation__title">
					<span>title here</span>
				</div>
				<div class="menu">
					<div class="machines">
						<i class="fa fa-server menu__icon"></i>

					</div>
					<div class="notifications">
						<i class="fa fa-bell-o menu__icon"></i>
					</div>
				</div>
			</div>
		</nav>
		<div class="contentswrapper">
			<main class="contents">
				<div class="section">
					<div class="inner">
						<h1 class="title--section">Hello</h1> Untitled Document!
						<?php echo '<p>Hello World</p>';
						require_once "/includes/jsonRPCClient.php";
						$serveraddress = "192.168.233.130";
						$port = "8080";
						$server= new jsonRPCClient("http://$serveraddress:$port");
						//次はテストメソッドです。
						//try {
							//json-rpcでaddメソッドを呼び出して表示する。
							//echo 'Adding 3 plus 2 on Json-RPC = '.$server->add(3,2).'</i><br />'."\n";
						//} catch (Exception $e) {
							//echo nl2br($e->getMessage()).'<br />'."\n";
						//}
						try {
                     		//json-rpcで全部Portageパッケージゲットのメソッドを呼び出して表示する。
                     		echo "printing all package:<br>";
                     		print_r($server->get_all_packages());
						} catch (Exception $e) {
							echo nl2br($e->getMessage()).'<br />'."\n";
						}
						?>
					</div>
				</div>
			</main>
		</div>
	</div>
</body>

</html>
