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
                    <div id="canvas-holder" style="width:50%">
                        <canvas id="chart-area" width="300" height="300" />
                    </div>
                    <button id="randomizeData">Randomize Data</button>
                    <button id="addDataset">Add Dataset</button>
                    <button id="removeDataset">Remove Dataset</button>
                    <script>
                        var randomScalingFactor = function() {
                            return Math.round(Math.random() * 100);
                        };
                        var randomColorFactor = function() {
                            return Math.round(Math.random() * 255);
                        };
                        var randomColor = function(opacity) {
                            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
                        };

                        var config = {
                            type: 'pie',
                            data: {
                                datasets: [{
                                    data: [
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                    ],
                                    backgroundColor: [
                                        "#F7464A",
                                        "#46BFBD",
                                        "#FDB45C",
                                        "#949FB1",
                                        "#4D5360",
                                    ],
                                }, {
                                    data: [
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                    ],
                                    backgroundColor: [
                                        "#F7464A",
                                        "#46BFBD",
                                        "#FDB45C",
                                        "#949FB1",
                                        "#4D5360",
                                    ],
                                }, {
                                    data: [
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                    ],
                                    backgroundColor: [
                                        "#F7464A",
                                        "#46BFBD",
                                        "#FDB45C",
                                        "#949FB1",
                                        "#4D5360",
                                    ],
                                }],
                                labels: [
                                    "Red",
                                    "Green",
                                    "Yellow",
                                    "Grey",
                                    "Dark Grey"
                                ]
                            },
                            options: {
                                responsive: true
                            }
                        };

                        window.onload = function() {
                            var ctx = document.getElementById("chart-area").getContext("2d");
                            window.myPie = new Chart(ctx, config);
                        };

                        $('#randomizeData').click(function() {
                            $.each(config.data.datasets, function(i, piece) {
                                $.each(piece.data, function(j, value) {
                                    config.data.datasets[i].data[j] = randomScalingFactor();
                                    //config.data.datasets.backgroundColor[i] = 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
                                });
                            });
                            window.myPie.update();
                        });

                        $('#addDataset').click(function() {
                            var newDataset = {
                                backgroundColor: [randomColor(0.7), randomColor(0.7), randomColor(0.7), randomColor(0.7), randomColor(0.7)],
                                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
                            };

                            config.data.datasets.push(newDataset);
                            window.myPie.update();
                        });

                        $('#removeDataset').click(function() {
                            config.data.datasets.splice(0, 1);
                            window.myPie.update();
                        });
                    </script>
                </div>
			</main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
