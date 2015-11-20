<!DOCTYPE html>
<html lang="ja">
<?php 
$title = "index page";
require_once __DIR__ .'/parts/head.php';
?>
<body>
	<div class="wrapper">
<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper">
			<main class="contents  menu-set">
				<div class="section">
					<h1>Welcome in Eisen</h1>
                    <p>
                    <a href="dbcreation.php">db create</a>
                    </p>
					<p>
					<a href="init-setup1.php">install database</a>
					</p>
                    <p>
                    <a href="machine_list.php">add machine</a>
                    </p>
					<p>
					<a href="dbupdate-install.php">update database</a>
					</p>
					<p>
					<a href="package_list.php">show list</a>
					</p>
                    <!-- TODO グラフを追加 -->
                    <div id="canvas-holder">
                        <canvas id="chart-area" width="300" height="300"/>
                    </div>


                    <script>

                        var pieData = [
                            {
                                value: 300,
                                color:"#F7464A",
                                highlight: "#FF5A5E",
                                label: "Red"
                            },
                            {
                                value: 50,
                                color: "#46BFBD",
                                highlight: "#5AD3D1",
                                label: "Green"
                            },
                            {
                                value: 100,
                                color: "#FDB45C",
                                highlight: "#FFC870",
                                label: "Yellow"
                            },
                            {
                                value: 40,
                                color: "#949FB1",
                                highlight: "#A8B3C5",
                                label: "Grey"
                            },
                            {
                                value: 120,
                                color: "#4D5360",
                                highlight: "#616774",
                                label: "Dark Grey"
                            }

                        ];

                        window.onload = function(){
                            var ctx = document.getElementById("chart-area").getContext("2d");
                            window.myPie = new Chart(ctx).Pie(pieData);
                        };



                    </script>
                </div>
			</main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
