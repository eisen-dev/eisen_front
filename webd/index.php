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
                    <!-- TODO グラフを追加 -->
                    <div id="canvas-holder">
                        <canvas id="chart-area" width="300" height="300"></canvas>
                    </div>
                </div>
                    <div class="menu-button">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Dropdown <b class="caret"></b></a>
                    </div>
                </div>
			</main>
		</div>
    <?php
    require_once __DIR__ . '/includes/DbAction.php';

    $dba = new DbAction();
    $dbh = $dba->Connect();
    $pack_sys_id=1;
    $something=$dba->CountPackage($pack_sys_id, $dbh);
    ?>
    <script>

        var instPack = '<?php echo $something['installed_package'] ;?>';
        var notInstPack = '<?php echo $something['pack_info'] ;?>';
        var doughnutData = [
            {
                value: instPack,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "Installed Package"
            },
            {
                value: notInstPack,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Not Installed Package"
            }
        ];

        window.onload = function(){
            // pie chart options
            var doughnutOptions = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke : true,

                //String - The colour of each segment stroke
                segmentStrokeColor : "#fff",

                //Number - The width of each segment stroke
                segmentStrokeWidth : 2,

                //The percentage of the chart that we cut out of the middle.
                percentageInnerCutout : 50,

                //Boolean - Whether we should animate the chart
                animation : false,

                //Number - Amount of animation steps
                animationSteps : 100,

                //String - Animation easing effect
                animationEasing : "easeOutBounce",

                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate : true,

                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale : true,

                //Function - Will fire on animation completion.
                onAnimationComplete : null
            };
            var ctx = document.getElementById("chart-area").getContext("2d");
            window.myPie = new Chart(ctx).Doughnut(doughnutData,doughnutOptions);
        };
    </script>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
