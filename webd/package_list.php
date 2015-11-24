<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>パッケージリスト</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="includes/normalize.css">
	<link rel="stylesheet" type="text/css" href="includes/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="sass/style.css">
    <link rel="stylesheet" type="text/css" href="includes/jquery-ui.css"/>
    <style>
        #popup{
            display: none;
            border: 1px solid black;
        }
        .cell-which-triggers-popup{
            cursor: pointer;
        }
        .cell-which-triggers-popup:hover{
            background-color: yellow;
        }
    </style>
</head>
<?php
$title = "Untitled Document";
require_once __DIR__ .'/parts/head.php';
require_once __DIR__ . '/includes/DbAction.php';
require_once __DIR__ . '/parts/modal.php';

$dba = new DbAction();
$dbh = $dba->Connect();
?>
<body>
    <div id="popup" data-name="name" class="dialog">
        <a href="">Action bar</a>
        <p></p>
    </div>
	<div class="wrapper">
	<?php require_once __DIR__ .'/parts/navigation.php'; ?>
		<div class="contentswrapper">
			<main class="contents menu-set">
				<div class="section">
					<h2 class="title">パッケージリスト</h2>
						<div class="list-tools clearfix">
							<div class="list-action">
								<select name="list-action" class="input-list">
									<option value="0">一括操作</option>
									<option value="0">更新</option>
								</select>
								<input type="submit" value="適用" class="button button--form">
							</div>
                            <form method="get" role="form" class="form" id="package">
                            <div class="search-box">
								<input type="text" placeholder="全てのパッケージを検索" id="package" name="package" class="form-control">
                                <div class="search-box__button">
                                    <!-- #TODO button size and fontawesome need to be fixed -->
                                    <button type="submit" name="submit" class="btnSearch" id="search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
							</div>
                            </form>
                        </div>
						<table class="table" id="resultTable">
							<thead>
								<tr>
									<th class="cbox__selectall">
										<div class="cbox__wrapper">
										<input type="checkbox" id="cbox-selectall"><label for="cbox-selectall"></label>
										</div>
									</th>
									<th>パッケージ名</th>
								</tr>
							</thead>
							<tbody>
                            </tbody>
                        </table>
                        </div>
			</main>
		</div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
    <script>
        $( document ).ready(function() {
            $(document).on("click", ".cell-which-triggers-popup", function(event){
                var cell_value1 = $(event.target).closest('tr').find('.pack_category').text();
                var cell_value2 = $(event.target).closest('tr').find('.pack_name').text();
                var cell_value3 = $(event.target).closest('tr').find('.pack_version').text();
                //console.log(cell_value);
                if (cell_value1 && cell_value2 && cell_value3) {
                    showPopup(cell_value1,cell_value2)
                }
            });

            function showPopup(cell_value1,cell_value2){
                $("#popup").dialog({
                    width: 500,
                    height: 300,
                    open: function(){
                        $(this).find("p").html("<a href=includes/PackageAction.php?ip=" + cell_value1+"&port="+cell_value2+">install "+cell_value1+"</a>");
                    }
                });
            }
        $('.btnSearch').click(function(){
            makeAjaxRequest();
        });

        function makeAjaxRequest(type) {
            $.ajax({
                url: 'include/search.php',
                type: 'get',
                dataType: 'json',
                data: {
                    package: $(this).serialize();
                },
                success: function(response) {
                    $('table#resultTable tbody').html(response);
                }
            });
        }
        });
    </script>
</body>
</html>
