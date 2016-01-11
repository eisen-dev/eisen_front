<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マネージャホスト</title>
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
require_once __DIR__ . '/parts/modal.php';
require_once __DIR__ . '/includes/DbAction.php';

$dba = new DbAction();
$dbh = $dba->Connect();
?>
<body>
<!-- TODO better popup menu style -->
<!--<div id="popup" data-name="name" class="dialog">
    <a href="">Hello world!</a>
    <p></p>
</div>-->
<div class="wrapper">
    <?php require_once __DIR__ .'/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="section">
                <h2 class="title">マネージャホスト</h2>
				<form action="includes/checkbox_controller.php" method="post">
						<div class="list-tools clearfix">
							<div class="list-action">
								<label>
									<select name="list-action" class="input-list">
										<option value="0">一括操作</option>
										<option value="1">更新</option>
									</select>
								</label>
								<input type="submit" value="適用" class="button button--form">
							</div>
							<div class="search-box">
								<input type="text" placeholder="全てのパッケージを検索">
								<button type="submit" name="submit" class="search-box__button">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
                    <table class="table">
                        <thead>
                        <tr>
							<th class="list-data-ctrl">
								<div class="list-data-cbox">
									<input type="checkbox" id="cbox" name="check[]" value="all">
									<label for="cbox">
										<div class="select"></div>
									</label>
								</div>
							</th>
                            <th>IPアドレス</th>
                            <th>ポート</th>
                            <th>マネージメントツール</th>
                            <th>ステータス</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $user_id = $me->get_user_id();
                        $stm = $dbh->prepare("select * from manager_host WHERE user_id=:user_id;");
                        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
                        $stm->execute();
                        $data = $stm->fetchAll();
                        $cnt  = count($data); //in case you need to count all rows
                        $_SESSION["manager"] =array();
                        foreach ($data as $i => $row) {
                            $table = '<tr class="cell-which-triggers-popup">
                                <td class="list-data-ctrl">
                                <div class="list-data-cbox">
                                    <input type="checkbox" id="cbox-' . $i . '" value="' . $i . '" name="check[]">
                                    <label for="cbox-' . $i . '">
                                <div class="select"></div></label></div>';
                            $table .= '<div class="list-data-option">
                                <div class="list-data-option-icon">
                                    <i class="fa fa-caret-down"></i>
                                </div>';
                            $table .= '<div class="dropdown-menu" id="dropdown-' . $i . '"><ul>
                    <li>
                        <a href="target_list.php?target='.$row['ipaddress'].'&os='.$row['port'].'">settings</a>
                    </li>
                    </ul></div></td>';
                            $table .= '<td class="ipaddress">' . $row['ipaddress'] . '</td>';
                            $table .= '<td class="port">' . $row['port'] . '</td>';
                            $table .= '<td class="module">' . $row['module'] . '</td>';
                            $table .= '<td class="status_id">' . $row['status_id'] . '</td></tr>';
                            echo($table);
                            $_SESSION["manager"]["ipaddress"] = $row["ipaddress"];
                            $_SESSION["manager"]["port"]=$row["port"];
                            $_SESSION["manager"]["module"]=$row["module"];
                            $_SESSION["manager"]["status_id"]=$row["status_id"];
                            $_SESSION["manager"]["username"]=$row["username"];
                            $_SESSION["manager"]["password"]=$row["password"];
                        }
                        ?>
                        </tbody>
                    </table>
				</form>
            <!--TODO Use modal for this -->

            <!--data-modal-targetで開くモーダルのIDを指定する-->
			<div class="button" data-modal="open" data-modal-target="machine_list-setting">open setting</div>
			</div>
		</main>
    </div>
</div>
	<!-- set modal before body tag -->
	<div class="modal" id="machine_list-setting">
		<div class="modal-wrapper">
			<div class="modal-window">
				<form action="includes/machine_registration.php" method="post">
					<div class="modal-header">
						<i class="fa fa-times modal-close" data-modal="close"></i>
						<span class="modal-title">manager host settings</span>
					</div>
					<div class="modal-contents">
						<div class="compact-form">
							<div class="compact-form-row">
								<div class="compact-form-item-left">
									<span>manager host module</span>
								</div>
								<div class="compact-form-item-right">
									<input type="text" name="rest_module">
								</div>
							</div>
							<div class="compact-form-row">
								<div class="compact-form-item-left">
									<span>manager host ip address</span>
								</div>
								<div class="compact-form-item-right">
									<input type="text" name="rest_host">
								</div>
							</div>
							<div class="compact-form-row">
								<div class="compact-form-item-left">
									<span>manager host port</span>
								</div>
								<div class="compact-form-item-right">
									<input type="text" name="rest_port">
								</div>
							</div>
							<div class="compact-form-row">
								<div class="compact-form-item-left">
									<span>manager host username</span>
								</div>
								<div class="compact-form-item-right">
									<input type="text" name="rest_user">
								</div>
							</div>
							<div class="compact-form-row">
								<div class="compact-form-item-left">
									<span>manager host password</span>
								</div>
								<div class="compact-form-item-right">
									<input type="text" name="rest_pass">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-ctrl">
						<input type="submit" name="submit" value="設定して次に進む" class="button">
					</div>
				</form>
			</div>
		</div>
		<div class="modal-overlay" data-modal="close"></div>
	</div>
<?php require_once __DIR__ .'/parts/scripts.php'; ?>
</body>
</html>
